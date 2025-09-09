<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Broadcasting\ShouldBroadcastNow; // ✅ Add this
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcastNow // ✅ Ensure it implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        Log::info('🚀 Broadcasting MessageSent event:', ['message' => $message->toArray()]);
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->receiver_id);
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
}
