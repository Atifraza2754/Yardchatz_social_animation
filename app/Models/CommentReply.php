<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;
    protected $table = "comment_replies";
    protected $fillable = [
        'user_id',
        'comment_id',
        'reply_text'
    ];

    // In CommentReply model
public function user()
{
    return $this->belongsTo(User::class);
}

}
