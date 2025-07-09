<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeTextFrame extends Model
{
    use HasFactory;

    protected $table ="like_text_frame";
    protected $fillable = ['user_id', 'text_id'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Still
    public function text()
    {
        return $this->belongsTo(Text::class);
    }

}
