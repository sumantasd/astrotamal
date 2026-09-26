<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Horoscope extends Model
{
    protected $fillable = [
        'zodiac_sign',
        'slug',
        'symbol',
        'element',
        'date_range',
        'ruling_planet',
        'lucky_number',
        'lucky_color',
        'overview',
        'daily_prediction',
        'weekly_prediction',
        'monthly_prediction',
    ];

    public function forecasts(): HasMany
    {
        return $this->hasMany(HoroscopeForecast::class);
    }
}
