@extends('admin.layouts.app')

@section('title', 'Edit Horoscope Forecast')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Edit Horoscope Forecast</h1>
            <p class="text-xs text-[#81766D] mt-1">Update predictions, remedies, and publishing status.</p>
        </div>
        <a href="{{ route('admin.horoscopes.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
            ← Back to Horoscopes
        </a>
    </div>

    <form method="POST" action="{{ route('admin.horoscopes.update', $horoscopeForecast->id) }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Select Zodiac Sign *</label>
                <select name="horoscope_id" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    @foreach($horoscopes as $h)
                        <option value="{{ $h->id }}" {{ old('horoscope_id', $horoscopeForecast->horoscope_id) == $h->id ? 'selected' : '' }}>
                            {{ $h->zodiac_sign }} ({{ $h->symbol }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Forecast Period *</label>
                <select name="period_type" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <option value="daily" {{ old('period_type', $horoscopeForecast->period_type) == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ old('period_type', $horoscopeForecast->period_type) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ old('period_type', $horoscopeForecast->period_type) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ old('period_type', $horoscopeForecast->period_type) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Forecast Title *</label>
            <input type="text" name="title" value="{{ old('title', $horoscopeForecast->title) }}" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Short Summary</label>
            <textarea name="summary" rows="2" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('summary', $horoscopeForecast->summary) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Career & Business Prediction</label>
                <textarea name="career" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('career', $horoscopeForecast->career) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Finance & Wealth Prediction</label>
                <textarea name="finance" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('finance', $horoscopeForecast->finance) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Love & Relationship Prediction</label>
                <textarea name="love" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('love', $horoscopeForecast->love) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Health & Wellbeing Prediction</label>
                <textarea name="health" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('health', $horoscopeForecast->health) }}</textarea>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">General Astrological Advice & Remedies</label>
            <textarea name="advice" rows="2" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('advice', $horoscopeForecast->advice) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Lucky Day</label>
                <input type="text" name="lucky_day" value="{{ old('lucky_day', $horoscopeForecast->lucky_day) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Lucky Colour</label>
                <input type="text" name="lucky_colour" value="{{ old('lucky_colour', $horoscopeForecast->lucky_colour) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Lucky Number</label>
                <input type="text" name="lucky_number" value="{{ old('lucky_number', $horoscopeForecast->lucky_number) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Publication Status *</label>
                <select name="status" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                    <option value="published" {{ old('status', $horoscopeForecast->status) == 'published' ? 'selected' : '' }}>Published (Visible on Website)</option>
                    <option value="draft" {{ old('status', $horoscopeForecast->status) == 'draft' ? 'selected' : '' }}>Draft (Private Admin Only)</option>
                    <option value="archived" {{ old('status', $horoscopeForecast->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div class="flex items-center pt-5">
                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $horoscopeForecast->featured) ? 'checked' : '' }} class="rounded text-[#541F1D] focus:ring-[#C49A45]">
                    <span>Feature on Homepage / Main Banner</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end space-x-3">
            <a href="{{ route('admin.horoscopes.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Update Horoscope
            </button>
        </div>
    </form>

</div>
@endsection
