<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherSangh extends Model
{
    protected $fillable = [
        'sangh_id',
        'particulars',
        'no_of_members',
        'no_of_jain_families',
    ];

    protected $casts = [
        'particulars' => 'integer',
        'no_of_members' => 'integer',
        'no_of_jain_families' => 'integer',
    ];

    public function sangh(): BelongsTo
    {
        return $this->belongsTo(Sangh::class);
    }
} 