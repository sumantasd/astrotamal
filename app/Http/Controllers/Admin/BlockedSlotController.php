<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedSlot;
use Illuminate\Http\Request;

class BlockedSlotController extends Controller
{
    public function index()
    {
        $blockedSlots = BlockedSlot::latest('id')->paginate(15);
        return view('admin.blocked_slots.index', compact('blockedSlots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blocked_date' => ['nullable', 'required_without:is_recurring', 'date'],
            'is_recurring' => ['nullable', 'boolean'],
            'day_of_week' => ['nullable', 'string', 'max:20'],
            'time_slot' => ['nullable', 'string', 'max:50'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_recurring'] = $request->boolean('is_recurring');
        $validated['is_active'] = true;

        BlockedSlot::create($validated);

        return redirect()->back()->with('status', 'Time slot / date blocked successfully.');
    }

    public function destroy(BlockedSlot $blockedSlot)
    {
        $blockedSlot->delete();
        return redirect()->back()->with('status', 'Blocked slot removed successfully.');
    }
}
