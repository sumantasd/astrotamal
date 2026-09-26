<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'birth_time',
        'birth_place',
        'service_id',
        'preferred_date',
        'preferred_time',
        'notes',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'preferred_date' => 'date',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
