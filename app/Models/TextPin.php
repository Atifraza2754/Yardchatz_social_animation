<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextPin extends Model
{
    protected $table = "text_pins";
    protected $fillable = ['user_id', 'text_id', 'is_pinned'];
    use HasFactory;

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function text()
    {
        return $this->belongsTo(Text::class);
    }
}
