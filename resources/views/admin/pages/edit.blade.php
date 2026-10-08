@extends('admin.layouts.app')

@section('title', 'Edit Page - ' . $page->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#0B3D2E]">Edit Page: {{ $page->title }}</h1>
            <p class="text-xs text-[#60736B] mt-1">Configure section titles and search engine metadata.</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2]">
            ← Back to Pages
        </a>
    </div>

    <form method="POST" action="{{ route('admin.pages.update', $page->slug) }}" class="bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Page Title *</label>
            <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Main Section Heading</label>
            <input type="text" name="content_fields[page_heading]" value="{{ old('content_fields.page_heading', $contentData['page_heading'] ?? '') }}" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Subheading / Introduction</label>
            <textarea name="content_fields[subtitle]" rows="2" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">{{ old('content_fields.subtitle', $contentData['subtitle'] ?? '') }}</textarea>
        </div>

        <div class="space-y-4 pt-4 border-t border-[#C8D8CF]/40">
            <h2 class="text-sm font-bold font-serif-luxury text-[#0B3D2E] border-b border-[#C8D8CF]/40 pb-2">SEO Settings</h2>
            
            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">SEO Meta Title</label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Publication Status</label>
                <select name="status" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
                    <option value="published" {{ $page->status === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $page->status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
        </div>

        <div class="pt-4 border-t border-[#C8D8CF]/40 flex justify-end space-x-3">
            <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-[#60736B] hover:bg-[#E8F1EC]">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] border border-[#C49A45]/40 shadow-md">
                Save Page Settings
            </button>
        </div>
    </form>

</div>
@endsection
