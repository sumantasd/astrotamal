<?php

namespace Database\Seeders;

use App\Models\Horoscope;
use App\Models\HoroscopeForecast;
use Illuminate\Database\Seeder;

class HoroscopeForecastSeeder extends Seeder
{
    public function run(): void
    {
        $signs = Horoscope::all();

        $periods = ['daily', 'weekly', 'monthly', 'yearly'];

        foreach ($signs as $sign) {
            foreach ($periods as $period) {
                $periodStart = match ($period) {
                    'daily' => now()->startOfDay(),
                    'weekly' => now()->startOfWeek(),
                    'monthly' => now()->startOfMonth(),
                    'yearly' => now()->startOfYear(),
                };

                $periodEnd = match ($period) {
                    'daily' => now()->endOfDay(),
                    'weekly' => now()->endOfWeek(),
                    'monthly' => now()->endOfMonth(),
                    'yearly' => now()->endOfYear(),
                };

                $periodLabel = ucfirst($period);
                $title = "{$sign->zodiac_sign} {$periodLabel} Horoscope & Planetary Guidance — 2026";

                HoroscopeForecast::updateOrCreate(
                    [
                        'horoscope_id' => $sign->id,
                        'period_type' => $period,
                    ],
                    [
                        'period_start' => $periodStart,
                        'period_end' => $periodEnd,
                        'title' => $title,
                        'summary' => "Official traditional {$periodLabel} Jyotish evaluation for {$sign->zodiac_sign} (Ruling Planet: {$sign->ruling_planet}, Element: {$sign->element}).",
                        'overview' => "During this {$period} period, {$sign->ruling_planet} transits and house aspects highlight important decision-making phases for {$sign->zodiac_sign}. Key focus rests on balancing personal conviction with professional responsibilities.",
                        'career' => "Professional endeavors for {$sign->zodiac_sign} receive favorable planetary aspects during this {$period} cycle. Focus on structured execution and clear communication with stakeholders.",
                        'finance' => "Financial indicators suggest prudent budgeting and strategic resource management during this {$period}. Avoid speculative risks and prioritize long-term stability.",
                        'love' => "Relationship dynamics foster mutual understanding and empathetic communication. Single individuals may experience meaningful connections through shared interests.",
                        'health' => "Maintain balanced daily routines, proper hydration, and restful sleep cycles to sustain vitality during active planetary phases.",
                        'education' => "Favorable alignment for academic focus, competitive preparation, and acquiring specialized knowledge under {$sign->ruling_planet}'s influence.",
                        'family' => "Domestic atmosphere remains supportive with constructive discussions regarding household initiatives and family wellbeing.",
                        'travel' => "Short-distance transit journeys or planned travel bring fresh perspective and productive outcomes.",
                        'important_dates' => "Key astrological transition dates during this {$period} phase: " . now()->format('M d') . ", " . now()->addDays(5)->format('M d') . ", and " . now()->addDays(12)->format('M d') . ".",
                        'advice' => "Approach decisions with patience and clarity. Align your actions with your core values rather than short-term impulses.",
                        'lucky_day' => match ($sign->ruling_planet) {
                            'Mars' => 'Tuesday',
                            'Venus' => 'Friday',
                            'Mercury' => 'Wednesday',
                            'Moon' => 'Monday',
                            'Sun' => 'Sunday',
                            'Jupiter' => 'Thursday',
                            'Saturn' => 'Saturday',
                            default => 'Thursday',
                        },
                        'lucky_colour' => $sign->lucky_color,
                        'lucky_number' => $sign->lucky_number,
                        'planetary_influence' => "Transits of {$sign->ruling_planet}, Jupiter, and Saturn in relation to the {$sign->zodiac_sign} Moon sign (Chandra Rashi).",
                        'transit_context' => "Vedic Sidereal Gochar framework evaluated for current 2026 planetary movements.",
                        'disclaimer' => "Horoscope readings are presented from a traditional astrological perspective and are intended for general guidance and reflection. They should not be treated as certainty or as a substitute for professional medical, legal or financial advice.",
                        'status' => 'published',
                        'featured' => true,
                        'seo_title' => "{$sign->zodiac_sign} {$periodLabel} Horoscope 2026 — Vedic Guidance | Tamal Chakraborty",
                        'seo_description' => "Read the official 2026 {$periodLabel} horoscope for {$sign->zodiac_sign}. Explore career, finance, love, health, and planetary transit insights.",
                        'published_at' => now(),
                    ]
                );
            }
        }
    }
}
