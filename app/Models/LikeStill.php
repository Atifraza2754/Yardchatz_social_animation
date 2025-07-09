<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeStill extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'still_id'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Still
    public function still()
    {
        return $this->belongsTo(Stills::class);
    }

}
