<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'video_path',
    ];

    // In the Video model
public function likes()
{
    return $this->hasMany(Likes::class);
}


// Video model (app/Models/Video.php)

public function user()
{
    return $this->belongsTo(User::class);  // Each video belongs to a user
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

}
