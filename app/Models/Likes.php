<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $table= "video_likes";

    protected $fillable = [
        
        'user_id',
        'video_id',
        'like',
    ];


      // Define relationships with the Video and User models
      public function video()
      {
          return $this->belongsTo(Video::class);
      }
  
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
