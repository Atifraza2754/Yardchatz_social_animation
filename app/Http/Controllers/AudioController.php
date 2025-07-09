<?php

namespace App\Http\Controllers;

use App\Models\AudioComment;
use App\Models\Audios;
use Illuminate\Http\Request;
use App\Models\AudioCommentLike;
use App\Models\AudioInteraction;
use App\Models\AudioCommentReply;
use Illuminate\Support\Facades\Auth;
use App\Models\AudioPin;

class AudioController extends Controller
{
    
    public function audio_songs()
{
    $userId = auth()->id();

    $media = Audios::with('pins', 'user') 
        ->leftJoin('audio_pins', function ($join) use ($userId) {
            $join->on('audios.id', '=', 'audio_pins.audio_id')
                 ->where('audio_pins.user_id', '=', $userId)
                 ->where('audio_pins.is_pinned', '=', 1);
        })
        ->orderByRaw('CASE WHEN audio_pins.is_pinned = 1 THEN 0 ELSE 1 END') 
        ->orderBy('audios.created_at', 'desc')
        ->select('audios.*')
        ->latest()
        ->get();

    return view('frontend.signal_audio', compact('media'));
}


public function deleteAudio($audioId)
{
    // Find the audio by ID
    $audio = Audios::find($audioId);

    // Check if the audio exists and if the logged-in user is the owner
    if ($audio && $audio->user_id == auth()->id()) {
        // Delete the audio file if it exists on the server
        if (file_exists(public_path($audio->audio))) {
            unlink(public_path($audio->audio));
        }

        // Delete the audio record from the database
        $audio->delete();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}


    public function shared_audio($id)
{
    $item = Audios::findOrFail($id);
    return view('frontend.shared_audio', compact('item'));
}

    /* add audio */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'audio' => 'required|mimes:mp3,wav|max:10240',
        ]);

        $user = auth()->user();

        $image = $request->file('image');
        $imageName = time() . '_image.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/images'), $imageName);


        $audio = $request->file('audio');
        $audioName = time() . '_audio.' . $audio->getClientOriginalExtension();
        $audio->move(public_path('storage/audios'), $audioName);

        Audios::create([
            'user_id' => $user->id,
            'image' => 'storage/images/' . $imageName, // image path
            'audio' => 'storage/audios/' . $audioName, // audio path
        ]);

        return response()->json(['success' => true]);
    }


    public function toggleAudioLike(Request $request)
    {
        $request->validate([
            'audio_id' => 'required|exists:audios,id',
        ]);

        $userId = auth()->id();

        $interaction = AudioInteraction::firstOrCreate(
            ['audio_id' => $request->audio_id, 'user_id' => $userId],
            ['like' => 0, 'comment' => 0]
        );

        $interaction->like = $interaction->like == 1 ? 0 : 1;
        $interaction->save();

        return response()->json([
            'message' => $interaction->like ? 'Like added' : 'Like removed',
            'liked' => (bool) $interaction->like
        ]);
    }


    public function getAudioLikes(Request $request)
    {
        $request->validate([
            'audio_id' => 'required|exists:audios,id',
        ]);

        $audioId = $request->audio_id;
        $userId = auth()->id();

        // Total likes (sum of 1s)
        $likesCount = AudioInteraction::where('audio_id', $audioId)->where('like', 1)->count();

        // Current user's like status
        $userLiked = AudioInteraction::where('audio_id', $audioId)
            ->where('user_id', $userId)
            ->where('like', 1)
            ->exists();

        return response()->json([
            'likes_count' => $likesCount,
            'user_liked' => $userLiked
        ]);
    }


    public function submitComment(Request $request)
    {
        try {
            $request->validate([
                'audio_id' => 'required',
                'comment' => 'required|string|max:1000',
            ]);

            $comment = AudioComment::create([
                'user_id' => auth()->id(),
                'audio_id' => $request->audio_id,
                'comment' => $request->comment,
            ]);

            return response()->json(['message' => 'Comment added!', 'comment' => $comment->load('user')]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!', 'message' => $e->getMessage()], 500);
        }
    }


    public function getAudioCommentsCount(Request $request)
    {
        $request->validate([
            'audio_id' => 'required|exists:audios,id',
        ]);
    
        $commentCount = AudioComment::where('audio_id', $request->audio_id)->count();
    
        return response()->json(['comment_count' => $commentCount]);
    }
    
    

public function getAudioComments(Request $request)
{
    if (!$request->has('audio_id')) {
        return response()->json(['error' => 'audio_id not provided'], 400);
    }

    $audioId = $request->audio_id;

    $comments = AudioComment::where('audio_id', $audioId)
        ->with('user') 
        ->latest()
        ->get();

    return response()->json(['comments' => $comments]);
}

        



public function togglePin(Request $request)
{
    $userId = Auth::id();
    $audioId = $request->audio_id;

    $pin = AudioPin::where('user_id', $userId)
                   ->where('audio_id', $audioId)
                   ->first();

    if ($pin) {
        $pin->is_pinned = !$pin->is_pinned;
        $pin->save();
    } else {
        $pin = AudioPin::create([
            'user_id' => $userId,
            'audio_id' => $audioId,
            'is_pinned' => 1
        ]);
    }

    return response()->json([
        'success' => true,
        'is_pinned' => $pin->is_pinned
    ]);
}


}

?>