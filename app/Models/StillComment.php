<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StillComment extends Model
{
    use HasFactory;

    protected $table="still_comments";
    protected $fillable = ['still_id', 'user_id', 'comment']; 

    // Relationship with Still (Each comment belongs to a still)
    public function still()
    {
        return $this->belongsTo(Stills::class, 'still_id');
    }

    // Relationship with User (Each comment belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
