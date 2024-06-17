<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;



class MessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $isStatusUpdate;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $isStatusUpdate = false)
    {
        $this->message = $message;
        $this->isStatusUpdate = $isStatusUpdate;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat'),
        ];
    }

    public function broadcastWith()
    {
        if ($this->isStatusUpdate) {
            return [
                'message_id' => $this->message->message_id,
                'status' => $this->message->status,
            ];
        }

        return [
            'message' => $this->message->toArray(),
        ];
    }
}
