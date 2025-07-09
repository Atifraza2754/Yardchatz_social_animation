<?php

namespace App\Http\Controllers;

use App\Models\Stills;
use App\Models\StillPin;
use App\Models\StillComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StillsController extends Controller
{

    public function stills()
{
    $userId = auth()->id();

    $stills = Stills::with('pins', 'likes','user')  // Eager load user to get profile picture
        ->withCount('likes')
        ->leftJoin('still_pins', function ($join) use ($userId) {
            $join->on('stills.id', '=', 'still_pins.still_id')
                 ->where('still_pins.user_id', '=', $userId)
                 ->where('still_pins.is_pinned', '=', 1);
        })
        ->orderByRaw('CASE WHEN still_pins.is_pinned = 1 THEN 0 ELSE 1 END') // pinned first
        ->orderBy('stills.created_at', 'desc')
        ->select('stills.*')
        ->latest()
        ->get();

    return view('frontend.stills', compact('stills'));
}

public function deleteStill($stillId)
{
    $still = Stills::find($stillId);

    if ($still) {
        // Delete the still image file from the server
        if (file_exists(public_path($still->image_path))) {
            unlink(public_path($still->image_path));
        }

        // Delete the still record from the database
        $still->delete();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}


public function shared_still($id)
{
    $images = Stills::findOrFail($id);
    return view('frontend.shared_still', compact('images'));
}

    
   public function store(Request $request)
{
    $request->validate([
        'StillImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'editorContent' => 'nullable|string',
    ]);

    $user = auth()->user();
    $file = $request->file('StillImage');
    $fileName = time() . '_' . $file->getClientOriginalName();

    $uploadPath = public_path('uploads');
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $file->move($uploadPath, $fileName);

    $image = new Stills();
    $image->user_id = $user->id;
    $image->image_path = 'uploads/' . $fileName;
    $image->description = $request->editorContent;
    $image->save();

    return response()->json(['message' => 'Still uploaded successfully.']);
}


    public function likeStills(Request $request, $stillId)
    {
        $still = Stills::find($stillId);

        if ($still) {
            $like = $still->likes()->where('user_id', auth()->id())->first();

            if ($like) {
                $like->delete();
                return response()->json(['message' => 'Like removed', 'is_liked' => false, 'like_count' => $still->getLikeCount()]);
            } else {
                $still->likes()->create([
                    'user_id' => auth()->id(),
                ]);
                return response()->json(['message' => 'Like added', 'is_liked' => true, 'like_count' => $still->getLikeCount()]);
            }
        }

        return response()->json(['message' => 'Still not found'], 404);
    }



    public function submitComment(Request $request)
    {
        try {
            $request->validate([
                'still_id' => 'required',
                'comment' => 'required|string|max:1000',
            ]);

            $comment = StillComment::create([
                'user_id' => auth()->id(),
                'still_id' => $request->still_id,
                'comment' => $request->comment,
            ]);

            return response()->json(['message' => 'Comment added!', 'comment' => $comment->load('user')]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!', 'message' => $e->getMessage()], 500);
        }
    }
    

    public function getStillComments(Request $request)
    {
        // Check if still_id is provided
        if (!$request->has('still_id')) {
            return response()->json(['error' => 'still_id is required'], 400);
        }
    
        $comments = StillComment::where('still_id', $request->still_id)
            ->with(['user']) // Ensure you're eager loading the user relation
            ->latest()
            ->get();
        
            return response()->json(['comments' => $comments]);
    }
    

    public function togglePin(Request $request)
    {
        $userId = Auth::id();
        $stillId = $request->still_id;
    
        $pin = StillPin::where('user_id', $userId)
                       ->where('still_id', $stillId)
                       ->first();
    
        if ($pin) {
            $pin->is_pinned = !$pin->is_pinned;
            $pin->save();
        } else {
            $pin = StillPin::create([
                'user_id' => $userId,
                'still_id' => $stillId,
                'is_pinned' => 1
            ]);
        }
    
        return response()->json([
            'success' => true,
            'is_pinned' => $pin->is_pinned
        ]);
    }
    
}
