@extends('admin.layouts.app')

@section('title', 'Appointments')
@section('header_title', 'Consultation Appointments')
@section('header_subtitle', 'Manage client bookings, scheduling, and payment verification statuses')

@section('content')
<div class="space-y-6">

    <!-- Filters Bar -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-4 sm:p-5 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.appointments.index') }}" class="w-full flex flex-col sm:flex-row items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by reference, name, email, phone..." 
                   class="w-full sm:w-72 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F] focus:outline-none focus:border-[#C49A45]">

            <select name="status" class="w-full sm:w-44 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button type="submit" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#351211] rounded-xl hover:bg-[#541F1D]">
                Filter
            </button>
        </form>
    </div>

    <!-- Appointments Table -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs">
        @if ($appointments->isEmpty())
            <div class="py-12 text-center text-xs text-[#81766D]">No appointments found matching your search.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 text-[11px] font-bold uppercase tracking-wider text-[#81766D]">
                            <th class="pb-3 px-3">Reference</th>
                            <th class="pb-3 px-3">Client Details</th>
                            <th class="pb-3 px-3">Service</th>
                            <th class="pb-3 px-3">Preferred Date</th>
                            <th class="pb-3 px-3">Payment</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                        @foreach ($appointments as $item)
                            <tr class="hover:bg-[#EDE3D4]/30 transition-colors">
                                <td class="py-3.5 px-3 font-mono font-bold text-[#541F1D]">
                                    {{ $item->booking_reference ?? 'ASTRO-' . $item->id }}
                                </td>
                                <td class="py-3.5 px-3">
                                    <div class="font-semibold text-[#29211F]">{{ $item->name }}</div>
                                    <div class="text-[11px] text-[#81766D]">{{ $item->email }} • {{ $item->phone }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-medium">
                                    {{ $item->service->title ?? 'Consultation' }}
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $item->preferred_date }}</div>
                                    <div class="text-[11px] text-[#81766D]">{{ $item->preferred_time }}</div>
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ strtoupper($item->payment_status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-[#541F1D]/10 text-[#541F1D]">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.appointments.show', $item) }}" class="px-3 py-1.5 text-xs font-bold text-[#541F1D] bg-[#C49A45]/20 rounded-lg hover:bg-[#C49A45]/40 transition-colors">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
