@extends('admin.layouts.app')

@section('title', 'Add Horoscope Forecast')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Create Horoscope Forecast</h1>
            <p class="text-xs text-[#81766D] mt-1">Publish daily, weekly, monthly, or yearly predictions for astrology clients.</p>
        </div>
        <a href="{{ route('admin.horoscopes.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
            ← Back to Horoscopes
        </a>
    </div>

    <form method="POST" action="{{ route('admin.horoscopes.store') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Select Zodiac Sign *</label>
                <select name="horoscope_id" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    @foreach($horoscopes as $h)
                        <option value="{{ $h->id }}" {{ old('horoscope_id', $defaultSignId) == $h->id ? 'selected' : '' }}>
                            {{ $h->zodiac_sign }} ({{ $h->symbol }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Forecast Period *</label>
                <select name="period_type" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <option value="daily" {{ old('period_type', $defaultPeriod) == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ old('period_type', $defaultPeriod) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ old('period_type', $defaultPeriod) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ old('period_type', $defaultPeriod) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Forecast Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Daily Horoscope for Aries - Golden Career Opportunities" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Short Summary</label>
            <textarea name="summary" rows="2" placeholder="Brief 1-2 sentence overview previewed on cards..." class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('summary') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Career & Business Prediction</label>
                <textarea name="career" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('career') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Finance & Wealth Prediction</label>
                <textarea name="finance" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('finance') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Love & Relationship Prediction</label>
                <textarea name="love" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('love') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Health & Wellbeing Prediction</label>
                <textarea name="health" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('health') }}</textarea>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">General Astrological Advice & Remedies</label>
            <textarea name="advice" rows="2" placeholder="e.g. Offer water to Surya Dev in the morning..." class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('advice') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Lucky Day</label>
                <input type="text" name="lucky_day" value="{{ old('lucky_day') }}" placeholder="e.g. Tuesday" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Lucky Colour</label>
                <input type="text" name="lucky_colour" value="{{ old('lucky_colour') }}" placeholder="e.g. Gold / Crimson" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Lucky Number</label>
                <input type="text" name="lucky_number" value="{{ old('lucky_number') }}" placeholder="e.g. 7, 9" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Publication Status *</label>
                <select name="status" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Visible on Website)</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Private Admin Only)</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div class="flex items-center pt-5">
                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="rounded text-[#541F1D] focus:ring-[#C49A45]">
                    <span>Feature on Homepage / Main Banner</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end space-x-3">
            <a href="{{ route('admin.horoscopes.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Save & Publish Horoscope
            </button>
        </div>
    </form>

</div>
@endsection
