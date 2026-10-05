@extends('admin.layouts.app')

@section('title', 'Home Page CMS Management')

@section('content')
<div class="max-w-6xl mx-auto space-y-6" x-data="{ 
    activeTab: 'videos',
    editingVideo: null,
    editingFeature: null,
    showVideoModal: false,
    showFeatureModal: false
}">

    <!-- Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-[#C49A45] tracking-widest uppercase mb-1">
                <span>CMS Content Editor</span>
                <span>•</span>
                <span>Ganesha Astro Consultancy</span>
            </div>
            <h1 class="text-2xl font-bold font-serif-luxury text-[#541F1D]">Home Page Management</h1>
            <p class="text-xs text-[#81766D] mt-1">Manage content, section visibility, feature items, and image-based video cards dynamically.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('home') }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#C49A45]/30 flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Live Home Page
            </a>
        </div>
    </div>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-xl text-xs font-semibold flex items-center justify-between shadow-xs">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-emerald-600 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-xl text-xs space-y-1">
            <div class="font-bold mb-1">Please correct the following errors:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Navigation Tabs -->
    <div class="bg-[#FDFBF7] p-2 rounded-2xl border border-[#D8C6A8] shadow-xs overflow-x-auto flex space-x-2">
        <button @click="activeTab = 'videos'" 
                :class="activeTab === 'videos' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            Latest Videos ({{ $videos->count() }})
        </button>

        <button @click="activeTab = 'visibility'" 
                :class="activeTab === 'visibility' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Section Visibility
        </button>

        <button @click="activeTab = 'hero'" 
                :class="activeTab === 'hero' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Hero Section
        </button>

        <button @click="activeTab = 'features'" 
                :class="activeTab === 'features' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Features ({{ $features->count() }})
        </button>

        <button @click="activeTab = 'booking'" 
                :class="activeTab === 'booking' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Quick Booking
        </button>

        <button @click="activeTab = 'prefooter'" 
                :class="activeTab === 'prefooter' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Pre-Footer CTA
        </button>
    </div>

    <!-- TAB 1: LATEST VIDEOS MANAGEMENT -->
    <div x-show="activeTab === 'videos'" class="space-y-6">
        <div class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#D8C6A8]/40 mb-6">
                <div>
                    <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Latest Videos Management</h2>
                    <p class="text-xs text-[#81766D] mt-0.5">Manage image-based video cards. Maximum 6 active videos will be displayed on the Home Page sorted by display order.</p>
                </div>
                <button @click="editingVideo = null; showVideoModal = true" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-sm flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    + Add New Video Card
                </button>
            </div>

            <!-- Video Section Header Settings Form -->
            <form method="POST" action="{{ route('admin.homepage.settings.update') }}" class="mb-8 p-4 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/50 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Eyebrow Text</label>
                        <input type="text" name="homepage_videos_eyebrow" value="{{ trim(str_replace('🎬', '', \App\Models\SiteSetting::get('homepage_videos_eyebrow', 'LATEST VIDEOS'))) }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Subheading</label>
                        <input type="text" name="homepage_videos_heading" value="{{ \App\Models\SiteSetting::get('homepage_videos_heading', 'From the consultation room') }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Right Action Link Text</label>
                        <input type="text" name="homepage_videos_btn_text" value="{{ \App\Models\SiteSetting::get('homepage_videos_btn_text', 'View all videos →') }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#C49A45]/30">
                        Save Video Header Text
                    </button>
                </div>
            </form>

            <!-- Video CRUD Table -->
            @if($videos->isEmpty())
                <div class="text-center py-12 border-2 border-dashed border-[#D8C6A8]/60 rounded-2xl bg-[#EDE3D4]/20">
                    <svg class="w-12 h-12 text-[#C49A45]/60 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-sm font-bold text-[#541F1D]">No Video Cards Added Yet</h3>
                    <p class="text-xs text-[#81766D] max-w-sm mx-auto mt-1 mb-4">Add your first video thumbnail card to display on the Home Page Latest Videos section.</p>
                    <button @click="editingVideo = null; showVideoModal = true" class="px-4 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211]">
                        + Add First Video Card
                    </button>
                </div>
            @else
                <div class="w-full overflow-x-auto rounded-xl border border-[#D8C6A8]/60 bg-white shadow-xs">
                    <table class="w-full text-left border-collapse text-xs align-middle" style="table-layout: fixed; min-width: 900px;">
                        <colgroup>
                            <col style="width: 105px;"> <!-- THUMBNAIL -->
                            <col style="width: 250px;"> <!-- TITLE -->
                            <col style="width: 140px;"> <!-- TAG -->
                            <col style="width: 100px;"> <!-- STATUS -->
                            <col style="width: 75px;">  <!-- ORDER -->
                            <col style="width: 190px;"> <!-- VIDEO URL -->
                            <col style="width: 150px;"> <!-- ACTIONS -->
                        </colgroup>
                        <thead class="bg-[#351211] text-[#F7F0E3] font-serif-luxury uppercase tracking-wider text-[11px]">
                            <tr>
                                <th class="py-3.5 px-3.5 whitespace-nowrap align-middle">THUMBNAIL</th>
                                <th class="py-3.5 px-3.5 whitespace-nowrap align-middle">TITLE</th>
                                <th class="py-3.5 px-3.5 whitespace-nowrap align-middle">TAG</th>
                                <th class="py-3.5 px-3.5 whitespace-nowrap align-middle">STATUS</th>
                                <th class="py-3.5 px-3.5 whitespace-nowrap align-middle text-center">ORDER</th>
                                <th class="py-3.5 px-3.5 whitespace-nowrap align-middle">VIDEO URL</th>
                                <th class="py-3.5 px-3.5 whitespace-nowrap align-middle text-right">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#D8C6A8]/40">
                            @foreach($videos as $video)
                                <tr class="hover:bg-[#EDE3D4]/20 transition-colors">
                                    <td class="py-3 px-3.5 align-middle whitespace-nowrap">
                                        @if($video->thumbnail)
                                            <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}" class="w-[72px] h-[48px] object-cover rounded-lg border border-[#D8C6A8] shadow-xs shrink-0">
                                        @else
                                            <div class="w-[72px] h-[48px] rounded-lg bg-[#EDE3D4]/40 border border-[#D8C6A8] flex items-center justify-center text-[10px] text-[#81766D] italic">No image</div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3.5 align-middle">
                                        <div class="font-semibold text-[#541F1D] text-xs leading-snug line-clamp-2 break-words" title="{{ $video->title }}">
                                            {{ $video->title }}
                                        </div>
                                    </td>
                                    <td class="py-3 px-3.5 align-middle">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#F3E5CC] text-[#75452D] text-[11px] font-semibold tracking-wide truncate max-w-[130px]" title="{{ $video->tag ?? '—' }}">
                                            {{ $video->tag ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3.5 align-middle whitespace-nowrap">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $video->is_active ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-slate-100 text-slate-600 border border-slate-300' }}">
                                            {{ $video->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3.5 align-middle text-center font-bold text-[#C49A45] whitespace-nowrap">
                                        {{ $video->display_order }}
                                    </td>
                                    <td class="py-3 px-3.5 align-middle overflow-hidden whitespace-nowrap">
                                        <a href="{{ $video->video_url }}" target="_blank" rel="noopener noreferrer" title="{{ $video->video_url }}" class="inline-flex items-center text-xs text-[#C49A45] font-semibold hover:underline truncate max-w-[180px]">
                                            <span class="truncate">{{ $video->video_url }}</span>
                                            <svg class="w-3 h-3 ml-1 shrink-0 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    </td>
                                    <td class="py-3 px-3.5 align-middle text-right whitespace-nowrap">
                                        <div class="inline-flex items-center justify-end space-x-2">
                                            <button @click="editingVideo = {{ json_encode($video) }}; showVideoModal = true" class="px-3 py-1.5 rounded-lg text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#C49A45]/30 transition-colors">
                                                Edit
                                            </button>
                                            <form method="POST" action="{{ route('admin.homepage.videos.destroy', $video->id) }}" onsubmit="return confirm('Are you sure you want to delete this video card?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- TAB 2: SECTION VISIBILITY & OVERVIEW -->
    <div x-show="activeTab === 'visibility'" class="space-y-6">
        <form method="POST" action="{{ route('admin.homepage.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Home Page Section Visibility</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Enable or disable specific sections on the live public Home Page.</p>
            </div>

            <div class="space-y-4">
                <!-- Hero Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">1. Hero Section</div>
                        <div class="text-xs text-[#81766D]">Displays the main top banner, mantra, heading, consultation buttons, and stats.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_hero_active" value="1" {{ \App\Models\SiteSetting::get('section_hero_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Features Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">2. Feature Section</div>
                        <div class="text-xs text-[#81766D]">Displays the 5 key astrology pillars (Vedic Astrology, Personalized Guidance, etc.).</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_features_active" value="1" {{ \App\Models\SiteSetting::get('section_features_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Quick Booking Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">3. Quick Booking Section</div>
                        <div class="text-xs text-[#81766D]">Displays consultation booking cards (Normal ₹3,000 / Urgent ₹5,000).</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_quick_booking_active" value="1" {{ \App\Models\SiteSetting::get('section_quick_booking_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Latest Videos Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">4. Latest Videos Section</div>
                        <div class="text-xs text-[#81766D]">Displays image-based video cards from the consultation room.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_videos_active" value="1" {{ \App\Models\SiteSetting::get('section_videos_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Pre-Footer Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">5. Pre-Footer Contact Section</div>
                        <div class="text-xs text-[#81766D]">Displays Call, WhatsApp, and Email CTA buttons above footer.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_pre_footer_active" value="1" {{ \App\Models\SiteSetting::get('section_pre_footer_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Visibility Settings
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 3: HERO SECTION EDIT -->
    <div x-show="activeTab === 'hero'" class="space-y-6">
        <form method="POST" action="{{ route('admin.homepage.settings.update') }}" enctype="multipart/form-data" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Edit Hero Section</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize the main hero banner headline, mantra, description, action buttons, and statistics.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Eyebrow -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Eyebrow Badge Text</label>
                    <input type="text" name="homepage_hero_eyebrow" value="{{ \App\Models\SiteSetting::get('homepage_hero_eyebrow', 'AUTHENTIC VEDIC ASTROLOGY') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Main Heading -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Main Heading</label>
                    <input type="text" name="homepage_hero_heading" value="{{ \App\Models\SiteSetting::get('homepage_hero_heading', 'Ganesha Astro Consultancy') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Mantra -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Sanskrit Mantra / Subheading</label>
                    <input type="text" name="homepage_hero_mantra" value="{{ \App\Models\SiteSetting::get('homepage_hero_mantra', '॥ ॐ শ্রী গণেশায় নমঃ ॥') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Hero Description Paragraph</label>
                    <textarea name="homepage_hero_description" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('homepage_hero_description', 'Discover clarity and purpose with genuine Vedic astrology guidance from Tamal Chakraborty. Get precise birth chart analysis, life solutions, and practical remedies.') }}</textarea>
                </div>

                <!-- Primary Button Text & URL -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Primary Button Text</label>
                    <input type="text" name="homepage_hero_primary_btn_text" value="{{ \App\Models\SiteSetting::get('homepage_hero_primary_btn_text', 'Book Consultation') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Primary Button URL</label>
                    <input type="text" name="homepage_hero_primary_btn_url" value="{{ \App\Models\SiteSetting::get('homepage_hero_primary_btn_url', '#quick-booking') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Secondary Button Text & URL -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Secondary Button Text</label>
                    <input type="text" name="homepage_hero_secondary_btn_text" value="{{ \App\Models\SiteSetting::get('homepage_hero_secondary_btn_text', 'Explore Services') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Secondary Button URL</label>
                    <input type="text" name="homepage_hero_secondary_btn_url" value="{{ \App\Models\SiteSetting::get('homepage_hero_secondary_btn_url', '/services') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Hero Image Upload -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Hero Image / Astrologer Portrait</label>
                    <div class="flex items-center space-x-4">
                        @if(\App\Models\SiteSetting::get('homepage_hero_image'))
                            <img src="{{ asset(\App\Models\SiteSetting::get('homepage_hero_image')) }}" alt="Hero Image" class="w-16 h-16 object-cover rounded-xl border border-[#D8C6A8]">
                        @endif
                        <input type="file" name="homepage_hero_image" accept="image/jpeg,image/png,image/webp" class="text-xs text-[#81766D] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D] hover:file:bg-[#D8C6A8]">
                    </div>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="pt-6 border-t border-[#D8C6A8]/40 space-y-4">
                <h3 class="text-sm font-bold font-serif-luxury text-[#541F1D]">Hero Key Statistics</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Stat 1 -->
                    <div class="p-3 bg-[#EDE3D4]/20 rounded-xl border border-[#D8C6A8]/40 space-y-2">
                        <span class="text-xs font-bold text-[#C49A45]">Statistic 1</span>
                        <input type="text" name="homepage_hero_stat1_number" placeholder="15+" value="{{ \App\Models\SiteSetting::get('homepage_hero_stat1_number', '15+') }}" class="w-full px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-lg">
                        <input type="text" name="homepage_hero_stat1_label" placeholder="Years Experience" value="{{ \App\Models\SiteSetting::get('homepage_hero_stat1_label', 'Years Experience') }}" class="w-full px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-lg">
                    </div>

                    <!-- Stat 2 -->
                    <div class="p-3 bg-[#EDE3D4]/20 rounded-xl border border-[#D8C6A8]/40 space-y-2">
                        <span class="text-xs font-bold text-[#C49A45]">Statistic 2</span>
                        <input type="text" name="homepage_hero_stat2_number" placeholder="10,000+" value="{{ \App\Models\SiteSetting::get('homepage_hero_stat2_number', '10,000+') }}" class="w-full px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-lg">
                        <input type="text" name="homepage_hero_stat2_label" placeholder="Consultations Done" value="{{ \App\Models\SiteSetting::get('homepage_hero_stat2_label', 'Consultations Done') }}" class="w-full px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-lg">
                    </div>

                    <!-- Stat 3 -->
                    <div class="p-3 bg-[#EDE3D4]/20 rounded-xl border border-[#D8C6A8]/40 space-y-2">
                        <span class="text-xs font-bold text-[#C49A45]">Statistic 3</span>
                        <input type="text" name="homepage_hero_stat3_number" placeholder="98%" value="{{ \App\Models\SiteSetting::get('homepage_hero_stat3_number', '98%') }}" class="w-full px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-lg">
                        <input type="text" name="homepage_hero_stat3_label" placeholder="Satisfaction Rate" value="{{ \App\Models\SiteSetting::get('homepage_hero_stat3_label', 'Satisfaction Rate') }}" class="w-full px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-lg">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Hero Settings
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 4: FEATURES MANAGEMENT -->
    <div x-show="activeTab === 'features'" class="space-y-6">
        <div class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#D8C6A8]/40 mb-6">
                <div>
                    <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Feature Items Management</h2>
                    <p class="text-xs text-[#81766D] mt-0.5">Manage the 5 feature items displayed below the hero section.</p>
                </div>
                <button @click="editingFeature = null; showFeatureModal = true" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-sm flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    + Add New Feature Item
                </button>
            </div>

            <div class="space-y-3">
                @foreach($features as $feature)
                    <div class="p-4 bg-white rounded-xl border border-[#D8C6A8]/60 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-9 h-9 rounded-full bg-[#EDE3D4] flex items-center justify-center text-[#541F1D] font-bold shrink-0">
                                {{ $feature->display_order }}
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-bold text-[#541F1D]">{{ $feature->title }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $feature->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $feature->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="text-xs text-[#81766D] mt-0.5">{{ $feature->description }}</div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 shrink-0">
                            <button @click="editingFeature = {{ json_encode($feature) }}; showFeatureModal = true" class="px-3 py-1.5 rounded-lg text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.homepage.features.destroy', $feature->id) }}" onsubmit="return confirm('Delete this feature item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- TAB 5: QUICK BOOKING SECTION EDIT -->
    <div x-show="activeTab === 'booking'" class="space-y-6">
        <form method="POST" action="{{ route('admin.homepage.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Edit Quick Booking Section Content</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize the section title, eyebrow, descriptions, and display titles for consultations. Note: Secure server-side pricing remains intact.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Eyebrow -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Eyebrow</label>
                    <input type="text" name="homepage_qb_eyebrow" value="{{ \App\Models\SiteSetting::get('homepage_qb_eyebrow', 'QUICK BOOKING') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Main Heading -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Heading</label>
                    <input type="text" name="homepage_qb_heading" value="{{ \App\Models\SiteSetting::get('homepage_qb_heading', 'Schedule Your Personal Consultation') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Description</label>
                    <textarea name="homepage_qb_description" rows="2" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('homepage_qb_description', 'Choose between standard consultation (within 1 week) or urgent priority consultation (within 24 hours). Audio call only.') }}</textarea>
                </div>

                <!-- Normal Consultation -->
                <div class="p-4 bg-white rounded-xl border border-[#D8C6A8]/60 space-y-3">
                    <h3 class="text-xs font-bold text-[#C49A45] uppercase tracking-wider">Normal Consultation Card</h3>
                    <div>
                        <label class="block text-[11px] font-bold text-[#541F1D] mb-1">Card Title</label>
                        <input type="text" name="homepage_qb_normal_title" value="{{ \App\Models\SiteSetting::get('homepage_qb_normal_title', 'NORMAL CONSULTATION') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/20 border border-[#D8C6A8] rounded-lg">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#541F1D] mb-1">Display Price Text</label>
                        <input type="text" name="homepage_qb_normal_price" value="{{ \App\Models\SiteSetting::get('homepage_qb_normal_price', '₹3,000') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/20 border border-[#D8C6A8] rounded-lg">
                    </div>
                </div>

                <!-- Urgent Consultation -->
                <div class="p-4 bg-white rounded-xl border border-[#D8C6A8]/60 space-y-3">
                    <h3 class="text-xs font-bold text-[#C49A45] uppercase tracking-wider">Urgent Consultation Card</h3>
                    <div>
                        <label class="block text-[11px] font-bold text-[#541F1D] mb-1">Card Title</label>
                        <input type="text" name="homepage_qb_urgent_title" value="{{ \App\Models\SiteSetting::get('homepage_qb_urgent_title', 'URGENT CONSULTATION') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/20 border border-[#D8C6A8] rounded-lg">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#541F1D] mb-1">Display Price Text</label>
                        <input type="text" name="homepage_qb_urgent_price" value="{{ \App\Models\SiteSetting::get('homepage_qb_urgent_price', '₹5,000') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/20 border border-[#D8C6A8] rounded-lg">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Booking Content
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 6: PRE-FOOTER SECTION EDIT -->
    <div x-show="activeTab === 'prefooter'" class="space-y-6">
        <form method="POST" action="{{ route('admin.homepage.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Edit Pre-Footer Contact Section</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize contact CTA heading and button text.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Eyebrow -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Eyebrow Text</label>
                    <input type="text" name="homepage_pf_eyebrow" value="{{ \App\Models\SiteSetting::get('homepage_pf_eyebrow', 'CONTACT') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Main Heading -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Main Heading</label>
                    <input type="text" name="homepage_pf_heading" value="{{ \App\Models\SiteSetting::get('homepage_pf_heading', 'Contact Ganesha Astro Consultancy') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Call Button Text -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Call Button Label</label>
                    <input type="text" name="homepage_pf_call_text" value="{{ \App\Models\SiteSetting::get('homepage_pf_call_text', 'Call') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- WhatsApp Button Text -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">WhatsApp Button Label</label>
                    <input type="text" name="homepage_pf_whatsapp_text" value="{{ \App\Models\SiteSetting::get('homepage_pf_whatsapp_text', 'WhatsApp') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <!-- Email Button Text -->
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Email Button Label</label>
                    <input type="text" name="homepage_pf_email_text" value="{{ \App\Models\SiteSetting::get('homepage_pf_email_text', 'Email') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div class="p-4 bg-emerald-50/60 rounded-xl border border-emerald-200/80 text-xs text-emerald-900 space-y-1">
                    <div class="font-bold">Official Contact Credentials Preserved:</div>
                    <div>Phone: <span class="font-bold">8392059201</span></div>
                    <div>Email: <span class="font-bold">ganesha4astro@gmail.com</span></div>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Pre-Footer Settings
                </button>
            </div>
        </form>
    </div>

    <!-- MODAL 1: ADD/EDIT VIDEO CARD -->
    <div x-show="showVideoModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-xs" @click="showVideoModal = false"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8] shadow-2xl max-w-lg w-full p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-[#D8C6A8]/40 pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]" x-text="editingVideo ? 'Edit Video Card' : 'Add New Video Card'"></h3>
                    <button @click="showVideoModal = false" class="text-[#81766D] hover:text-[#541F1D]">✕</button>
                </div>

                <form method="POST" :action="editingVideo ? '/admin-tamal/homepage/videos/' + editingVideo.id : '{{ route('admin.homepage.videos.store') }}'" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <template x-if="editingVideo">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <!-- Existing Thumbnail Preview if editing -->
                    <template x-if="editingVideo && editingVideo.thumbnail">
                        <div class="p-3 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/60 flex items-center space-x-3">
                            <img :src="editingVideo.thumbnail" alt="Current Thumbnail" class="w-20 h-12 object-cover rounded-lg border border-[#D8C6A8] shadow-xs shrink-0">
                            <div class="min-w-0 flex-1">
                                <span class="text-xs font-bold text-[#541F1D] block">Current Thumbnail</span>
                                <span class="text-[11px] text-[#81766D] truncate block" x-text="editingVideo.thumbnail"></span>
                            </div>
                        </div>
                    </template>

                    <!-- Title -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Video Title *</label>
                        <input type="text" name="title" :value="editingVideo ? editingVideo.title : ''" required placeholder="Understanding your birth chart" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <!-- Tag / Category -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Tag / Category</label>
                        <input type="text" name="tag" :value="editingVideo ? editingVideo.tag : ''" placeholder="Kundli Basics" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <!-- Video URL -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Video Link URL (YouTube / Instagram / External) *</label>
                        <input type="url" name="video_url" :value="editingVideo ? editingVideo.video_url : ''" required placeholder="https://youtube.com/watch?v=..." class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <!-- Upload Thumbnail -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Upload New Thumbnail Image (JPG, JPEG, PNG, WEBP)</label>
                        <input type="file" name="thumbnail_file" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-[#81766D] file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D]">
                    </div>

                    <!-- Or Image URL -->
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Or Thumbnail Image URL (Optional override)</label>
                        <input type="text" name="thumbnail_url" :value="editingVideo ? editingVideo.thumbnail : ''" placeholder="https://images.unsplash.com/..." class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <!-- Display Order & Status -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Display Order</label>
                            <input type="number" name="display_order" :value="editingVideo ? editingVideo.display_order : 1" min="1" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Status</label>
                            <label class="flex items-center space-x-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" :checked="editingVideo ? editingVideo.is_active : true" class="rounded text-[#541F1D] focus:ring-0">
                                <span class="text-xs font-bold text-[#541F1D]">Active</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end space-x-2">
                        <button type="button" @click="showVideoModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</button>
                        <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211]">Save Video Card</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 2: ADD/EDIT FEATURE ITEM -->
    <div x-show="showFeatureModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-xs" @click="showFeatureModal = false"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8] shadow-2xl max-w-lg w-full p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-[#D8C6A8]/40 pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]" x-text="editingFeature ? 'Edit Feature Item' : 'Add New Feature Item'"></h3>
                    <button @click="showFeatureModal = false" class="text-[#81766D] hover:text-[#541F1D]">✕</button>
                </div>

                <form method="POST" :action="editingFeature ? '/admin-tamal/homepage/features/' + editingFeature.id : '{{ route('admin.homepage.features.store') }}'" class="space-y-4">
                    @csrf
                    <template x-if="editingFeature">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Title *</label>
                        <input type="text" name="title" :value="editingFeature ? editingFeature.title : ''" required placeholder="Vedic Astrology" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Description / Subtitle *</label>
                        <input type="text" name="description" :value="editingFeature ? editingFeature.description : ''" required placeholder="Authentic Knowledge" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Display Order</label>
                            <input type="number" name="display_order" :value="editingFeature ? editingFeature.display_order : 1" min="1" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Status</label>
                            <label class="flex items-center space-x-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" :checked="editingFeature ? editingFeature.is_active : true" class="rounded text-[#541F1D] focus:ring-0">
                                <span class="text-xs font-bold text-[#541F1D]">Active</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end space-x-2">
                        <button type="button" @click="showFeatureModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</button>
                        <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211]">Save Feature</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
