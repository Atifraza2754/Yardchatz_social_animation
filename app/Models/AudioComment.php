<?php

namespace App\Models;

use FFMpeg\Media\Audio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioComment extends Model
{
    use HasFactory;
    protected $table = "audio_comments";

    protected $fillable = [
        'user_id',
        'audio_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function audio()
    {
        return $this->belongsTo(Audio::class);
    }
     
    
    public function likes()
    {
        return $this->hasMany(AudioCommentLike::class, 'audio_comment_id');
    }
    
    public function replies()
    {
        return $this->hasMany(AudioCommentReply::class, 'comment_id');
    }
    

}
