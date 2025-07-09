<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HangupAudioCall implements ShouldBroadcast
{

    public $receiverId;

    public function __construct($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    public function broadcastOn()
    {
        return new Channel('audio-call');
    }

    public function broadcastAs()
    {
        return 'audio-hangup';
    }

}
