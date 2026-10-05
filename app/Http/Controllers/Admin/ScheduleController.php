<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DateScheduleOverride;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $opening = SiteSetting::get('booking_opening_time', '09:00 AM');
        $closing = SiteSetting::get('booking_closing_time', '08:00 PM');
        $duration = (int) SiteSetting::get('booking_slot_duration', 30);

        $overrides = DateScheduleOverride::orderBy('override_date', 'asc')->paginate(10);

        return view('admin.schedule.index', compact('opening', 'closing', 'duration', 'overrides'));
    }

    public function updateGlobal(Request $request)
    {
        $validated = $request->validate([
            'opening_time' => ['required', 'string'],
            'closing_time' => ['required', 'string'],
            'slot_duration_minutes' => ['required', 'integer', 'min:10', 'max:240'],
        ]);

        SiteSetting::set('booking_opening_time', $validated['opening_time'], 'booking');
        SiteSetting::set('booking_closing_time', $validated['closing_time'], 'booking');
        SiteSetting::set('booking_slot_duration', (string)$validated['slot_duration_minutes'], 'booking');

        return redirect()->back()->with('status', 'Global booking schedule updated successfully.');
    }

    public function storeOverride(Request $request)
    {
        $validated = $request->validate([
            'override_date' => ['required', 'date', 'unique:date_schedule_overrides,override_date'],
            'opening_time' => ['required', 'string'],
            'closing_time' => ['required', 'string'],
            'slot_duration_minutes' => ['required', 'integer', 'min:10', 'max:240'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_active'] = true;

        DateScheduleOverride::create($validated);

        return redirect()->back()->with('status', 'Date-specific schedule override added successfully.');
    }

    public function destroyOverride(DateScheduleOverride $override)
    {
        $override->delete();
        return redirect()->back()->with('status', 'Schedule override removed.');
    }
}
