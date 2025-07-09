<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function confirmRequest($id) {
        $request = Friendship::where('id', $id)->where('receiver_id', Auth::id())->firstOrFail();
        $request->update(['status' => 'accepted']);

        return response()->json(['message' => 'Friend request accepted']);
    }

    public function rejectRequest($id) {
        $request = Friendship::where('id', $id)->where('receiver_id', Auth::id())->firstOrFail();
        $request->update(['status' => 'rejected']);

        return response()->json(['message' => 'Friend request rejected']);
    }

    public function getFriendRequests() {
        $requests = Friendship::with('sender')->where('receiver_id', Auth::id())->where('status', 'pending')->get();
        return response()->json($requests);
    }

    public function getFriendshipStatus($userId) {
        $authId = Auth::id();

        $friendship = Friendship::where(function ($query) use ($authId, $userId) {
            $query->where('sender_id', $authId)->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($authId, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $authId);
        })->first();

        return response()->json(['status' => $friendship->status ?? 'none']);
    }


 public function sendRequest($id) {
    // Check if request exists first
    $exists = Friendship::where('sender_id', auth()->id())
        ->where('receiver_id', $id)
        ->first();

    if ($exists) {
        return response()->json(['message' => 'Request already exists']);
    }

    Friendship::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $id,
        'status' => 'pending',
    ]);

    return response()->json(['message' => 'Friend request sent']);
}

public function cancelRequest($id) {
    $friendship = Friendship::where('sender_id', auth()->id())
        ->where('receiver_id', $id)
        ->where('status', 'pending')
        ->first();

    if ($friendship) {
        $friendship->delete();
        return response()->json(['message' => 'Friend request canceled']);
    }

    return response()->json(['message' => 'No pending request found']);
}



}

