<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioCommentLike extends Model
{
    use HasFactory;

    protected $table = "audio_comment_likes";
    
    protected $fillable = [
        'user_id',
        'audio_comment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the AudioComment model
    public function comment()
    {
        return $this->belongsTo(AudioComment::class, 'audio_comment_id');  // Correctly refer to 'audio_comment_id'
    }
}
