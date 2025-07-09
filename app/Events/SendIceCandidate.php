<?php

namespace App\Events;

use Illuminate\Support\Arr;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendIceCandidate implements ShouldBroadcast
{
    use SerializesModels;

    public $candidate;
    public $sdpMid;
    public $sdpMLineIndex;

    public function __construct($candidate)
    {
        $this->candidate = Arr::get($candidate, 'candidate');
        $this->sdpMid = Arr::get($candidate, 'sdpMid');
        $this->sdpMLineIndex = Arr::get($candidate, 'sdpMLineIndex');
    }

    public function broadcastWith()
    {
        return [
            'candidate' => $this->candidate,
            'sdpMid' => $this->sdpMid,
            'sdpMLineIndex' => $this->sdpMLineIndex
        ];
    }

    public function broadcastAs()
    {
        return 'ice-candidate';
    }

    public function broadcastOn()
    {
        return new Channel('video-call');
    }
}