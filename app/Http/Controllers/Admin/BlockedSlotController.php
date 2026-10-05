<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedSlot;
use Illuminate\Http\Request;

class BlockedSlotController extends Controller
{
    public function index()
    {
        $blockedSlots = BlockedSlot::orderBy('blocked_date', 'desc')->paginate(15);
        return view('admin.blocked_slots.index', compact('blockedSlots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blocked_date' => ['required', 'date'],
            'time_slot' => ['nullable', 'string', 'max:100'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_recurring'] = false;
        $validated['is_active'] = true;

        // Clean up empty string time_slot to null
        if (isset($validated['time_slot']) && trim($validated['time_slot']) === '') {
            $validated['time_slot'] = null;
        }

        BlockedSlot::create($validated);

        return redirect()->back()->with('status', 'Blocked date/time slot created successfully.');
    }

    public function update(Request $request, BlockedSlot $blockedSlot)
    {
        $validated = $request->validate([
            'blocked_date' => ['required', 'date'],
            'time_slot' => ['nullable', 'string', 'max:100'],
            'reason' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (isset($validated['time_slot']) && trim($validated['time_slot']) === '') {
            $validated['time_slot'] = null;
        }

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        $blockedSlot->update($validated);

        return redirect()->back()->with('status', 'Blocked slot updated successfully.');
    }

    public function destroy(BlockedSlot $blockedSlot)
    {
        $blockedSlot->delete();
        return redirect()->back()->with('status', 'Blocked slot removed successfully.');
    }
}
