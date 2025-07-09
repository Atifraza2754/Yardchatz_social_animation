<?php

use Illuminate\Support\Facades\Broadcast;


/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{receiverId}', function ($user, $receiverId) {
    // Temporary debug: allow all
    return (int) $user->id === (int) $receiverId;
});


Broadcast::channel('video-call', function ($user) {
    return true; 
});

Broadcast::channel('audio-call', function ($user) {
    return true; 
});



Broadcast::channel('live-stream.{hostId}', function ($user, $hostId) {
    return true;
});

Broadcast::channel('signals.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
