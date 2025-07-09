<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallRecording extends Model
{
    use HasFactory;
    protected $fillable = ['caller_id', 'receiver_id', 'file_path', 'duration'];
    protected $table="video_call_recordings";

}
