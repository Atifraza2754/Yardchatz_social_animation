<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'audio_id',
        'user_id',
        'like',
        'comment',
    ];

    // 🔁 Relation to Audio
    public function audio()
    {
        return $this->belongsTo(Audios::class, 'audio_id');
    }

    // 🔁 Relation to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
