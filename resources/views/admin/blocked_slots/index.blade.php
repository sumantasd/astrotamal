@extends('admin.layouts.app')

@section('title', 'Blocked Dates & Time Slots')
@section('header_title', 'Blocked Dates & Slots')
@section('header_subtitle', 'Manage calendar blackout dates and astrologer availability')

@section('content')
<div x-data="{ 
    editModalOpen: false, 
    editUrl: '', 
    editDate: '', 
    editSlot: '', 
    editReason: '',
    openEditModal(url, date, slot, reason) {
        this.editUrl = url;
        this.editDate = date;
        this.editSlot = slot;
        this.editReason = reason;
        this.editModalOpen = true;
    }
}" class="space-y-8 max-w-5xl">

    @if (session('status'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-2xl">
            {{ session('status') }}
        </div>
    @endif

    <!-- Add Blocked Slot Form -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-7 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E] mb-1">Block a Date or Time Slot</h3>
        <p class="text-xs text-[#60736B] mb-4">Select a date and leave time slot blank for a full day block, or specify a time slot (e.g. 10:00 AM - 10:30 AM).</p>

        <form method="POST" action="{{ route('admin.blocked-slots.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="blocked_date" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1">Blocked Date *</label>
                    <input type="date" name="blocked_date" id="blocked_date" required 
                           class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="time_slot" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1">Time Slot (Optional)</label>
                    <input type="text" name="time_slot" id="time_slot" placeholder="Leave blank for All Day block" 
                           class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="reason" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1">Reason (Optional)</label>
                    <input type="text" name="reason" id="reason" placeholder="e.g. Personal Holiday" 
                           class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>
            </div>

            <div class="pt-1">
                <button type="submit" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl transition-colors shadow-xs">
                    Save Blockout
                </button>
            </div>
        </form>
    </div>

    <!-- Blocked Slots List -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E] mb-4">Active Blocked Dates & Slots</h3>

        @if ($blockedSlots->isEmpty())
            <div class="py-8 text-center text-xs text-[#60736B]">No blocked dates or time slots currently active.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Date</th>
                            <th class="pb-3 px-3">Time Slot</th>
                            <th class="pb-3 px-3">Reason</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($blockedSlots as $slot)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3.5 px-3 font-bold text-[#0B3D2E]">
                                    {{ $slot->blocked_date ? \Carbon\Carbon::parse($slot->blocked_date)->format('d M Y') : 'N/A' }}
                                </td>
                                <td class="py-3.5 px-3 font-medium">
                                    @if(empty($slot->time_slot))
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[#0B3D2E] text-[#FFFFFF]">All Day</span>
                                    @else
                                        {{ $slot->time_slot }}
                                    @endif
                                </td>
                                <td class="py-3.5 px-3 text-[#60736B]">
                                    {{ $slot->reason ?? '—' }}
                                </td>
                                <td class="py-3.5 px-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-800">
                                        BLOCKED
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 text-right space-x-2">
                                    <!-- Edit button -->
                                    <button type="button" 
                                            @click="openEditModal('{{ route('admin.blocked-slots.update', $slot) }}', '{{ $slot->blocked_date ? \Carbon\Carbon::parse($slot->blocked_date)->format('Y-m-d') : '' }}', '{{ e($slot->time_slot) }}', '{{ e($slot->reason) }}')"
                                            class="px-3 py-1 text-xs font-bold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] rounded-lg border border-[#C8D8CF]">
                                        Edit
                                    </button>

                                    <!-- Delete form -->
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

    <!-- Edit Blocked Slot Modal -->
    <div x-show="editModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="editModalOpen = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl max-w-lg w-full p-6 sm:p-7 shadow-2xl space-y-5">
            <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-3">
                <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Edit Blocked Date / Slot</h3>
                <button type="button" @click="editModalOpen = false" class="text-[#60736B] hover:text-[#0B3D2E] font-bold text-lg">✕</button>
            </div>

            <form :action="editUrl" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1">Date *</label>
                    <input type="date" name="blocked_date" x-model="editDate" required class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1">Time Slot (Leave blank for All Day)</label>
                    <input type="text" name="time_slot" x-model="editSlot" placeholder="e.g. 10:00 AM - 10:30 AM" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1">Reason</label>
                    <input type="text" name="reason" x-model="editReason" placeholder="Reason for block" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>

                <div class="pt-3 flex items-center justify-end space-x-3 border-t border-[#C8D8CF]/60">
                    <button type="button" @click="editModalOpen = false" class="px-4 py-2 text-xs font-bold text-[#60736B] hover:text-[#17211D]">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl">Update Block</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
