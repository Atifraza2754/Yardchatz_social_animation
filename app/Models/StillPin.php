<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StillPin extends Model
{
    use HasFactory;

    
    protected $table = "still_pins";
    protected $fillable = ['user_id', 'still_id', 'is_pinned'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Audio
    public function still()
    {
        return $this->belongsTo(Stills::class); // Link to Audio model
    }
}
