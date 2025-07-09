<?php

namespace App\Models;

use App\Models\TextPin;
use App\Models\LikeTextFrame;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Text extends Model
{
    use HasFactory;
    protected $table= "text_in_frame";
    protected $fillable = ['text_in_image'];

        public function user()
    {
        return $this->belongsTo(User::class); // Make sure 'user_id' exists in your 'texts' table
    }

    public function likes()
    {
        return $this->hasMany(LikeTextFrame::class, 'text_id');
    }

    // Relationship with Users through Likes
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'like_text_frame', 'text_id', 'user_id');
    }


    public function comments()
    {
        return $this->hasMany(TextFrameComment::class); // Define relation with StillComment
    }
    

    // Get like count for a still
    public function getLikeCount()
    {
        return $this->likes()->count();
    }


    public function pins()
{
    return $this->hasMany(TextPin::class, 'text_id');
}
}
