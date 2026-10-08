@extends('admin.layouts.app')

@section('title', 'Booking Schedule & Hours')
@section('header_title', 'Booking Time Schedule')
@section('header_subtitle', 'Configure daily consultation operating hours and date-specific availability overrides')

@section('content')
<div class="space-y-8 max-w-5xl">

    @if (session('status'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-2xl">
            {{ session('status') }}
        </div>
    @endif

    <!-- Global Schedule Settings Card -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-7 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E] mb-1">Default Daily Schedule</h3>
        <p class="text-xs text-[#60736B] mb-5">Set global operating hours. Time slots will be automatically generated between opening and closing hours.</p>

        <form method="POST" action="{{ route('admin.schedule.update') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label for="opening_time" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Opening Time *</label>
                    <input type="text" name="opening_time" id="opening_time" value="{{ old('opening_time', $opening) }}" placeholder="e.g. 09:00 AM" required 
                           class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="closing_time" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Closing Time *</label>
                    <input type="text" name="closing_time" id="closing_time" value="{{ old('closing_time', $closing) }}" placeholder="e.g. 08:00 PM" required 
                           class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="slot_duration_minutes" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Slot Duration (Minutes) *</label>
                    <input type="number" name="slot_duration_minutes" id="slot_duration_minutes" value="{{ old('slot_duration_minutes', $duration) }}" min="10" max="240" required 
                           class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-xs">
                    Save Operating Schedule
                </button>
            </div>
        </form>
    </div>

    <!-- Date-Specific Overrides Card -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-7 shadow-xs space-y-6">
        <div>
            <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E] mb-1">Date-Specific Availability Overrides</h3>
            <p class="text-xs text-[#60736B]">Override standard schedule on specific dates (e.g. shorter hours for festivals or travel).</p>
        </div>

        <!-- Add Override Form -->
        <form method="POST" action="{{ route('admin.schedule.override.store') }}" class="p-4 bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-2xl space-y-4">
            @csrf
            <h4 class="text-xs font-bold uppercase text-[#0B3D2E]">Add Schedule Override</h4>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <label for="override_date" class="block text-[10px] font-bold uppercase tracking-wider text-[#17211D] mb-1">Date *</label>
                    <input type="date" name="override_date" id="override_date" required class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3 py-2 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="ov_opening_time" class="block text-[10px] font-bold uppercase tracking-wider text-[#17211D] mb-1">Opening *</label>
                    <input type="text" name="opening_time" id="ov_opening_time" placeholder="11:00 AM" required class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3 py-2 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="ov_closing_time" class="block text-[10px] font-bold uppercase tracking-wider text-[#17211D] mb-1">Closing *</label>
                    <input type="text" name="closing_time" id="ov_closing_time" placeholder="04:00 PM" required class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3 py-2 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="ov_duration" class="block text-[10px] font-bold uppercase tracking-wider text-[#17211D] mb-1">Duration (min) *</label>
                    <input type="number" name="slot_duration_minutes" id="ov_duration" value="30" required class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3 py-2 text-xs text-[#17211D]">
                </div>
            </div>

            <div>
                <label for="ov_reason" class="block text-[10px] font-bold uppercase tracking-wider text-[#17211D] mb-1">Reason (Optional)</label>
                <input type="text" name="reason" id="ov_reason" placeholder="e.g. Special Festival Hours" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3 py-2 text-xs text-[#17211D]">
            </div>

            <div>
                <button type="submit" class="px-4 py-2 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl">
                    Add Override
                </button>
            </div>
        </form>

        <!-- Active Overrides List -->
        @if ($overrides->isEmpty())
            <div class="py-4 text-center text-xs text-[#60736B]">No date-specific schedule overrides configured.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Date</th>
                            <th class="pb-3 px-3">Opening</th>
                            <th class="pb-3 px-3">Closing</th>
                            <th class="pb-3 px-3">Duration</th>
                            <th class="pb-3 px-3">Reason</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($overrides as $ov)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3 px-3 font-bold text-[#0B3D2E]">
                                    {{ $ov->override_date ? \Carbon\Carbon::parse($ov->override_date)->format('d M Y') : '' }}
                                </td>
                                <td class="py-3 px-3 font-mono text-xs">{{ $ov->opening_time }}</td>
                                <td class="py-3 px-3 font-mono text-xs">{{ $ov->closing_time }}</td>
                                <td class="py-3 px-3">{{ $ov->slot_duration_minutes }} mins</td>
                                <td class="py-3 px-3 text-[#60736B]">{{ $ov->reason ?? '—' }}</td>
                                <td class="py-3 px-3 text-right">
                                    <form method="POST" action="{{ route('admin.schedule.override.destroy', $ov) }}" class="inline-block" onsubmit="return confirm('Delete this override?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-red-800 bg-red-100 rounded hover:bg-red-200">
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
                {{ $overrides->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
