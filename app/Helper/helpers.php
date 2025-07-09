<?php

use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

if (!function_exists('canViewProfile')) {
    function canViewProfile($viewer, $profileOwner)
    {
        if ($viewer->id === $profileOwner->id) return true;

        if ($profileOwner->privacy_setting === 'everyone') return true;

        if ($profileOwner->privacy_setting === 'nobody') return false;

        if ($profileOwner->privacy_setting === 'friends') {
            return Friendship::where(function ($q) use ($viewer, $profileOwner) {
                $q->where('sender_id', $viewer->id)->where('receiver_id', $profileOwner->id);
            })->orWhere(function ($q) use ($viewer, $profileOwner) {
                $q->where('sender_id', $profileOwner->id)->where('receiver_id', $viewer->id);
            })->where('status', 'accepted')->exists();
        }

        return false;
    }
}
