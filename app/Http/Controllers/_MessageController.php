<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class MessageController extends Controller
{
    public function getMessages($id)
    {
        $conversation = Conversation::with(['messages.sender'])->findOrFail($id);

        // Optional: only allow if the client owns the conversation
        if (session('user')->id !== $conversation->client_id) {
            abort(403);
        }

        // Mark all messages sent *to* the client as read
        Message::where('conversation_id', $id)
            ->where('sender_id', '!=', session('user')->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'conversation_id' => $conversation->id,
            'messages' => $conversation->messages
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string'
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);

        // Ensure the logged in user is part of the conversation
        if ($conversation->client_id !== session('user')->id) {
            abort(403);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => session('user')->id,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $message->load('sender')
        ]);
    }

    // ADD THIS for auto-refresh
    public function fetchNewMessages(Request $request, $id)
    {
        $lastMessageId = $request->input('last_message_id');

        $conversation = Conversation::findOrFail($id);

        $newMessages = $conversation->messages()
            ->with('sender')
            ->where('id', '>', $lastMessageId)
            ->orderBy('id')
            ->get();

        return response()->json([
            'messages' => $newMessages
        ]);
    }

    public function refreshConversations()
    {
        $userId = session('user')->id;

        $conversations = Conversation::with(['worker', 'messages' => function ($q) {
            $q->latest(); // for last message
        }])->get();

        // Append unread count
        $data = $conversations->map(function ($conv) use ($userId) {
            return [
                'id' => $conv->id,
                'name' => $conv->worker->name,
                'last_message' => optional($conv->messages->first())->message ?? '',
                'updated_at' => $conv->updated_at->format('M d'),
                'unread_count' => $conv->messages
                    ->where('sender_id', '!=', $userId)
                    ->where('is_read', false)
                    ->count()
            ];
        });

        return response()->json($data);
    }

    public function markMessagesRead($conversationId)
    {
        $userId = session('user')->id;

        Message::where('conversation_id', $conversationId)
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }

    // SELLER

    public function getMessagesSeller(Conversation $conversation)
    {
        $messages = $conversation->messages()->with('sender')->get();

        return response()->json([
            'messages' => $messages
        ]);
    }

    public function sendMessageSeller(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Adjust this based on your actual session key
            $senderId = session('worker')->id ?? session('user')->id ?? null;

            if (!$senderId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized: sender not found.'
                ], 401);
            }

            // Create the message
            $message = Message::create([
                'conversation_id' => $request->conversation_id,
                'sender_id' => $senderId,
                'message' => $request->message
            ]);

            // Load sender relation
            $message->load('sender');

            return response()->json([
                'status' => 'success',
                'message' => $message
            ]);
        } catch (\Exception $e) {
            Log::error('Message sending failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while sending the message.'
            ], 500);
        }
    }


    public function fetchNewMessagesSeller($conversationId)
    {
        $lastId = request('last_message_id');
        $messages = Message::where('conversation_id', $conversationId)
            ->where('id', '>', $lastId)
            ->with('sender')
            ->get();

        return response()->json(['messages' => $messages]);
    }

    public function refreshConversationsSeller()
    {
        $workerId = session('worker')->id;
        $conversations = Conversation::with(['customer', 'messages' => function ($q) {
            $q->latest()->limit(1);
        }])
        ->where('worker_id', $workerId)
        ->latest('updated_at')
        ->get();

        return response()->json($conversations->map(function ($conv) {
            return [
                'id' => $conv->id,
                'name' => $conv->customer->name,
                'last_message' => optional($conv->messages->first())->message ?? 'No message yet',
                'updated_at' => $conv->updated_at->format('M d'),
                'unread_count' => $conv->messages()->where('read', false)->where('sender_id', '!=', session('worker')->id)->count()
            ];
        }));
    }

    public function markMessagesReadSeller(Conversation $conversation)
    {
        $conversation->messages()
            ->where('sender_id', '!=', session('worker')->id)
            ->where('read', false)
            ->update(['read' => true]);

        return response()->json(['status' => 'success']);
    }



    public function startConversation(Request $request)
    {
        $request->validate([
            'worker_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:hf_jobs,job_id',
        ]);

        $clientId = session('user')->id; // Or session('client')->id
        $workerId = $request->worker_id;
        $jobId = $request->job_id;

        // Check if conversation already exists
        $conversation = Conversation::where('client_id', $clientId)
            ->where('worker_id', $workerId)
            ->where('job_id', $jobId)
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'client_id' => $clientId,
                'worker_id' => $workerId,
                'job_id' => $jobId,
                // 'href' => Str::uuid()
            ]);
        }

        return redirect()->route('customer.messages', ['conversation_id' => $conversation->id]);
    }


}
