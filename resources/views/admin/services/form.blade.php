@extends('admin.layouts.app')

@section('title', $service->exists ? 'Edit Service' : 'Create Service')
@section('header_title', $service->exists ? 'Edit Service' : 'Add New Service')
@section('header_subtitle', 'Configure service details, duration, pricing, and description')

@section('content')
<div class="max-w-4xl space-y-6">

    <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-[#541F1D] hover:underline flex items-center">
        ← Back to Services List
    </a>

    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 shadow-xs">
        <form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" class="space-y-5">
            @csrf
            @if ($service->exists)
                @method('PUT')
            @endif

            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Service Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" required 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="price" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Price / Pricing Info</label>
                    <input type="text" name="price" id="price" value="{{ old('price', $service->price) }}" required 
                           class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F]">
                </div>

                <div>
                    <label for="duration" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Duration (e.g. 45 Mins, Sessions)</label>
                    <input type="text" name="duration" id="duration" value="{{ old('duration', $service->duration ?? '45 Mins') }}" required 
                           class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F]">
                </div>
            </div>

            <div>
                <label for="short_description" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Short Description</label>
                <textarea name="short_description" id="short_description" rows="2" 
                          class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">{{ old('short_description', $service->short_description) }}</textarea>
            </div>

            <div>
                <label for="full_description" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Full Detailed Description</label>
                <textarea name="full_description" id="full_description" rows="5" 
                          class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">{{ old('full_description', $service->full_description) }}</textarea>
            </div>

            <div class="flex items-center space-x-3">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} 
                       class="accent-[#541F1D] w-4 h-4 rounded border-[#D8C6A8]">
                <label for="is_featured" class="text-xs font-bold text-[#29211F] cursor-pointer">Highlight as Featured Service</label>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-full shadow-md">
                    {{ $service->exists ? 'Update Service' : 'Create Service' }}
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
