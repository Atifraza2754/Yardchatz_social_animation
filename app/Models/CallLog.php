<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    protected $fillable = [
        'caller_id',
        'receiver_id',
        'call_type',
        'status',
        'duration',
        'started_at',
        'ended_at',
    ];

    public function caller()
    {
        return $this->belongsTo(User::class, 'caller_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    
}
