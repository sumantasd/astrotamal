@extends('admin.layouts.app')

@section('title', 'Zodiac Signs Manager')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">

    <div class="flex items-center justify-between bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#0B3D2E]">Zodiac Signs Management</h1>
            <p class="text-xs text-[#60736B] mt-1">Configure ruling planets, elemental traits, lucky numbers, colors, and core profiles for all 12 zodiac signs.</p>
        </div>
        <a href="{{ route('admin.horoscopes.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2]">
            ← Back to Forecasts
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($signs as $sign)
            <div class="bg-[#FFFFFF] p-5 rounded-2xl border border-[#C8D8CF] shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-[#C8D8CF]/40 pb-3">
                    <div class="flex items-center space-x-3">
                        <span class="w-9 h-9 rounded-xl bg-[#0B3D2E] text-[#C49A45] text-sm font-bold flex items-center justify-center border border-[#C49A45]/40 shadow-xs">
                            {{ substr($sign->zodiac_sign, 0, 1) }}
                        </span>
                        <div>
                            <h3 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">{{ $sign->zodiac_sign }}</h3>
                            <p class="text-[11px] text-[#60736B]">{{ $sign->symbol }} • {{ $sign->date_range }}</p>
                        </div>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-[#E8F1EC] text-[#0B3D2E]">
                        {{ $sign->element ?? 'Element' }}
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.horoscopes.signs.update', $sign->id) }}" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-[#0B3D2E] uppercase">Ruling Planet</label>
                            <input type="text" name="ruling_planet" value="{{ old('ruling_planet', $sign->ruling_planet) }}" class="w-full px-2.5 py-1.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-lg">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[#0B3D2E] uppercase">Element</label>
                            <input type="text" name="element" value="{{ old('element', $sign->element) }}" class="w-full px-2.5 py-1.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-lg">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[#0B3D2E] uppercase">Lucky Number</label>
                            <input type="text" name="lucky_number" value="{{ old('lucky_number', $sign->lucky_number) }}" class="w-full px-2.5 py-1.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-lg">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[#0B3D2E] uppercase">Lucky Color</label>
                            <input type="text" name="lucky_color" value="{{ old('lucky_color', $sign->lucky_color) }}" class="w-full px-2.5 py-1.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-lg">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-[#0B3D2E] uppercase mb-1">Zodiac Overview</label>
                        <textarea name="overview" rows="2" class="w-full px-2.5 py-1.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-lg">{{ old('overview', $sign->overview) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] border border-[#C49A45]/40 transition-all shadow-xs">
                            Update {{ $sign->zodiac_sign }}
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>

</div>
@endsection
