<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
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
        'confirmed_email_sent_at',
        'failed_email_sent_at',
        'expired_email_sent_at',
        'reminder_24h_sent_at',
        'reminder_1h_sent_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'birth_date' => 'date',
        'preferred_date' => 'date',
        'amount' => 'decimal:2',
        'slot_reserved_until' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'confirmed_email_sent_at' => 'datetime',
        'failed_email_sent_at' => 'datetime',
        'expired_email_sent_at' => 'datetime',
        'reminder_24h_sent_at' => 'datetime',
        'reminder_1h_sent_at' => 'datetime',
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
