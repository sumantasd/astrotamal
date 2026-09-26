<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HoroscopeForecast extends Model
{
    protected $fillable = [
        'horoscope_id',
        'period_type',
        'period_start',
        'period_end',
        'title',
        'summary',
        'overview',
        'career',
        'finance',
        'love',
        'health',
        'education',
        'family',
        'travel',
        'important_dates',
        'advice',
        'lucky_day',
        'lucky_colour',
        'lucky_number',
        'planetary_influence',
        'transit_context',
        'disclaimer',
        'status',
        'featured',
        'seo_title',
        'seo_description',
        'og_image',
        'published_at',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'published_at' => 'datetime',
        'featured' => 'boolean',
    ];

    public function horoscope(): BelongsTo
    {
        return $this->belongsTo(Horoscope::class);
    }
}
