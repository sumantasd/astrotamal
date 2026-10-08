@extends('admin.layouts.app')

@section('title', 'Appointments')
@section('header_title', 'Consultation Appointments')
@section('header_subtitle', 'Manage client bookings, scheduling, and payment verification statuses')

@section('content')
<div class="space-y-6">

    @if(session('status'))
        <div class="p-4 rounded-xl bg-[#E8F1EC] border border-[#C8D8CF] text-[#0B3D2E] text-xs font-bold flex items-center justify-between shadow-xs">
            <span>✨ {{ session('status') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-[#0B3D2E]/60 hover:text-[#0B3D2E]">✕</button>
        </div>
    @endif

    <!-- Filters Bar -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-4 sm:p-5 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.appointments.index') }}" class="w-full flex flex-col sm:flex-row items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by reference, name, email, phone..." 
                   class="w-full sm:w-72 bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D] focus:outline-none focus:border-[#145A43]">

            <select name="status" class="w-full sm:w-44 bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button type="submit" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] rounded-xl hover:bg-[#145A43] transition-colors">
                Filter
            </button>
        </form>
    </div>

    <!-- Appointments Table -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs">
        @if ($appointments->isEmpty())
            <div class="py-12 text-center text-xs text-[#60736B]">No appointments found matching your search.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF] bg-[#E8F1EC] text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E]">
                            <th class="py-3 px-3">Reference</th>
                            <th class="py-3 px-3">Client Details</th>
                            <th class="py-3 px-3">Service</th>
                            <th class="py-3 px-3">Preferred Date</th>
                            <th class="py-3 px-3">Payment</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/60 text-xs text-[#17211D]">
                        @foreach ($appointments as $item)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3.5 px-3 font-mono font-bold text-[#0B3D2E]">
                                    {{ $item->booking_reference ?? 'ASTRO-' . $item->id }}
                                </td>
                                <td class="py-3.5 px-3">
                                    <div class="font-semibold text-[#17211D]">{{ $item->name }}</div>
                                    <div class="text-[11px] text-[#60736B]">{{ $item->email }} • {{ $item->phone }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-medium text-[#0B3D2E]">
                                    {{ $item->service->title ?? 'Consultation' }}
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $item->preferred_date }}</div>
                                    <div class="text-[11px] text-[#60736B]">{{ $item->preferred_time }}</div>
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ strtoupper($item->payment_status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-[#E8F1EC] text-[#0B3D2E]">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center space-x-2">
                                        <a href="{{ route('admin.appointments.show', $item) }}" class="px-3 py-1.5 text-xs font-bold text-[#0B3D2E] bg-[#E8F1EC] border border-[#C8D8CF] rounded-lg hover:bg-[#C3E8D2] transition-colors">
                                            View Details
                                        </a>
                                        <form method="POST" action="{{ route('admin.appointments.destroy', $item) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this booking reference {{ $item->booking_reference ?? $item->id }}? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
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
