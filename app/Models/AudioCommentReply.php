<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioCommentReply extends Model
{
    use HasFactory;
    protected $table = 'audio_comment_replies'; // ✅ force table name


    protected $fillable = [
        'user_id',
        'comment_id',
        'reply',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
