@extends('admin.layouts.app')

@section('title', 'Gallery & Video Media Manager')

@section('content')
<div class="space-y-6" x-data="{ 
    addModal: false, 
    editModal: false, 
    activeItem: {},
    mediaType: 'image'
}">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#541F1D]">Gallery & Video Media Manager</h1>
            <p class="text-xs sm:text-sm text-[#81766D] mt-1">Centralized publishing system for public Gallery, Videos page, and Home Latest Videos.</p>
        </div>
        <button @click="mediaType = 'image'; addModal = true" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 transition-all shadow-md flex items-center shrink-0">
            <svg class="w-4 h-4 mr-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            + Add Media Item
        </button>
    </div>

    <!-- Type Filter Tabs -->
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

    <!-- Media Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
            <div class="bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8] shadow-xs overflow-hidden flex flex-col justify-between group">
                
                <!-- Preview Header -->
                <div class="relative bg-black/5 aspect-video flex items-center justify-center overflow-hidden">
                    @if($item->type === 'image')
                        <img src="{{ $item->thumbnail ?? asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/tamal_hero_portrait.jpg') }}';">
                    @elseif($item->type === 'youtube')
                        @if($item->thumbnail)
                            <img src="{{ $item->thumbnail }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @else
                            <iframe class="w-full h-full pointer-events-none" src="{{ $item->embed_url }}" title="{{ $item->title }}" frameborder="0"></iframe>
                        @endif
                    @elseif($item->file_path)
                        @if($item->thumbnail)
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @else
                            <video src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover"></video>
                        @endif
                    @else
                        <div class="text-[#C49A45] text-2xl font-bold">🎬</div>
                    @endif

                    <!-- Type Badge -->
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase bg-[#351211]/80 text-[#F7F0E3] border border-[#C49A45]/40">
                        {{ $item->type === 'image' ? 'IMAGE' : ($item->type === 'youtube' ? 'YOUTUBE VIDEO' : 'UPLOADED VIDEO') }}
                    </span>

                    <!-- Status Badge -->
                    <span class="absolute top-2 right-2 px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase {{ $item->is_published ? 'bg-emerald-900/90 text-emerald-100' : 'bg-amber-900/90 text-amber-100' }}">
                        {{ $item->is_published ? 'PUBLISHED' : 'DRAFT' }}
                    </span>
                </div>

                <!-- Item Details -->
                <div class="p-4 space-y-2 flex-grow">
                    <div class="flex items-center justify-between text-[10px] font-bold text-[#C49A45] uppercase">
                        <span>Order: {{ $item->sort_order }}</span>
                    </div>

                    <h3 class="text-xs font-bold text-[#541F1D] line-clamp-2 leading-snug">{{ $item->title }}</h3>

                    @if($item->caption)
                        <p class="text-[11px] text-[#81766D] line-clamp-2">{{ $item->caption }}</p>
                    @endif

                    @if($item->tag)
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded-full bg-[#F3E5CC] text-[#75452D] text-[10px] font-semibold">
                                {{ $item->tag }}
                            </span>
                        </div>
                    @endif

                    <!-- Publication Targets Badges -->
                    <div class="pt-2 border-t border-[#D8C6A8]/40 space-y-1">
                        <span class="text-[10px] font-bold text-[#81766D] uppercase block">Publication Targets:</span>
                        <div class="flex flex-wrap gap-1 text-[9px] font-extrabold">
                            @if($item->type === 'image')
                                <span class="px-2 py-0.5 rounded {{ $item->publish_gallery ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    Gallery: {{ $item->publish_gallery ? 'ON' : 'OFF' }}
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded {{ $item->publish_videos ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    Videos: {{ $item->publish_videos ? 'ON' : 'OFF' }}
                                </span>
                                <span class="px-2 py-0.5 rounded {{ $item->show_on_home ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    Home: {{ $item->show_on_home ? 'ON' : 'OFF' }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="p-3 border-t border-[#D8C6A8]/40 bg-[#EDE3D4]/20 flex items-center justify-between">
                    <button type="button" @click="activeItem = {{ json_encode($item) }}; editModal = true" class="px-3 py-1 rounded-lg text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] transition-colors border border-[#C49A45]/30">
                        Edit
                    </button>

                    <form method="POST" action="{{ route('admin.media.destroy', $item->id) }}" onsubmit="return confirm('Are you sure you want to delete this media item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 transition-colors border border-rose-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full p-12 text-center text-[#81766D] bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8]">
                <p class="text-sm font-semibold text-[#29211F]">No media items found</p>
                <p class="text-xs mt-1">Click "+ Add Media Item" to publish photos or videos.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>

    <!-- MODAL 1: ADD MEDIA ITEM -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-xs" @click="addModal = false"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-[#FDFBF7] max-w-lg w-full p-6 rounded-2xl border border-[#D8C6A8] shadow-2xl space-y-5">
                <div class="flex items-center justify-between border-b border-[#D8C6A8]/40 pb-3">
                    <h2 class="text-base font-bold font-serif-luxury text-[#541F1D]">Add New Media Item</h2>
                    <button type="button" @click="addModal = false" class="text-xs font-bold text-[#81766D] hover:text-[#541F1D]">✕</button>
                </div>

                <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Media Type Selector -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">MEDIA TYPE *</label>
                        <div class="grid grid-cols-3 gap-2 p-1.5 bg-[#EDE3D4]/40 rounded-xl border border-[#D8C6A8]">
                            <button type="button" @click="mediaType = 'image'" :class="mediaType === 'image' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-xs' : 'text-[#81766D] hover:text-[#541F1D]'" class="py-1.5 text-xs rounded-lg transition-all text-center">
                                Image
                            </button>
                            <button type="button" @click="mediaType = 'youtube'" :class="mediaType === 'youtube' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-xs' : 'text-[#81766D] hover:text-[#541F1D]'" class="py-1.5 text-xs rounded-lg transition-all text-center">
                                YouTube Video
                            </button>
                            <button type="button" @click="mediaType = 'video'" :class="mediaType === 'video' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-xs' : 'text-[#81766D] hover:text-[#541F1D]'" class="py-1.5 text-xs rounded-lg transition-all text-center">
                                Uploaded Video
                            </button>
                        </div>
                        <input type="hidden" name="type" :value="mediaType">
                    </div>

                    <!-- 1. IMAGE FIELDS -->
                    <template x-if="mediaType === 'image'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Image Upload * (JPG, JPEG, PNG, WEBP)</label>
                                <input type="file" name="media_file" accept="image/jpeg,image/png,image/webp" required class="w-full text-xs text-[#81766D] file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Title *</label>
                                <input type="text" name="title" required placeholder="Photo title or caption summary" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Caption / Category Tag</label>
                                <textarea name="caption" rows="2" placeholder="e.g. Sanctuary, Consultation, Event" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none"></textarea>
                            </div>

                            <!-- Publication Checkbox -->
                            <div class="p-3 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/60 space-y-2">
                                <span class="text-xs font-bold text-[#541F1D] block">PUBLICATION TARGET</span>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="publish_gallery" value="1" checked class="rounded text-[#541F1D]">
                                    <span>Publish to Public Gallery (/gallery)</span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <!-- 2. YOUTUBE VIDEO FIELDS -->
                    <template x-if="mediaType === 'youtube'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">YouTube Video Link URL *</label>
                                <input type="url" name="url" required placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Video Title *</label>
                                <input type="text" name="title" required placeholder="e.g. তুলা রাশি: ২০২৬ অক্টোবর Horoscope" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Tag / Category</label>
                                <input type="text" name="tag" placeholder="e.g. Astrologer Tamal Chakraborty" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Custom Thumbnail Image Upload (Optional override)</label>
                                <input type="file" name="thumbnail_file" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-[#81766D] file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Or Thumbnail Image URL</label>
                                <input type="text" name="thumbnail_url" placeholder="https://img.youtube.com/vi/..." class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <!-- Publication Checkboxes -->
                            <div class="p-3 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/60 space-y-2">
                                <span class="text-xs font-bold text-[#541F1D] block">PUBLICATION TARGETS</span>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="publish_videos" value="1" checked class="rounded text-[#541F1D]">
                                    <span>Publish to Videos Page (/videos)</span>
                                </label>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="show_on_home" value="1" checked class="rounded text-[#541F1D]">
                                    <span>Show on Home Latest Videos</span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <!-- 3. UPLOADED VIDEO FIELDS -->
                    <template x-if="mediaType === 'video'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Video File Upload * (MP4, WEBM)</label>
                                <input type="file" name="media_file" accept="video/mp4,video/webm" required class="w-full text-xs text-[#81766D] file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Video Title *</label>
                                <input type="text" name="title" required placeholder="e.g. Planetary Transits Guidance" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Tag / Category</label>
                                <input type="text" name="tag" placeholder="e.g. Astrologer Tamal Chakraborty" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Thumbnail Cover Image Upload (Optional)</label>
                                <input type="file" name="thumbnail_file" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-[#81766D] file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D]">
                            </div>

                            <!-- Publication Checkboxes -->
                            <div class="p-3 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/60 space-y-2">
                                <span class="text-xs font-bold text-[#541F1D] block">PUBLICATION TARGETS</span>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="publish_videos" value="1" checked class="rounded text-[#541F1D]">
                                    <span>Publish to Videos Page (/videos)</span>
                                </label>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="show_on_home" value="1" checked class="rounded text-[#541F1D]">
                                    <span>Show on Home Latest Videos</span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <!-- Common Fields: Sort Order & Published Status -->
                    <div class="grid grid-cols-2 gap-4 pt-2 border-t border-[#D8C6A8]/40">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Display Sort Order</label>
                            <input type="number" name="sort_order" value="0" min="0" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">STATUS</label>
                            <label class="flex items-center space-x-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="is_published" value="1" checked class="rounded text-[#541F1D]">
                                <span class="text-xs font-bold text-[#541F1D]">Published</span>
                            </label>
                        </div>
                    </div>

                    <!-- Modal Submit Footer -->
                    <div class="pt-4 border-t border-[#D8C6A8]/40 flex items-center justify-end space-x-2">
                        <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</button>
                        <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] shadow-md">
                            Save Media Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 2: EDIT MEDIA ITEM -->
    <div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-xs" @click="editModal = false"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-[#FDFBF7] max-w-lg w-full p-6 rounded-2xl border border-[#D8C6A8] shadow-2xl space-y-5">
                <div class="flex items-center justify-between border-b border-[#D8C6A8]/40 pb-3">
                    <h2 class="text-base font-bold font-serif-luxury text-[#541F1D]">Edit Media Item</h2>
                    <button type="button" @click="editModal = false" class="text-xs font-bold text-[#81766D] hover:text-[#541F1D]">✕</button>
                </div>

                <form method="POST" :action="'/admin-tamal/media/' + activeItem.id" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Media Type Display -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">MEDIA TYPE</label>
                        <input type="text" readonly :value="activeItem.type ? activeItem.type.toUpperCase() : ''" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl font-bold text-[#541F1D] focus:outline-none">
                        <input type="hidden" name="type" :value="activeItem.type">
                    </div>

                    <!-- Title -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Title *</label>
                        <input type="text" name="title" :value="activeItem.title" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <!-- Dynamic Fields according to type -->
                    <template x-if="activeItem.type === 'image'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Caption / Description</label>
                                <textarea name="caption" rows="2" :value="activeItem.caption" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none"></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Replace Image File (Optional)</label>
                                <input type="file" name="media_file" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-[#81766D]">
                            </div>

                            <div class="p-3 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/60 space-y-2">
                                <span class="text-xs font-bold text-[#541F1D] block">PUBLICATION TARGET</span>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="publish_gallery" value="1" :checked="activeItem.publish_gallery" class="rounded text-[#541F1D]">
                                    <span>Publish to Public Gallery (/gallery)</span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <template x-if="activeItem.type === 'youtube'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">YouTube Link URL *</label>
                                <input type="url" name="url" :value="activeItem.url" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Tag / Category</label>
                                <input type="text" name="tag" :value="activeItem.tag" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Replace Thumbnail Cover Image (Optional)</label>
                                <input type="file" name="thumbnail_file" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-[#81766D]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Thumbnail Image URL</label>
                                <input type="text" name="thumbnail_url" :value="activeItem.thumbnail" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div class="p-3 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/60 space-y-2">
                                <span class="text-xs font-bold text-[#541F1D] block">PUBLICATION TARGETS</span>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="publish_videos" value="1" :checked="activeItem.publish_videos" class="rounded text-[#541F1D]">
                                    <span>Publish to Videos Page (/videos)</span>
                                </label>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="show_on_home" value="1" :checked="activeItem.show_on_home" class="rounded text-[#541F1D]">
                                    <span>Show on Home Latest Videos</span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <template x-if="activeItem.type === 'video'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Replace Video File (Optional)</label>
                                <input type="file" name="media_file" accept="video/mp4,video/webm" class="w-full text-xs text-[#81766D]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Tag / Category</label>
                                <input type="text" name="tag" :value="activeItem.tag" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#541F1D] mb-1">Replace Thumbnail Cover Image (Optional)</label>
                                <input type="file" name="thumbnail_file" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-[#81766D]">
                            </div>

                            <div class="p-3 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/60 space-y-2">
                                <span class="text-xs font-bold text-[#541F1D] block">PUBLICATION TARGETS</span>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="publish_videos" value="1" :checked="activeItem.publish_videos" class="rounded text-[#541F1D]">
                                    <span>Publish to Videos Page (/videos)</span>
                                </label>
                                <label class="flex items-center space-x-2 text-xs font-bold text-[#541F1D] cursor-pointer">
                                    <input type="checkbox" name="show_on_home" value="1" :checked="activeItem.show_on_home" class="rounded text-[#541F1D]">
                                    <span>Show on Home Latest Videos</span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <!-- Common Sort Order & Status -->
                    <div class="grid grid-cols-2 gap-4 pt-2 border-t border-[#D8C6A8]/40">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Display Sort Order</label>
                            <input type="number" name="sort_order" :value="activeItem.sort_order" min="0" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">STATUS</label>
                            <label class="flex items-center space-x-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="is_published" value="1" :checked="activeItem.is_published" class="rounded text-[#541F1D]">
                                <span class="text-xs font-bold text-[#541F1D]">Published</span>
                            </label>
                        </div>
                    </div>

                    <!-- Modal Actions Footer -->
                    <div class="pt-4 border-t border-[#D8C6A8]/40 flex items-center justify-end space-x-2">
                        <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</button>
                        <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] shadow-md">
                            Update Media Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
