<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HangupCall implements ShouldBroadcast
{

    public $receiverId;

    public function __construct($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    
    public function broadcastOn()
    {
        return new Channel('video-call');
    }

    public function broadcastAs()
    {
        return 'hangup';
    }
}


?>