<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\User;
use App\Models\Message;
use App\Models\MessageRoom;

class TodoAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $todo;

    public function __construct(Message $message, MessageRoom $messageroom, User $user)
    {
        $this->todo = $todo;
    }

    public function broadcastOn()
    {
        return new Channel('to-added-channel',$this->todo);
    }
}
