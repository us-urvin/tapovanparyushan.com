<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PathshalaTeacher extends Model
{
    protected $fillable = [
        'sangh_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function sangh(): BelongsTo
    {
        return $this->belongsTo(Sangh::class);
    }
} 