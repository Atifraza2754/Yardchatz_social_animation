<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audios extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'audio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function interactions()
{
    return $this->hasMany(AudioInteraction::class, 'audio_id');
}

public function comments()
{
    return $this->hasMany(AudioComment::class);
}

public function pins()
{
    return $this->hasMany(AudioPin::class, 'audio_id');
}



}
