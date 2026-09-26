<?php

namespace App\Http\Controllers;

use App\Models\Horoscope;
use App\Models\HoroscopeForecast;
use Illuminate\Http\Request;

class HoroscopeController extends Controller
{
    public function index()
    {
        $horoscopes = Horoscope::with(['forecasts' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        return view('horoscope.index', compact('horoscopes'));
    }

    public function show($slug, $period = 'daily')
    {
        $period = strtolower($period);
        if (!in_array($period, ['daily', 'weekly', 'monthly', 'yearly'])) {
            $period = 'daily';
        }

        $horoscope = Horoscope::where('slug', $slug)->firstOrFail();
        $allHoroscopes = Horoscope::all();

        // Get forecasts for all 4 periods keyed by period_type
        $forecasts = HoroscopeForecast::where('horoscope_id', $horoscope->id)
            ->where('status', 'published')
            ->get()
            ->keyBy('period_type');

        $currentForecast = $forecasts->get($period) ?? $forecasts->get('daily');

        return view('horoscope.show', compact('horoscope', 'allHoroscopes', 'forecasts', 'period', 'currentForecast'));
    }
}
