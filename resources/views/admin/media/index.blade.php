@extends('admin.layouts.app')

@section('title', 'Gallery & Video Media Manager')

@section('content')
<div class="space-y-6" x-data="{ addModal: false, editModal: false, activeItem: {} }">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#541F1D]">Gallery & Video Media Manager</h1>
            <p class="text-xs sm:text-sm text-[#81766D] mt-1">Upload photos, video clips, and embed YouTube videos for the public gallery & videos pages.</p>
        </div>
        <button @click="addModal = true" class="px-4 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 transition-all shadow-md flex items-center shrink-0">
            <svg class="w-4 h-4 mr-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Media Item
        </button>
    </div>

    <!-- Type Tabs -->
    <div class="bg-[#FDFBF7] p-4 rounded-2xl border border-[#D8C6A8] shadow-xs flex items-center space-x-2">
        <a href="{{ route('admin.media.index') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('type') == '' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
            All Media
        </a>
        <a href="{{ route('admin.media.index', ['type' => 'image']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('type') == 'image' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
            Images
        </a>
        <a href="{{ route('admin.media.index', ['type' => 'youtube']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('type') == 'youtube' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
            YouTube Videos
        </a>
        <a href="{{ route('admin.media.index', ['type' => 'video']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('type') == 'video' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#81766D] hover:bg-[#EDE3D4]/50' }}">
            Uploaded Videos
        </a>
    </div>

    <!-- Media Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
            <div class="bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8] shadow-xs overflow-hidden flex flex-col justify-between group">
                <div class="relative bg-black/5 aspect-video flex items-center justify-center overflow-hidden">
                    @if($item->type === 'image' && $item->file_path)
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @elseif($item->type === 'youtube' && $item->embed_url)
                        <iframe class="w-full h-full" src="{{ $item->embed_url }}" title="{{ $item->title }}" frameborder="0" allowfullscreen></iframe>
                    @elseif($item->file_path)
                        <video src="{{ asset('storage/' . $item->file_path) }}" controls class="w-full h-full object-cover"></video>
                    @else
                        <div class="text-[#C49A45] text-2xl font-bold">🎬</div>
                    @endif

                    <span class="absolute top-2 right-2 px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase {{ $item->is_published ? 'bg-emerald-900/80 text-white' : 'bg-amber-900/80 text-white' }}">
                        {{ $item->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>

                <div class="p-4 space-y-2">
                    <div class="flex items-center justify-between text-[10px] font-bold text-[#C49A45] uppercase">
                        <span>{{ strtoupper($item->type) }}</span>
                        <span>Order: {{ $item->sort_order }}</span>
                    </div>
                    <h3 class="text-xs font-bold text-[#541F1D] line-clamp-1">{{ $item->title }}</h3>
                    <p class="text-[11px] text-[#81766D] line-clamp-2">{{ $item->caption ?? 'No caption' }}</p>
                </div>

                <div class="p-3 border-t border-[#D8C6A8]/40 bg-[#EDE3D4]/20 flex items-center justify-between">
                    <button type="button" @click="activeItem = {{ json_encode($item) }}; editModal = true" class="text-xs font-semibold text-[#541F1D] hover:underline">
                        Edit Item
                    </button>

                    <form method="POST" action="{{ route('admin.media.destroy', $item->id) }}" onsubmit="return confirm('Delete this media item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs font-semibold text-red-700 hover:underline">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full p-12 text-center text-[#81766D] bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8]">
                <p class="text-sm font-semibold text-[#29211F]">No media items found</p>
                <p class="text-xs mt-1">Click "Add Media Item" to upload images or add YouTube videos.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>

    <!-- Add Modal -->
    <div x-show="addModal" class="fixed inset-0 z-50 bg-black/60 flex items-center justify-center p-4" style="display: none;">
        <div class="bg-[#FDFBF7] max-w-lg w-full p-6 rounded-2xl border border-[#D8C6A8] shadow-xl space-y-4" @click.away="addModal = false">
            <h2 class="text-base font-bold font-serif-luxury text-[#541F1D]">Add New Media Item</h2>

            <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Title *</label>
                    <input type="text" name="title" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Media Type *</label>
                    <select name="type" required class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                        <option value="image">Image Photo</option>
                        <option value="youtube">YouTube Video Link</option>
                        <option value="video">Direct Upload Video</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Upload File (Images/Videos)</label>
                    <input type="file" name="media_file" class="w-full text-xs text-[#81766D]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">YouTube URL (For YouTube type)</label>
                    <input type="url" name="url" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Caption / Description</label>
                    <textarea name="caption" rows="2" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none"></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D]">
                        <input type="checkbox" name="is_published" value="1" checked class="rounded text-[#541F1D]">
                        <span>Publish immediately</span>
                    </label>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211]">
                        Save Media
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
