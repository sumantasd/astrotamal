<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateScheduleOverride extends Model
{
    protected $fillable = [
        'override_date',
        'opening_time',
        'closing_time',
        'slot_duration_minutes',
        'reason',
        'is_active',
    ];

    protected $casts = [
        'override_date' => 'date',
        'slot_duration_minutes' => 'integer',
        'is_active' => 'boolean',
    ];
}
