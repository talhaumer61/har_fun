<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function customer_messages()
    {
        $userId = session('user')->id;

        $conversations = Conversation::with(['worker', 'messages' => function ($q) {
            $q->latest()->limit(1); // Only fetch the latest message
        }])
        ->where('client_id', $userId)
        ->orderByDesc('updated_at')
        ->get();

        // Append unread count to each conversation
        foreach ($conversations as $conv) {
            $conv->unread_count = \App\Models\Message::where('conversation_id', $conv->id)
                ->where('sender_id', '!=', $userId)
                ->where('is_read', false)
                ->count();
        }

        return view('site.customer.customer_messages', compact('conversations'));
    }

    public function seller_messages()
    {
        $workerId = session('user')->id;

        $conversations = Conversation::with(['client', 'messages' => function ($q) {
            $q->latest()->limit(1); // Only fetch the latest message
        }])
        ->where('worker_id', $workerId)
        ->orderByDesc('updated_at')
        ->get();

        // Append unread count to each conversation
        foreach ($conversations as $conv) {
            $conv->unread_count = Message::where('conversation_id', $conv->id)
                ->where('sender_id', '!=', $workerId)
                ->where('is_read', false)
                ->count();
        }

        return view('site.seller.seller_messages', compact('conversations'));
    }


}
