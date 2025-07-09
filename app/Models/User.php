<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Stills;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = ['dob'];

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_picture',
        'id_card',
        'privacy_setting',
        'workplace', 
        'school', 
        'Pensacola', 
        'loves',
        'home_town', 'current_city',
        'favorite_song', 
        'employer', 
        'job_title',
        'ringtone'
    ];
   

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // User model (app/Models/User.php)

public function videos()
{
    return $this->hasMany(Video::class);  
}

public function audios()
{
    return $this->hasMany(Audios::class); 
}

public function text()
{
    return $this->hasMany(Text::class); 
}

public function still()
{
    return $this->hasMany(Stills::class);  
}

// User.php
public function favoriteVideos()
{
    return $this->belongsToMany(Video::class, 'favourites', 'user_id', 'video_id')->withTimestamps();
}


// app/Models/User.php

public function sentFriendRequests() {
    return $this->hasMany(Friendship::class, 'sender_id');
}

public function receivedFriendRequests() {
    return $this->hasMany(Friendship::class, 'receiver_id');
}

public function friends() {
    return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
                ->wherePivot('status', 'accepted')
                ->withTimestamps();
}


public function messages()
{
    return $this->hasMany(Message::class);
}

public function sentMessages()
{
    return $this->hasMany(Message::class, 'sender_id');
}

public function receivedMessages()
{
    return $this->hasMany(Message::class, 'receiver_id');
}

}
