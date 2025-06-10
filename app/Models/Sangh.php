<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sangh extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'user_id',
        'sangh_name',
        'sangh_type',
        'sangh_email',
        'whatsapp',
        'sangh_mobile',
        'building_no',
        'building_name',
        'locality',
        'landmark',
        'pincode',
        'district',
        'state',
        'country',
        'jain_family_count',
        'has_pathshala',
        'pathshala_first_name',
        'pathshala_last_name',
        'pathshala_email',
        'pathshala_phone',
        'has_other_sangh',
        'bus_transportation',
        'train_transportation',
        'sangh_address',
        'reason_note',
        'status',
        'age_group',
    ];

    protected $casts = [
        'has_pathshala' => 'boolean',
        'has_other_sangh' => 'boolean',
        'bus_transportation' => 'boolean',
        'train_transportation' => 'boolean',
        'sangh_type' => 'integer',
        'age_group' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trustees(): HasMany
    {
        return $this->hasMany(Trustee::class);
    }

    public function otherSanghs(): HasMany
    {
        return $this->hasMany(OtherSangh::class);
    }

    public function busTransportations(): HasMany
    {
        return $this->hasMany(BusTransportation::class);
    }

    public function trainTransportations(): HasMany
    {
        return $this->hasMany(TrainTransportation::class);
    }
} 