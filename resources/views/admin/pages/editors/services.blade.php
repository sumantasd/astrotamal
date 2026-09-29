@extends('admin.layouts.app')

@section('title', 'Services Page Editor')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Services Page Content Editor</h1>
            <p class="text-xs text-[#81766D] mt-1">Manage public header text, instructions, and SEO metadata for the Services page.</p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.services.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
                Manage Service List & Pricing →
            </a>
            <a href="{{ route('admin.pages.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">
                Back
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.pages.update', 'services') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf
        @method('PUT')

        <input type="hidden" name="title" value="{{ $page->title }}">

        <div class="space-y-4">
            <h2 class="text-sm font-bold font-serif-luxury text-[#541F1D] border-b border-[#D8C6A8]/40 pb-2">1. Services Page Overview Text</h2>
            
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Page Main Heading *</label>
                <input type="text" name="content_fields[page_heading]" value="{{ old('content_fields.page_heading', $contentData['page_heading'] ?? '') }}" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Page Subtitle / Introductory Note</label>
                <textarea name="content_fields[subtitle]" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ old('content_fields.subtitle', $contentData['subtitle'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t border-[#D8C6A8]/40">
            <h2 class="text-sm font-bold font-serif-luxury text-[#541F1D] border-b border-[#D8C6A8]/40 pb-2">2. Search Engine Optimization (SEO)</h2>
            
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">SEO Title</label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                    <option value="published" {{ $page->status === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $page->status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end space-x-3">
            <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Save Services Page Header
            </button>
        </div>
    </form>

</div>
@endsection
