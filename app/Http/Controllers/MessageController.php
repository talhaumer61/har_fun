<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class MessageController extends Controller
{
    // Load conversation list and selected messages
    public function index(Request $request)
    {
        $user = session('user');

        // Fetch all unique users this user has talked to
        $conversations = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function ($msg) use ($user) {
                return $msg->sender_id === $user->id ? $msg->receiver_id : $msg->sender_id;
            });

        $activeUserId = $request->user_id;
        $jobId = $request->job_id;
        $messages = [];

        if ($activeUserId) {
            $messages = Message::where('job_id', $jobId)
                ->where(function ($query) use ($user, $activeUserId) {
                    $query->where(function ($q) use ($user, $activeUserId) {
                        $q->where('sender_id', $user->id)
                        ->where('receiver_id', $activeUserId);
                    })->orWhere(function ($q) use ($user, $activeUserId) {
                        $q->where('sender_id', $activeUserId)
                        ->where('receiver_id', $user->id);
                    });
                })
                ->orderBy('created_at')->get();

        }

        return view('site.components.user_messages', compact('conversations', 'messages', 'activeUserId', 'jobId'));

    }

    // Send a message via AJAX

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'job_id' => 'required|integer',
            'message' => 'required|string|max:1000'
        ]);

        $senderId = session('user')->id;

        $message = Message::create([
            'job_id' => $request->job_id,
            'sender_id' => $senderId,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Fetch latest conversation item
        $user = \App\Models\User::find($request->receiver_id);

        $conversation = [
            'user' => $user,
            'job_id' => $request->job_id,
            'last_message' => $message->message,
            'last_message_time' => $message->created_at
        ];

        return response()->json([
            'message_html' => view('site.components.messages.single_message', ['message' => $message])->render(),
            'last_message_html' => view('site.components.messages.conversation_item', ['conversation' => $conversation])->render()
        ]);
    }

   public function fetchNewMessages(Request $request)
    {
        $afterId = $request->after_id;
        $jobId = $request->job_id;
        $userId = session('user')->id;
        $otherUserId = $request->user_id;

        $newMessages = Message::where('job_id', $jobId)
            ->where(function ($query) use ($userId, $otherUserId) {
                $query->where(function ($q) use ($userId, $otherUserId) {
                    $q->where('sender_id', $userId)
                    ->where('receiver_id', $otherUserId);
                })->orWhere(function ($q) use ($userId, $otherUserId) {
                    $q->where('sender_id', $otherUserId)
                    ->where('receiver_id', $userId);
                });
            })
            ->where('id', '>', $afterId)
            ->orderBy('id')
            ->get();

        // Render each message individually
        $html = '';
        foreach ($newMessages as $message) {
            $html .= view('site.components.messages.single_message', compact('message'))->render();
        }

        return response()->json([
            'new_messages_html' => $html,
            'last_id' => $newMessages->last()?->id ?? $afterId
        ]);
    }






}
