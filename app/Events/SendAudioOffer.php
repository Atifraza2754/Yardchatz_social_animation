<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendAudioOffer implements ShouldBroadcast
{
    public $type;
    public $sdp;
    public $from_user_id;
    public $receiver_id;
    public $caller_name;
    public $caller_picture;
    public $caller_ringtone;
    public $receiver_ringtone;

    public function __construct($offer)
    {
        $this->type = Arr::get($offer, 'type');
        $this->sdp = Arr::get($offer, 'sdp');
        $this->from_user_id = auth()->id();
        $this->receiver_id = Arr::get($offer, 'receiver_id');

        $user = User::find($this->from_user_id); // Caller
        $receiver = User::find($this->receiver_id); // Receiver

        $this->caller_name = $user->name ?? 'Unknown';
        $this->caller_picture = $user->profile_picture ?? null;
        $this->caller_ringtone = $user->ringtone ?? null;
        $this->receiver_ringtone = $receiver->ringtone ?? null;
    }

    public function broadcastWith()
    {
        return [
            'type' => $this->type,
            'sdp' => $this->sdp,
            'from_user_id' => $this->from_user_id,
            'receiver_id' => $this->receiver_id,
            'caller_name' => $this->caller_name,
            'caller_picture' => $this->caller_picture,
            'caller_ringtone' => $this->caller_ringtone,
            'receiver_ringtone' => $this->receiver_ringtone,
            'call_type' => 'audio'
        ];
    }

    public function broadcastAs()
    {
        return 'audio-offer';
    }

    public function broadcastOn()
    {
        return new Channel('audio-call');
    }
}
