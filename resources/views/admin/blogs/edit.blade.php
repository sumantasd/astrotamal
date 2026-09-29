@extends('admin.layouts.app')

@section('title', 'Edit Blog Article')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Edit Blog Article</h1>
            <p class="text-xs text-[#81766D] mt-1">Update article details, category, or content.</p>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
            ← Back to Blog Posts
        </a>
    </div>

    <form method="POST" action="{{ route('admin.blogs.update', $blogPost->id) }}" enctype="multipart/form-data" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Article Title *</label>
            <input type="text" name="title" value="{{ old('title', $blogPost->title) }}" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Category *</label>
                <select name="category" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $blogPost->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Author Name</label>
                <input type="text" name="author_name" value="{{ old('author_name', $blogPost->author_name) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Estimated Read Time</label>
                <input type="text" name="read_time" value="{{ old('read_time', $blogPost->read_time) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Short Excerpt / Summary</label>
            <textarea name="summary" rows="2" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ old('summary', $blogPost->summary) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Full Article Body *</label>
            <textarea name="content" rows="10" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ old('content', $blogPost->content) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Featured Cover Image</label>
            @if($blogPost->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blogPost->image) }}" class="h-20 w-auto rounded-lg border border-[#D8C6A8]">
                </div>
            @endif
            <input type="file" name="image_file" class="w-full text-xs text-[#81766D]">
        </div>

        <div class="flex items-center pt-2">
            <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $blogPost->is_featured) ? 'checked' : '' }} class="rounded text-[#541F1D]">
                <span>Feature on Homepage and Main Banner</span>
            </label>
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end space-x-3">
            <a href="{{ route('admin.blogs.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Update Article
            </button>
        </div>
    </form>

</div>
@endsection
