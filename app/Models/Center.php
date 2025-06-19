<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'center_name',
        'status',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function eventAssignments()
    {
        return $this->hasMany(\App\Models\EventCenterAssignment::class);
    }
} 