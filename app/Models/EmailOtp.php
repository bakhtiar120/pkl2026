<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmailOtp extends Model
{
    use HasFactory;

    protected $table = 'email_otps';

    protected $fillable = [
        'id',
        'user_id',
        'otp',
        'expires_at',
        'attempts',
        'last_sent_at', 
        'resend_count',
        'blocked_until',
    ];
    protected $casts = [
    'expires_at' => 'datetime',
    'last_sent_at' => 'datetime',
    'blocked_until' => 'datetime',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}