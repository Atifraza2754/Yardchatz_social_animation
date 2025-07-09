<?php

namespace App\Http\Controllers;

use App\Models\Text;
use App\Models\TextPin;
use Illuminate\Http\Request;
use App\Models\TextFrameComment;
use Illuminate\Support\Facades\Auth;

class UploadText_Controller extends Controller
{

public function text_upload()
{
    $userId = auth()->id();

    $text = Text::with('pins', 'likes', 'user')  // Eager load user to get profile picture
        ->withCount('likes')
        ->leftJoin('text_pins', function ($join) use ($userId) {
            $join->on('text_in_frame.id', '=', 'text_pins.text_id')
                 ->where('text_pins.user_id', '=', $userId)
                 ->where('text_pins.is_pinned', '=', 1);
        })
        ->orderByRaw('CASE WHEN text_pins.is_pinned = 1 THEN 0 ELSE 1 END') // pinned first
        ->orderBy('text_in_frame.created_at', 'desc')
        ->select('text_in_frame.*')
        ->latest()
        ->get();

    return view('frontend.text_upload', compact('text'));
}

    public function store(Request $request)
{
    $request->validate([
        'editorContent' => 'nullable|string',
    ]);

    $user = auth()->user();

    $image = new Text();
    $image->user_id = $user->id;
    $image->text_in_image = $request->editorContent;
    $image->save();

    return response()->json(['message' => 'Text uploaded successfully.']);
}


    public function shared_Text($id)
    {
        $frame = Text::findOrFail($id);
        return view('frontend.share_text', compact('frame'));
    }

    
    public function likeText(Request $request, $textId)
    {
        $text = Text::find($textId);

        if ($text) {
            // Check if user has already liked this text
            $like = $text->likes()->where('user_id', auth()->id())->first();

            if ($like) {
                // If already liked, remove like
                $like->delete();
                return response()->json(['message' => 'Like removed', 'is_liked' => false, 'like_count' => $text->getLikeCount()]);
            } else {
                // If not liked, add like
                $text->likes()->create([
                    'user_id' => auth()->id(),
                ]);
                return response()->json(['message' => 'Like added', 'is_liked' => true, 'like_count' => $text->getLikeCount()]);
            }
        }

        return response()->json(['message' => 'text not found'], 404);
    }



    public function submitComment(Request $request)
    {
        try {
            $request->validate([
                'text_id' => 'required',
                'comment' => 'required|string|max:1000',
            ]);

            $comment = TextFrameComment::create([
                'user_id' => auth()->id(),
                'text_id' => $request->text_id,
                'comment' => $request->comment,
            ]);

            return response()->json(['message' => 'Comment added!', 'comment' => $comment->load('user')]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!', 'message' => $e->getMessage()], 500);
        }
    }
    

    public function getComments(Request $request)
    {
        $comments = TextFrameComment::where('text_id', $request->text_id)
            ->with('user') 
            ->latest()
            ->get();

            return response()->json(['comments' => $comments]);
    }


    public function togglePin(Request $request)
    {
        $userId = Auth::id();
        $textId = $request->text_id;
    
        $pin = TextPin::where('user_id', $userId)
                       ->where('text_id', $textId)
                       ->first();
    
        if ($pin) {
            $pin->is_pinned = !$pin->is_pinned;
            $pin->save();
        } else {
            $pin = TextPin::create([
                'user_id' => $userId,
                'text_id' => $textId,
                'is_pinned' => 1
            ]);
        }
    
        return response()->json([
            'success' => true,
            'is_pinned' => $pin->is_pinned
        ]);
    }
    
    public function deleteText($textId)
{
    $text = Text::find($textId);

    if ($text) {
        // Delete the image file from the server
        if (file_exists(public_path($text->text_in_image))) {
            unlink(public_path($text->text_in_image));
        }

        // Delete the text record from the database
        $text->delete();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}


}
