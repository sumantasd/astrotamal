<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    protected $fillable = [
        'booking_reference',
        'name',
        'email',
        'phone',
        'whatsapp',
        'birth_date',
        'birth_time',
        'birth_place',
        'service_id',
        'consultation_type',
        'consultation_mode',
        'amount',
        'preferred_date',
        'preferred_time',
        'notes',
        'admin_notes',
        'status',
        'payment_status',
        'payment_method',
        'payment_reference',
        'slot_reserved_until',
        'completed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'preferred_date' => 'date',
        'amount' => 'decimal:2',
        'slot_reserved_until' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(PaymentTransaction::class);
    }
}
