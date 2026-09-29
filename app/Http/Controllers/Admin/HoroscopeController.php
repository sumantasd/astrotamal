<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horoscope;
use App\Models\HoroscopeForecast;
use Illuminate\Http\Request;

class HoroscopeController extends Controller
{
    public function index(Request $request)
    {
        $query = HoroscopeForecast::with('horoscope');

        if ($request->filled('period_type')) {
            $query->where('period_type', $request->period_type);
        }

        if ($request->filled('horoscope_id')) {
            $query->where('horoscope_id', $request->horoscope_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $forecasts = $query->latest('updated_at')->paginate(12)->withQueryString();
        $horoscopes = Horoscope::orderBy('id')->get();
        $selectedPeriod = $request->period_type ?? 'all';

        return view('admin.horoscopes.index', compact('forecasts', 'horoscopes', 'selectedPeriod'));
    }

    public function create(Request $request)
    {
        $horoscopes = Horoscope::orderBy('id')->get();
        $defaultSignId = $request->horoscope_id ?? ($horoscopes->first()->id ?? null);
        $defaultPeriod = $request->period_type ?? 'daily';

        return view('admin.horoscopes.create', compact('horoscopes', 'defaultSignId', 'defaultPeriod'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'horoscope_id' => 'required|exists:horoscopes,id',
            'period_type' => 'required|in:daily,weekly,monthly,yearly',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:1000',
            'overview' => 'nullable|string',
            'career' => 'nullable|string',
            'finance' => 'nullable|string',
            'love' => 'nullable|string',
            'health' => 'nullable|string',
            'advice' => 'nullable|string',
            'lucky_day' => 'nullable|string|max:100',
            'lucky_colour' => 'nullable|string|max:100',
            'lucky_number' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'featured' => 'boolean',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
        ]);

        $validated['featured'] = $request->has('featured');
        if ($validated['status'] === 'published' && empty($request->published_at)) {
            $validated['published_at'] = now();
        }

        HoroscopeForecast::create($validated);

        return redirect()->route('admin.horoscopes.index')
            ->with('status', 'Horoscope forecast created successfully.');
    }

    public function edit(HoroscopeForecast $horoscopeForecast)
    {
        $horoscopes = Horoscope::orderBy('id')->get();
        return view('admin.horoscopes.edit', compact('horoscopeForecast', 'horoscopes'));
    }

    public function update(Request $request, HoroscopeForecast $horoscopeForecast)
    {
        $validated = $request->validate([
            'horoscope_id' => 'required|exists:horoscopes,id',
            'period_type' => 'required|in:daily,weekly,monthly,yearly',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:1000',
            'overview' => 'nullable|string',
            'career' => 'nullable|string',
            'finance' => 'nullable|string',
            'love' => 'nullable|string',
            'health' => 'nullable|string',
            'advice' => 'nullable|string',
            'lucky_day' => 'nullable|string|max:100',
            'lucky_colour' => 'nullable|string|max:100',
            'lucky_number' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'featured' => 'boolean',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
        ]);

        $validated['featured'] = $request->has('featured');
        if ($validated['status'] === 'published' && !$horoscopeForecast->published_at) {
            $validated['published_at'] = now();
        }

        $horoscopeForecast->update($validated);

        return redirect()->route('admin.horoscopes.index')
            ->with('status', 'Horoscope forecast updated successfully.');
    }

    public function destroy(HoroscopeForecast $horoscopeForecast)
    {
        $horoscopeForecast->delete();
        return redirect()->route('admin.horoscopes.index')
            ->with('status', 'Horoscope entry deleted successfully.');
    }

    public function zodiacSigns()
    {
        $signs = Horoscope::orderBy('id')->get();
        return view('admin.horoscopes.signs', compact('signs'));
    }

    public function updateZodiacSign(Request $request, Horoscope $horoscope)
    {
        $validated = $request->validate([
            'symbol' => 'nullable|string|max:50',
            'element' => 'nullable|string|max:50',
            'date_range' => 'nullable|string|max:100',
            'ruling_planet' => 'nullable|string|max:100',
            'lucky_number' => 'nullable|string|max:100',
            'lucky_color' => 'nullable|string|max:100',
            'overview' => 'nullable|string',
            'daily_prediction' => 'nullable|string',
            'weekly_prediction' => 'nullable|string',
            'monthly_prediction' => 'nullable|string',
        ]);

        $horoscope->update($validated);

        return back()->with('status', "{$horoscope->zodiac_sign} profile updated successfully.");
    }
}
