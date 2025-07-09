<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table="video_comments";

protected $fillable = [
    'user_id',
    'video_id', 
    'comment', 
];

public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }


    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class); // Defines the relationship to the CommentLike model
    }
    
}