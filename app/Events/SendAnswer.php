<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class SendAnswer implements ShouldBroadcast
{
    use SerializesModels;

    public $type;
    public $sdp;

    public function __construct($answer)
    {
        $this->type = $answer['type'];
        $this->sdp = $answer['sdp'];
    }

    public function broadcastWith()
    {
        return [
            'type' => $this->type,
            'sdp' => $this->sdp
        ];
    }

    public function broadcastAs()
    {
        return 'answer';
    }

    public function broadcastOn()
    {
        return new Channel('video-call');
    }
}
