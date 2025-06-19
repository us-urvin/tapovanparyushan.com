<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCenterAssignment extends Model
{
    protected $fillable = [
        'event_id',
        'center_id',
        'assigned_by',
        'status',
        'note',
        'assigned_at',
        'responded_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
