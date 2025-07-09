<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioPin extends Model
{
    use HasFactory;
    
    protected $table = "audio_pins";
    protected $fillable = ['user_id', 'audio_id', 'is_pinned'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Audio
    public function audio()
    {
        return $this->belongsTo(Audios::class); // Link to Audio model
    }
}
