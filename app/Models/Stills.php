<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stills extends Model
{
    use HasFactory;
    protected $table= "stills";
    protected $fillable = ['user_id', 'image_path', 'description'];


     public function user()
    {
        return $this->belongsTo(User::class); // Assuming there is a 'user_id' column in the 'stills' table
    }

    public function likes()
    {
        return $this->hasMany(LikeStill::class, 'still_id');
    }

    // Relationship with Users through Likes
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'like_stills', 'still_id', 'user_id');
    }


    public function comments()
    {
        return $this->hasMany(StillComment::class, 'still_id'); // Define relation with StillComment
    }
    

    // Get like count for a still
    public function getLikeCount()
    {
        return $this->likes()->count();
    }


    public function pins()
{
    return $this->hasMany(StillPin::class, 'still_id');
}



}
