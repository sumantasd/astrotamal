<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedSlot extends Model
{
    protected $fillable = [
        'blocked_date',
        'is_recurring',
        'day_of_week',
        'time_slot',
        'consultation_type',
        'reason',
        'is_active',
    ];

    protected $casts = [
        'blocked_date' => 'date',
        'is_recurring' => 'boolean',
        'is_active' => 'boolean',
    ];
}
