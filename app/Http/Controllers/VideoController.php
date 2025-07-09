<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Video;
use App\Models\Audios;
use App\Models\Stills;
use App\Models\Text;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Friendship;
use App\Models\CommentLike;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    //get videos,audios,stills and text for auth user
    public function  preview_video()
    {

        $videos = Video::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        $audio = Audios::where('user_id', auth()->id()) 
            ->orderBy('created_at', 'desc') 
            ->get();

        $stills = Stills::where('user_id', auth()->id()) 
            ->orderBy('created_at', 'desc') 
            ->get();

        $text = Text::where('user_id', auth()->id()) 
            ->orderBy('created_at', 'desc') 
            ->get();
                    

        $user = Auth::user(); // Logged-in user

        $friendRequests = Friendship::with('sender')
            ->where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->get();

        return view('frontend.preview_video', compact('videos','audio','stills','text','friendRequests','user'));
    }

    // upload video
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:mp4,mov,avi,webm|max:51200', // 50MB max
        ]);

        $user = auth()->user();

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();


        $file->move(public_path('storage/videos'), $filename);

        Video::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'video_path' => 'storage/videos/' . $filename, 
        ]);

        return response()->json(['success' => true]);
    }

    // get video in live play page 
    public function live_page_videos()
    {
        $videos = Video::with('user')
            ->where('user_id', '!=', auth()->id())
            ->latest()
            ->get();
    
        return view('frontend.live_page', compact('videos'));
    }

    //view video in share link
    public function show($id){
        $videos = Video::with('user')
        ->findOrFail($id); 
        return view('frontend.show_shared_video', compact('videos'));
    }

    //store comments
    public function store_comment(Request $request)
    {
        $request->validate([
            'video_id' => 'required|exists:videos,id',
            'comment' => 'required|string'
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'video_id' => $request->video_id,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Comment added!', 'comment' => $comment->load('user')]);
    }

    //get comments
    public function getComments(Request $request)
    {
        // Fetch comments along with the number of replies and likes for each comment
        $comments = Comment::where('video_id', $request->video_id)
            ->with('user') // Get the user associated with each comment
            ->withCount(['replies', 'likes'])  // This will add `replies_count` and `likes_count` attributes to each comment
            ->latest() // Fetch the comments in the latest order
            ->get();
    
        // Add additional information (like whether the user has liked the comment)
        foreach ($comments as $comment) {
            // Check if the current user has liked this comment
            $comment->user_has_liked = $comment->likes->contains('user_id', auth()->id());
        }
    
        return response()->json(['comments' => $comments]);
    }

    //like commment
    public function toggleCommentLike(Request $request)
    {
        $request->validate([
            'comment_id' => 'required',
        ]);

        // Check if the user has already liked the comment
        $existingLike = CommentLike::where('comment_id', $request->comment_id)
                                    ->where('user_id', auth()->id())
                                    ->first();

        if ($existingLike) {
            // If the user has already liked, remove the like (dislike)
            $existingLike->delete();
            return response()->json(['message' => 'Like removed', 'liked' => false]);
        } else {
            // If the user has not liked the comment, add a like
            CommentLike::create([
                'user_id' => auth()->id(),
                'comment_id' => $request->comment_id,
            ]);
            return response()->json(['message' => 'Like added', 'liked' => true]);
        }
    }

    //get comment likes count
    public function getCommentLikes(Request $request)
    {
        $likesCount = CommentLike::where('comment_id', $request->comment_id)->count();
        $userLiked = CommentLike::where('comment_id', $request->comment_id)
                                ->where('user_id', auth()->id())
                                ->exists();
        
        return response()->json(['likes_count' => $likesCount, 'user_liked' => $userLiked]);
    }

    // send comment reply
    public function addReply(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'comment_id' => 'required',  // Ensure the comment exists
            'reply_text' => 'required|string',  // Ensure reply_text is provided
        ]);
    
        // Create the new reply
        $reply = CommentReply::create([
            'comment_id' => $request->comment_id,
            'user_id' => auth()->id(),
            'reply_text' => $request->reply_text,
        ]);
    
        // Return the newly created reply with the user data
        return response()->json([
            'success' => true,
            'reply' => $reply->load('user')  // Include the user who made the reply
        ]);
    }

    //get reply of comment 
    public function getReplies($commentId)
    {
        // Fetch all replies for the specific comment
        $replies = CommentReply::with('user')
            ->where('comment_id', $commentId)
            ->latest()
            ->get();

        return response()->json(['replies' => $replies]);
    }

    // Like video
    public function toggleLike(Request $request)
    {
        $request->validate([
            'video_id' => 'required|exists:videos,id',
        ]);

        // Check if the user has already liked the video
        $existingLike = Likes::where('video_id', $request->video_id)
                            ->where('user_id', auth()->id())
                            ->first();

        if ($existingLike) {
            // If the user has already liked, remove the like (dislike)
            $existingLike->delete();
            return response()->json(['message' => 'Like removed', 'liked' => false]);
        } else {
            // If the user has not liked the video, add a like
            Likes::create([
                'user_id' => auth()->id(),
                'video_id' => $request->video_id,
            ]);
            return response()->json(['message' => 'Like added', 'liked' => true]);
        }
    }

    // get video like count
    public function getLikes(Request $request)
    {
        $likesCount = Likes::where('video_id', $request->video_id)->count();
        $userLiked = Likes::where('video_id', $request->video_id)
                        ->where('user_id', auth()->id())
                        ->exists();
        
        return response()->json(['likes_count' => $likesCount, 'user_liked' => $userLiked]);
    }

    // make vidoe favorite
    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'video_id' => 'required|exists:videos,id',
        ]);

        $existingFavorite =  Favourite::where('video_id', $request->video_id)
                                    ->where('user_id', auth()->id())
                                    ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json(['message' => 'Favorite removed', 'favorited' => false]);
        } else {
            Favourite::create([
                'user_id' => auth()->id(),
                'video_id' => $request->video_id,
            ]);
            return response()->json(['message' => 'Favorite added', 'favorited' => true]);
        }
    }

    //get favorte videos
    public function getFavorites(Request $request)
    {
        $favoritesCount =  Favourite::where('video_id', $request->video_id)->count();
        $userFavorited =  Favourite::where('video_id', $request->video_id)
                                ->where('user_id', auth()->id())
                                ->exists();
        
        return response()->json(['favorites_count' => $favoritesCount, 'user_favorited' => $userFavorited]);
    }

    //get favorite videos on profile
    public function fetchFavoriteVideos()
    {
        $user = auth()->user(); // ya jis tarah bhi user ko identify karte ho

        $favoriteVideos = $user->favoriteVideos()->latest()->get();

        return response()->json([
            'status' => true,
            'videos' => $favoriteVideos
        ]);

    }
    
    // delete own upload video
    public function deleteVideo($videoId)
    {
        $video = Video::find($videoId);

        if ($video && $video->user_id == auth()->id()) {

            $videoPath = $video->video_path;

            $filePath = public_path($videoPath); 

            if (file_exists($filePath)) {

                $deleted = unlink($filePath);

                if (!$deleted) {
                    return response()->json(['success' => false, 'message' => 'Failed to delete the video file. Please try again.'], 500);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Video file not found.'], 404);
            }

            $video->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Video not found or unauthorized.'], 400);
    }

}
