<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusTransportation extends Model
{
    protected $fillable = [
        'sangh_id',
        'from',
        'to',
    ];

    public function sangh(): BelongsTo
    {
        return $this->belongsTo(Sangh::class);
    }
} 