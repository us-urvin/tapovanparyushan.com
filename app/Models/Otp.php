<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Otp extends Model
{
    protected $fillable = [
        'user_id',
        'mobile',
        'otp',
        'expires_at',
        'is_used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool
    {
        return !$this->is_used && $this->expires_at->isFuture();
    }
} 