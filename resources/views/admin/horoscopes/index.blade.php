@extends('admin.layouts.app')

@section('title', 'Horoscope Management')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#541F1D]">Horoscope Management</h1>
            <p class="text-xs sm:text-sm text-[#81766D] mt-1">Manage daily, weekly, monthly, and yearly predictions across all 12 zodiac signs.</p>
        </div>
        <div class="flex items-center space-x-3 shrink-0">
            <a href="{{ route('admin.horoscopes.signs') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4]/60 hover:bg-[#EDE3D4] border border-[#D8C6A8] transition-all flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Zodiac Signs Profile
            </a>
            <a href="{{ route('admin.horoscopes.create') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 transition-all shadow-md flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Forecast
            </a>
        </div>
    </div>

    <!-- Filter & Navigation Tabs -->
    <div class="bg-[#FDFBF7] p-4 rounded-2xl border border-[#D8C6A8] shadow-xs flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center space-x-1.5 overflow-x-auto pb-1 sm:pb-0">
            <a href="{{ route('admin.horoscopes.index') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('period_type') == '' ? 'bg-[#541F1D] text-[#F7F0E3] shadow-xs' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
                All
            </a>
            <a href="{{ route('admin.horoscopes.index', ['period_type' => 'daily']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('period_type') == 'daily' ? 'bg-[#541F1D] text-[#F7F0E3] shadow-xs' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
                Daily
            </a>
            <a href="{{ route('admin.horoscopes.index', ['period_type' => 'weekly']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('period_type') == 'weekly' ? 'bg-[#541F1D] text-[#F7F0E3] shadow-xs' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
                Weekly
            </a>
            <a href="{{ route('admin.horoscopes.index', ['period_type' => 'monthly']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('period_type') == 'monthly' ? 'bg-[#541F1D] text-[#F7F0E3] shadow-xs' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
                Monthly
            </a>
            <a href="{{ route('admin.horoscopes.index', ['period_type' => 'yearly']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('period_type') == 'yearly' ? 'bg-[#541F1D] text-[#F7F0E3] shadow-xs' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
                Yearly
            </a>
        </div>

        <form method="GET" action="{{ route('admin.horoscopes.index') }}" class="flex items-center space-x-2 w-full sm:w-auto">
            @if(request('period_type'))
                <input type="hidden" name="period_type" value="{{ request('period_type') }}">
            @endif
            <select name="horoscope_id" onchange="this.form.submit()" class="px-3 py-1.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl text-[#29211F] focus:outline-none">
                <option value="">All Zodiac Signs</option>
                @foreach($horoscopes as $h)
                    <option value="{{ $h->id }}" {{ request('horoscope_id') == $h->id ? 'selected' : '' }}>{{ $h->zodiac_sign }}</option>
                @endforeach
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search forecasts..." class="px-3 py-1.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl text-[#29211F] placeholder-[#81766D] focus:outline-none">
            <button type="submit" class="px-3 py-1.5 bg-[#541F1D] text-[#F7F0E3] text-xs font-bold rounded-xl hover:bg-[#351211]">
                Filter
            </button>
        </form>
    </div>

    <!-- Forecasts Grid / Table -->
    <div class="bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8] shadow-xs overflow-hidden">
        @if($forecasts->isEmpty())
            <div class="p-12 text-center text-[#81766D]">
                <svg class="w-12 h-12 mx-auto mb-3 text-[#D8C6A8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <p class="text-sm font-semibold text-[#29211F]">No horoscope forecasts found</p>
                <p class="text-xs text-[#81766D] mt-1">Try adjusting your filters or add a new forecast entry.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 bg-[#EDE3D4]/30 text-[10px] font-bold tracking-wider text-[#541F1D] uppercase">
                            <th class="py-3.5 px-4">Zodiac Sign</th>
                            <th class="py-3.5 px-4">Period</th>
                            <th class="py-3.5 px-4">Title & Summary</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4">Last Updated</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs">
                        @foreach($forecasts as $forecast)
                            <tr class="hover:bg-[#EDE3D4]/20 transition-colors">
                                <td class="py-3.5 px-4 font-bold text-[#541F1D]">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-7 h-7 rounded-lg bg-[#541F1D] text-[#C49A45] text-xs font-bold flex items-center justify-center">
                                            {{ substr($forecast->horoscope->zodiac_sign ?? 'Z', 0, 1) }}
                                        </span>
                                        <span>{{ $forecast->horoscope->zodiac_sign ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold uppercase bg-[#C49A45]/15 text-[#541F1D] border border-[#C49A45]/30">
                                        {{ strtoupper($forecast->period_type) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 max-w-xs">
                                    <div class="font-bold text-[#29211F] truncate">{{ $forecast->title }}</div>
                                    <div class="text-[11px] text-[#81766D] truncate mt-0.5">{{ $forecast->summary ?? 'No summary' }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($forecast->status === 'published')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                            Published
                                        </span>
                                    @elseif($forecast->status === 'draft')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                            Draft
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-700 border border-gray-300">
                                            Archived
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-[#81766D] text-[11px]">
                                    {{ $forecast->updated_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-2">
                                    <a href="{{ route('admin.horoscopes.edit', $forecast->id) }}" class="inline-block px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#EDE3D4] text-[#541F1D] hover:bg-[#541F1D] hover:text-[#F7F0E3] transition-all">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.horoscopes.destroy', $forecast->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this horoscope forecast?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-red-100 text-red-700 hover:bg-red-700 hover:text-white transition-all">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-[#D8C6A8]/40">
                {{ $forecasts->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
