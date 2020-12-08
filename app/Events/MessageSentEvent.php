<?php

namespace App\Events;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class MessageSentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $account;
    public $chat_id;

    public function __construct(Messages $message, User $user, $chat_id)
    {
        $this->message = $message;
        $this->account = $user;
        $this->chat_id = $chat_id;
    }

    public function broadcastOn()
    {
        return new Channel('chat-' . $this->chat_id);
    }
}
