<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextFrameComment extends Model
{
    use HasFactory;
    protected $fillable = ['text_id', 'user_id', 'comment']; // Allow these fields to be mass-assigned

    public function text()
    {
        return $this->belongsTo(Text::class);
    }

    // Relationship with User (Each comment belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
