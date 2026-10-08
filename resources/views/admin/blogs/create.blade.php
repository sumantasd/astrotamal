@extends('admin.layouts.app')

@section('title', 'Write New Blog Article')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#0B3D2E]">Write Blog Article</h1>
            <p class="text-xs text-[#60736B] mt-1">Publish insightful astrological and Vastu content.</p>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2]">
            ← Back to Blog Posts
        </a>
    </div>

    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data" class="bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs space-y-6">
        @csrf

        <div>
            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Article Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Navgrah Shanti: Impact of Jupiter Transit in 2026" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Category *</label>
                <select name="category" required class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Author Name</label>
                <input type="text" name="author_name" value="{{ old('author_name', 'Tamal Chakraborty') }}" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Estimated Read Time</label>
                <input type="text" name="read_time" value="{{ old('read_time', '5 min read') }}" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Short Excerpt / Summary</label>
            <textarea name="summary" rows="2" placeholder="Brief 2-line summary shown on blog list cards..." class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">{{ old('summary') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Full Article Body *</label>
            <textarea name="content" rows="10" required class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">{{ old('content') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Featured Cover Image</label>
            <input type="file" name="image_file" class="w-full text-xs text-[#60736B]">
        </div>

        <div class="flex items-center pt-2">
            <label class="flex items-center space-x-2 text-xs font-bold text-[#0B3D2E] cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded text-[#0B3D2E]">
                <span>Feature on Homepage and Main Banner</span>
            </label>
        </div>

        <div class="pt-4 border-t border-[#C8D8CF]/40 flex justify-end space-x-3">
            <a href="{{ route('admin.blogs.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-[#60736B] hover:bg-[#E8F1EC]">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] border border-[#C49A45]/40 shadow-md">
                Publish Blog Article
            </button>
        </div>
    </form>

</div>
@endsection
