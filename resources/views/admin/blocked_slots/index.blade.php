@extends('admin.layouts.app')

@section('title', 'Blocked Slots')
@section('header_title', 'Blocked Dates & Slots')
@section('header_subtitle', 'Manage calendar blackout dates and astrologer availability')

@section('content')
<div class="space-y-8 max-w-5xl">

    <!-- Add Blocked Slot Form -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-7 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#541F1D] mb-4">Block a Date or Time Slot</h3>

        <form method="POST" action="{{ route('admin.blocked-slots.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="blocked_date" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1">Blocked Date</label>
                    <input type="date" name="blocked_date" id="blocked_date" required 
                           class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>

                <div>
                    <label for="time_slot" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1">Time Slot (Optional)</label>
                    <input type="text" name="time_slot" id="time_slot" placeholder="e.g. 10:00 AM - 12:00 PM (or leave blank for all day)" 
                           class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>

                <div>
                    <label for="reason" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1">Reason (Optional)</label>
                    <input type="text" name="reason" id="reason" placeholder="e.g. Personal Holiday" 
                           class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>
            </div>

            <div class="pt-1">
                <button type="submit" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-xl">
                    Add Blockout
                </button>
            </div>
        </form>
    </div>

    <!-- Blocked Slots List -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#541F1D] mb-4">Active Blocked Dates</h3>

        @if ($blockedSlots->isEmpty())
            <div class="py-8 text-center text-xs text-[#81766D]">No blocked dates or time slots currently active.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 text-[11px] font-bold uppercase tracking-wider text-[#81766D]">
                            <th class="pb-3 px-3">Date</th>
                            <th class="pb-3 px-3">Time Slot</th>
                            <th class="pb-3 px-3">Reason</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                        @foreach ($blockedSlots as $slot)
                            <tr class="hover:bg-[#EDE3D4]/30 transition-colors">
                                <td class="py-3.5 px-3 font-bold text-[#541F1D]">
                                    {{ $slot->blocked_date }}
                                </td>
                                <td class="py-3.5 px-3">
                                    {{ $slot->time_slot ?? 'All Day Blockout' }}
                                </td>
                                <td class="py-3.5 px-3 text-[#81766D]">
                                    {{ $slot->reason ?? 'N/A' }}
                                </td>
                                <td class="py-3.5 px-3 text-right">
                                    <form method="POST" action="{{ route('admin.blocked-slots.destroy', $slot) }}" class="inline-block" onsubmit="return confirm('Remove this blockout?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-lg hover:bg-red-200">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $blockedSlots->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
