<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\ViewerJoinedNotification; // Correct namespace



class LiveStreamController extends Controller
{
    public function notifyHostJoined(Request $request)
    {
        $viewerName = $request->input('viewerName');
        $channel = $request->input('channel');

        // Fetch host user based on the channel (assuming `user_{id}` format)
        $hostId = str_replace('user_', '', $channel);
        $host = User::findOrFail($hostId);

        // Send notification to the host via broadcast
        $host->notify(new ViewerJoinedNotification($viewerName, $channel));

        return response()->json(['message' => 'Notification sent']);
    }
}
