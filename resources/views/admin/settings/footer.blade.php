@extends('admin.layouts.app')

@section('title', 'Footer Manager')
@section('header_title', 'Footer Manager')
@section('header_subtitle', 'Manage complete public footer content, columns, quick navigation, guidance links, social media, contact details, copyright, and legal pages.')

@section('content')
<div x-data="{ 
    activeTab: 'general',
    navAddOpen: false,
    navEditOpen: false,
    navEdit: { id: null, label: '', link_type: 'internal', route_name: 'home', url: '', target: '_self', sort_order: 0, is_active: true, actionUrl: '' },
    openNavEdit(item, url) {
        this.navEdit = { ...item, is_active: !!item.is_active, actionUrl: url };
        this.navEditOpen = true;
    },

    guidanceAddOpen: false,
    guidanceEditOpen: false,
    guidanceEdit: { id: null, label: '', link_type: 'custom', route_name: '', url: '', target: '_self', sort_order: 0, is_active: true, actionUrl: '' },
    openGuidanceEdit(item, url) {
        this.guidanceEdit = { ...item, is_active: !!item.is_active, actionUrl: url };
        this.guidanceEditOpen = true;
    },

    socialAddOpen: false,
    socialEditOpen: false,
    socialEdit: { id: null, platform: '', url: '', icon: '', sort_order: 0, is_active: true, actionUrl: '' },
    openSocialEdit(item, url) {
        this.socialEdit = { ...item, is_active: !!item.is_active, actionUrl: url };
        this.socialEditOpen = true;
    }
}" class="space-y-8 max-w-6xl">

    @if (session('status'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-2xl flex items-center justify-between">
            <span>{{ session('status') }}</span>
            <button @click="$el.parentElement.remove()" class="text-emerald-900 font-bold ml-4">✕</button>
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 bg-red-100 border border-red-300 text-red-800 text-xs font-bold rounded-2xl flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button @click="$el.parentElement.remove()" class="text-red-900 font-bold ml-4">✕</button>
        </div>
    @endif

    <!-- Top Action Bar -->
    <div class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#0B3D2E]">Footer Manager</h1>
            <p class="text-xs text-[#60736B] mt-1">Configure all 4 footer columns, quick navigation links, guidance items, social media handles, contact info, copyright, and legal pages.</p>
        </div>

        <div class="flex items-center space-x-3 w-full md:w-auto justify-end">
            <form method="POST" action="{{ route('admin.settings.footer.reset') }}" onsubmit="return confirm('Reset Footer Manager to default values? This will restore default navigation, guidance, and social handles.')">
                @csrf
                <button type="submit" class="px-4 py-2 text-xs font-bold text-amber-900 bg-amber-100 hover:bg-amber-200 border border-amber-300 rounded-xl transition-all">
                    ↺ Reset Footer to Default
                </button>
            </form>

            <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] border border-[#C8D8CF] transition-all">
                ← Back to Settings
            </a>
        </div>
    </div>

    <!-- Navigation Tabs A-H -->
    <div class="flex border-b border-[#C8D8CF] space-x-2 overflow-x-auto pb-1">
        <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            A. Footer General
        </button>
        <button @click="activeTab = 'columns'" :class="activeTab === 'columns' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            B. Column Titles
        </button>
        <button @click="activeTab = 'quicknav'" :class="activeTab === 'quicknav' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            C. Quick Navigation
        </button>
        <button @click="activeTab = 'guidance'" :class="activeTab === 'guidance' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            D. Our Guidance
        </button>
        <button @click="activeTab = 'social'" :class="activeTab === 'social' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            E. Social Media
        </button>
        <button @click="activeTab = 'contact'" :class="activeTab === 'contact' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            F. Contact Details
        </button>
        <button @click="activeTab = 'copyright'" :class="activeTab === 'copyright' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            G. Copyright
        </button>
        <button @click="activeTab = 'legal'" :class="activeTab === 'legal' ? 'bg-[#0B3D2E] text-[#FFFFFF] font-bold border-[#C49A45]' : 'bg-[#FFFFFF] text-[#0B3D2E] hover:bg-[#E8F1EC]'" class="px-4 py-2 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            H. Legal Pages
        </button>
    </div>

    <!-- SECTION A: FOOTER GENERAL -->
    <div x-show="activeTab === 'general'" x-cloak>
        <form method="POST" action="{{ route('admin.settings.footer.update-general') }}" enctype="multipart/form-data" class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs space-y-6">
            @csrf

            <!-- Preserve fields from other tabs -->
            <input type="hidden" name="footer_col2_title" value="{{ $settings['footer_col2_title'] }}">
            <input type="hidden" name="footer_col3_title" value="{{ $settings['footer_col3_title'] }}">
            <input type="hidden" name="footer_col4_title" value="{{ $settings['footer_col4_title'] }}">

            <input type="hidden" name="footer_contact_brand" value="{{ $settings['footer_contact_brand'] }}">
            <input type="hidden" name="footer_contact_phone" value="{{ $settings['footer_contact_phone'] }}">
            <input type="hidden" name="footer_contact_whatsapp" value="{{ $settings['footer_contact_whatsapp'] }}">
            <input type="hidden" name="footer_contact_email" value="{{ $settings['footer_contact_email'] }}">
            <input type="hidden" name="footer_contact_address" value="{{ $settings['footer_contact_address'] }}">
            <input type="hidden" name="footer_contact_website" value="{{ $settings['footer_contact_website'] }}">
            <input type="hidden" name="footer_contact_map_url" value="{{ $settings['footer_contact_map_url'] }}">

            <input type="hidden" name="footer_copyright_text" value="{{ $settings['footer_copyright_text'] }}">

            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-[#E8F1EC]/60 rounded-2xl border border-[#C8D8CF]">
                    <div>
                        <span class="block text-sm font-bold text-[#0B3D2E]">Enable Public Footer</span>
                        <span class="text-xs text-[#60736B]">Toggle whether the footer renders on public site pages.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="footer_enabled" value="0">
                        <input type="checkbox" name="footer_enabled" value="1" {{ $settings['footer_enabled'] == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0B3D2E]"></div>
                    </label>
                </div>

                <div class="p-5 bg-[#E8F1EC]/20 rounded-2xl border border-[#C8D8CF] space-y-4">
                    <h3 class="font-serif-luxury text-sm font-bold text-[#0B3D2E]">Footer Brand Logo & Description</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset($settings['footer_logo']) }}" alt="Footer Logo" class="h-12 w-auto bg-[#0B3D2E] p-2 rounded-xl object-contain">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="hidden" name="footer_logo_visible" value="0">
                                    <input type="checkbox" name="footer_logo_visible" value="1" {{ $settings['footer_logo_visible'] == '1' ? 'checked' : '' }} class="rounded border-[#C8D8CF]">
                                    <span class="text-xs font-bold text-[#0B3D2E]">Logo Visible</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Upload New Footer Logo</label>
                                <input type="file" name="logo_file" accept="image/*" class="w-full text-xs text-[#60736B] file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#E8F1EC] file:text-[#0B3D2E]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Logo Width (px)</label>
                                <input type="text" name="footer_logo_width" value="{{ $settings['footer_logo_width'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Footer Brand Description</label>
                            <textarea name="footer_description" rows="5" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl focus:outline-none">{{ $settings['footer_description'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-[#C8D8CF]/40">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] shadow-md border border-[#C49A45]/40 transition-all">
                    Save General Footer Settings
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION B: COLUMN TITLES -->
    <div x-show="activeTab === 'columns'" x-cloak>
        <form method="POST" action="{{ route('admin.settings.footer.update-general') }}" class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs space-y-6">
            @csrf

            <!-- Preserve fields -->
            <input type="hidden" name="footer_enabled" value="{{ $settings['footer_enabled'] }}">
            <input type="hidden" name="footer_logo_width" value="{{ $settings['footer_logo_width'] }}">
            <input type="hidden" name="footer_description" value="{{ $settings['footer_description'] }}">
            <input type="hidden" name="footer_contact_brand" value="{{ $settings['footer_contact_brand'] }}">
            <input type="hidden" name="footer_contact_phone" value="{{ $settings['footer_contact_phone'] }}">
            <input type="hidden" name="footer_contact_whatsapp" value="{{ $settings['footer_contact_whatsapp'] }}">
            <input type="hidden" name="footer_contact_email" value="{{ $settings['footer_contact_email'] }}">
            <input type="hidden" name="footer_contact_address" value="{{ $settings['footer_contact_address'] }}">
            <input type="hidden" name="footer_contact_website" value="{{ $settings['footer_contact_website'] }}">
            <input type="hidden" name="footer_contact_map_url" value="{{ $settings['footer_contact_map_url'] }}">
            <input type="hidden" name="footer_copyright_text" value="{{ $settings['footer_copyright_text'] }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-[#F3F8F5] rounded-2xl border border-[#C8D8CF] space-y-3">
                    <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-2">
                        <h4 class="font-serif-luxury text-xs font-bold text-[#0B3D2E]">Column 1: Brand Info & Social</h4>
                        <label class="flex items-center space-x-1.5 cursor-pointer">
                            <input type="hidden" name="footer_col1_enabled" value="0">
                            <input type="checkbox" name="footer_col1_enabled" value="1" {{ $settings['footer_col1_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#C8D8CF]">
                            <span class="text-xs font-bold text-[#0B3D2E]">Visible</span>
                        </label>
                    </div>
                    <p class="text-[11px] text-[#60736B]">Contains brand logo, description, and social media icons.</p>
                </div>

                <div class="p-4 bg-[#F3F8F5] rounded-2xl border border-[#C8D8CF] space-y-3">
                    <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-2">
                        <h4 class="font-serif-luxury text-xs font-bold text-[#0B3D2E]">Column 2: Quick Navigation</h4>
                        <label class="flex items-center space-x-1.5 cursor-pointer">
                            <input type="hidden" name="footer_col2_enabled" value="0">
                            <input type="checkbox" name="footer_col2_enabled" value="1" {{ $settings['footer_col2_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#C8D8CF]">
                            <span class="text-xs font-bold text-[#0B3D2E]">Visible</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Column Title</label>
                        <input type="text" name="footer_col2_title" value="{{ $settings['footer_col2_title'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>
                </div>

                <div class="p-4 bg-[#F3F8F5] rounded-2xl border border-[#C8D8CF] space-y-3">
                    <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-2">
                        <h4 class="font-serif-luxury text-xs font-bold text-[#0B3D2E]">Column 3: Our Guidance</h4>
                        <label class="flex items-center space-x-1.5 cursor-pointer">
                            <input type="hidden" name="footer_col3_enabled" value="0">
                            <input type="checkbox" name="footer_col3_enabled" value="1" {{ $settings['footer_col3_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#C8D8CF]">
                            <span class="text-xs font-bold text-[#0B3D2E]">Visible</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Column Title</label>
                        <input type="text" name="footer_col3_title" value="{{ $settings['footer_col3_title'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>
                </div>

                <div class="p-4 bg-[#F3F8F5] rounded-2xl border border-[#C8D8CF] space-y-3">
                    <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-2">
                        <h4 class="font-serif-luxury text-xs font-bold text-[#0B3D2E]">Column 4: Consultation Office / Contact</h4>
                        <label class="flex items-center space-x-1.5 cursor-pointer">
                            <input type="hidden" name="footer_col4_enabled" value="0">
                            <input type="checkbox" name="footer_col4_enabled" value="1" {{ $settings['footer_col4_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#C8D8CF]">
                            <span class="text-xs font-bold text-[#0B3D2E]">Visible</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Column Title</label>
                        <input type="text" name="footer_col4_title" value="{{ $settings['footer_col4_title'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-[#C8D8CF]/40">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] shadow-md border border-[#C49A45]/40 transition-all">
                    Save Column Titles Settings
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION C: QUICK NAVIGATION CRUD -->
    <div x-show="activeTab === 'quicknav'" x-cloak class="space-y-6">
        <div class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Quick Navigation Items</h3>
                    <p class="text-xs text-[#60736B]">Manage the 7 default links (Home, About, Services, Shop, Gallery, Videos, Contact) or custom footer navigation links.</p>
                </div>
                <button type="button" @click="navAddOpen = true" class="px-4 py-2 text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-xs">
                    + Add Quick Nav Link
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Order</th>
                            <th class="pb-3 px-3">Label</th>
                            <th class="pb-3 px-3">Link Type</th>
                            <th class="pb-3 px-3">Destination</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($navItems as $item)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3 px-3 font-mono font-bold text-[#0B3D2E]">#{{ $item->sort_order }}</td>
                                <td class="py-3 px-3 font-bold text-[#0B3D2E]">{{ $item->label }}</td>
                                <td class="py-3 px-3"><span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-[#E8F1EC] text-[#0B3D2E]">{{ $item->link_type }}</span></td>
                                <td class="py-3 px-3 font-mono text-[11px] text-[#60736B]">{{ $item->link_type === 'internal' ? $item->route_name : ($item->url ?: '-') }}</td>
                                <td class="py-3 px-3"><span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">{{ $item->is_active ? 'Active' : 'Disabled' }}</span></td>
                                <td class="py-3 px-3 text-right space-x-2">
                                    <button type="button" @click="openNavEdit({{ json_encode($item) }}, '{{ route('admin.settings.footer.nav.update', $item) }}')" class="px-3 py-1 text-xs font-bold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] rounded-lg border border-[#C8D8CF]">Edit</button>
                                    <form method="POST" action="{{ route('admin.settings.footer.nav.destroy', $item) }}" class="inline-block" onsubmit="return confirm('Delete this Quick Navigation item?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-red-800 bg-red-100 hover:bg-red-200 rounded-lg">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SECTION D: OUR GUIDANCE CRUD -->
    <div x-show="activeTab === 'guidance'" x-cloak class="space-y-6">
        <div class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Our Guidance Links</h3>
                    <p class="text-xs text-[#60736B]">Manage consultation offering links in Column 3.</p>
                </div>
                <button type="button" @click="guidanceAddOpen = true" class="px-4 py-2 text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-xs">
                    + Add Guidance Item
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Order</th>
                            <th class="pb-3 px-3">Label</th>
                            <th class="pb-3 px-3">URL</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($guidanceItems as $item)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3 px-3 font-mono font-bold text-[#0B3D2E]">#{{ $item->sort_order }}</td>
                                <td class="py-3 px-3 font-bold text-[#0B3D2E]">{{ $item->label }}</td>
                                <td class="py-3 px-3 font-mono text-[11px] text-[#60736B]">{{ $item->url ?: '-' }}</td>
                                <td class="py-3 px-3"><span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">{{ $item->is_active ? 'Active' : 'Disabled' }}</span></td>
                                <td class="py-3 px-3 text-right space-x-2">
                                    <button type="button" @click="openGuidanceEdit({{ json_encode($item) }}, '{{ route('admin.settings.footer.guidance.update', $item) }}')" class="px-3 py-1 text-xs font-bold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] rounded-lg border border-[#C8D8CF]">Edit</button>
                                    <form method="POST" action="{{ route('admin.settings.footer.guidance.destroy', $item) }}" class="inline-block" onsubmit="return confirm('Delete this Guidance item?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-red-800 bg-red-100 hover:bg-red-200 rounded-lg">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SECTION E: SOCIAL MEDIA CRUD -->
    <div x-show="activeTab === 'social'" x-cloak class="space-y-6">
        <div class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Social Media Handles</h3>
                    <p class="text-xs text-[#60736B]">Manage Facebook, Instagram, YouTube, WhatsApp, and social profile links.</p>
                </div>
                <button type="button" @click="socialAddOpen = true" class="px-4 py-2 text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-xs">
                    + Add Social Link
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Order</th>
                            <th class="pb-3 px-3">Platform</th>
                            <th class="pb-3 px-3">URL</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($socialLinks as $s)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3 px-3 font-mono font-bold text-[#0B3D2E]">#{{ $s->sort_order }}</td>
                                <td class="py-3 px-3 font-bold text-[#0B3D2E]">{{ $s->platform }}</td>
                                <td class="py-3 px-3 font-mono text-[11px] text-[#60736B]">{{ $s->url }}</td>
                                <td class="py-3 px-3"><span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $s->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">{{ $s->is_active ? 'Active' : 'Disabled' }}</span></td>
                                <td class="py-3 px-3 text-right space-x-2">
                                    <button type="button" @click="openSocialEdit({{ json_encode($s) }}, '{{ route('admin.settings.footer.social.update', $s) }}')" class="px-3 py-1 text-xs font-bold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] rounded-lg border border-[#C8D8CF]">Edit</button>
                                    <form method="POST" action="{{ route('admin.settings.footer.social.destroy', $s) }}" class="inline-block" onsubmit="return confirm('Delete this social link?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-red-800 bg-red-100 hover:bg-red-200 rounded-lg">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SECTION F: CONTACT DETAILS -->
    <div x-show="activeTab === 'contact'" x-cloak>
        <form method="POST" action="{{ route('admin.settings.footer.update-general') }}" class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs space-y-6">
            @csrf
            <!-- Preserve other settings -->
            <input type="hidden" name="footer_enabled" value="{{ $settings['footer_enabled'] }}">
            <input type="hidden" name="footer_logo_width" value="{{ $settings['footer_logo_width'] }}">
            <input type="hidden" name="footer_description" value="{{ $settings['footer_description'] }}">
            <input type="hidden" name="footer_col2_title" value="{{ $settings['footer_col2_title'] }}">
            <input type="hidden" name="footer_col3_title" value="{{ $settings['footer_col3_title'] }}">
            <input type="hidden" name="footer_col4_title" value="{{ $settings['footer_col4_title'] }}">
            <input type="hidden" name="footer_copyright_text" value="{{ $settings['footer_copyright_text'] }}">

            <div class="space-y-4">
                <h3 class="font-serif-luxury text-sm font-bold text-[#0B3D2E]">Consultation Office Contact Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Business / Brand Name</label>
                        <input type="text" name="footer_contact_brand" value="{{ $settings['footer_contact_brand'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Phone Number (Official)</label>
                        <input type="text" name="footer_contact_phone" value="{{ $settings['footer_contact_phone'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                        <span class="text-[10px] text-[#60736B]">Updated number: 8392059201</span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">WhatsApp Number</label>
                        <input type="text" name="footer_contact_whatsapp" value="{{ $settings['footer_contact_whatsapp'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Official Email Address</label>
                        <input type="email" name="footer_contact_email" value="{{ $settings['footer_contact_email'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Office / Chamber Address</label>
                        <input type="text" name="footer_contact_address" value="{{ $settings['footer_contact_address'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Website Domain Display</label>
                        <input type="text" name="footer_contact_website" value="{{ $settings['footer_contact_website'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Google Maps Address Link (Optional)</label>
                        <input type="text" name="footer_contact_map_url" value="{{ $settings['footer_contact_map_url'] }}" placeholder="https://maps.google.com/..." class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-[#C8D8CF]/40">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] shadow-md border border-[#C49A45]/40 transition-all">
                    Save Contact Details
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION G: COPYRIGHT -->
    <div x-show="activeTab === 'copyright'" x-cloak>
        <form method="POST" action="{{ route('admin.settings.footer.update-general') }}" class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs space-y-6">
            @csrf
            <!-- Preserve other settings -->
            <input type="hidden" name="footer_enabled" value="{{ $settings['footer_enabled'] }}">
            <input type="hidden" name="footer_logo_width" value="{{ $settings['footer_logo_width'] }}">
            <input type="hidden" name="footer_description" value="{{ $settings['footer_description'] }}">
            <input type="hidden" name="footer_col2_title" value="{{ $settings['footer_col2_title'] }}">
            <input type="hidden" name="footer_col3_title" value="{{ $settings['footer_col3_title'] }}">
            <input type="hidden" name="footer_col4_title" value="{{ $settings['footer_col4_title'] }}">
            <input type="hidden" name="footer_contact_brand" value="{{ $settings['footer_contact_brand'] }}">
            <input type="hidden" name="footer_contact_phone" value="{{ $settings['footer_contact_phone'] }}">
            <input type="hidden" name="footer_contact_whatsapp" value="{{ $settings['footer_contact_whatsapp'] }}">
            <input type="hidden" name="footer_contact_email" value="{{ $settings['footer_contact_email'] }}">
            <input type="hidden" name="footer_contact_address" value="{{ $settings['footer_contact_address'] }}">
            <input type="hidden" name="footer_contact_website" value="{{ $settings['footer_contact_website'] }}">
            <input type="hidden" name="footer_contact_map_url" value="{{ $settings['footer_contact_map_url'] }}">

            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-[#E8F1EC]/60 rounded-2xl border border-[#C8D8CF]">
                    <div>
                        <span class="block text-sm font-bold text-[#0B3D2E]">Enable Bottom Copyright Bar</span>
                        <span class="text-xs text-[#60736B]">Toggle bottom copyright line visibility.</span>
                    </div>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="hidden" name="footer_copyright_enabled" value="0">
                        <input type="checkbox" name="footer_copyright_enabled" value="1" {{ $settings['footer_copyright_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#C8D8CF]">
                        <span class="text-xs font-bold text-[#0B3D2E]">Copyright Enabled</span>
                    </label>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Copyright Text (Use {current_year} for dynamic year)</label>
                    <input type="text" name="footer_copyright_text" value="{{ $settings['footer_copyright_text'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                    <span class="text-[10px] text-[#60736B]">Example: © {current_year} Ganesha Astro Consultancy. All Rights Reserved.</span>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-[#C8D8CF]/40">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] shadow-md border border-[#C49A45]/40 transition-all">
                    Save Copyright Settings
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION H: LEGAL PAGES -->
    <div x-show="activeTab === 'legal'" x-cloak class="space-y-6">
        @foreach ($legalPages as $page)
            <div class="bg-[#FFFFFF] p-6 rounded-3xl border border-[#C8D8CF] shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-3">
                    <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">{{ $page->title }} (/{{ $page->slug }})</h3>
                    <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-full {{ $page->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                        {{ $page->status }}
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.settings.footer.legal.update', $page) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Page Title</label>
                            <input type="text" name="title" value="{{ $page->title }}" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Publication Status</label>
                            <select name="status" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                                <option value="published" {{ $page->status === 'published' ? 'selected' : '' }}>Published (Link Visible in Footer)</option>
                                <option value="draft" {{ $page->status === 'draft' ? 'selected' : '' }}>Draft / Disabled (Hidden from Footer)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">SEO Meta Title</label>
                            <input type="text" name="seo_title" value="{{ $page->seo_title }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Meta Description</label>
                            <input type="text" name="meta_description" value="{{ $page->meta_description }}" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Page Content (HTML supported)</label>
                        <textarea name="content" rows="6" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl font-mono">{{ $page->content }}</textarea>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl">
                            Update {{ $page->title }}
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>

    <!-- MODAL: ADD QUICK NAV -->
    <div x-show="navAddOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="navAddOpen = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">+ Add Quick Nav Link</h3>
            <form method="POST" action="{{ route('admin.settings.footer.nav.store') }}" class="space-y-3">
                @csrf
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Label *</label><input type="text" name="label" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E]">Link Type</label>
                        <select name="link_type" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                            <option value="internal">Internal Route</option>
                            <option value="custom">Custom URL Path</option>
                            <option value="external">External URL</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E]">Route Selection</label>
                        <select name="route_name" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                            @foreach ($availableRoutes as $rk => $rl)<option value="{{ $rk }}">{{ $rl }}</option>@endforeach
                        </select>
                    </div>
                </div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">URL (if custom/external)</label><input type="text" name="url" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="block text-xs font-bold text-[#0B3D2E]">Sort Order</label><input type="number" name="sort_order" value="1" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                    <div><label class="block text-xs font-bold text-[#0B3D2E]">Target</label><select name="target" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"><option value="_self">Same Tab</option><option value="_blank">New Tab</option></select></div>
                </div>
                <div class="flex items-center space-x-2"><input type="checkbox" name="is_active" value="1" checked id="fadd_act"><label for="fadd_act" class="text-xs font-bold text-[#0B3D2E]">Active</label></div>
                <div class="flex justify-end space-x-2 pt-2"><button type="button" @click="navAddOpen = false" class="px-3 py-1.5 text-xs">Cancel</button><button type="submit" class="px-4 py-1.5 text-xs font-bold text-white bg-[#0B3D2E] rounded-xl">Save Link</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT QUICK NAV -->
    <div x-show="navEditOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="navEditOpen = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Edit Quick Nav Link</h3>
            <form :action="navEdit.actionUrl" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Label *</label><input type="text" name="label" x-model="navEdit.label" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E]">Link Type</label>
                        <select name="link_type" x-model="navEdit.link_type" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                            <option value="internal">Internal Route</option>
                            <option value="custom">Custom URL Path</option>
                            <option value="external">External URL</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E]">Route Selection</label>
                        <select name="route_name" x-model="navEdit.route_name" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl">
                            @foreach ($availableRoutes as $rk => $rl)<option value="{{ $rk }}">{{ $rl }}</option>@endforeach
                        </select>
                    </div>
                </div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">URL</label><input type="text" name="url" x-model="navEdit.url" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="block text-xs font-bold text-[#0B3D2E]">Sort Order</label><input type="number" name="sort_order" x-model="navEdit.sort_order" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                    <div><label class="block text-xs font-bold text-[#0B3D2E]">Target</label><select name="target" x-model="navEdit.target" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"><option value="_self">Same Tab</option><option value="_blank">New Tab</option></select></div>
                </div>
                <div class="flex items-center space-x-2"><input type="checkbox" name="is_active" value="1" :checked="navEdit.is_active" id="fedit_act"><label for="fedit_act" class="text-xs font-bold text-[#0B3D2E]">Active</label></div>
                <div class="flex justify-end space-x-2 pt-2"><button type="button" @click="navEditOpen = false" class="px-3 py-1.5 text-xs">Cancel</button><button type="submit" class="px-4 py-1.5 text-xs font-bold text-white bg-[#0B3D2E] rounded-xl">Update Link</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL: ADD GUIDANCE -->
    <div x-show="guidanceAddOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="guidanceAddOpen = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">+ Add Guidance Link</h3>
            <form method="POST" action="{{ route('admin.settings.footer.guidance.store') }}" class="space-y-3">
                @csrf
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Label *</label><input type="text" name="label" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">URL / Path *</label><input type="text" name="url" required placeholder="/services/birth-chart" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <input type="hidden" name="link_type" value="custom">
                <input type="hidden" name="target" value="_self">
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Sort Order</label><input type="number" name="sort_order" value="1" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="flex items-center space-x-2"><input type="checkbox" name="is_active" value="1" checked id="gadd_act"><label for="gadd_act" class="text-xs font-bold text-[#0B3D2E]">Active</label></div>
                <div class="flex justify-end space-x-2 pt-2"><button type="button" @click="guidanceAddOpen = false" class="px-3 py-1.5 text-xs">Cancel</button><button type="submit" class="px-4 py-1.5 text-xs font-bold text-white bg-[#0B3D2E] rounded-xl">Save Guidance Item</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT GUIDANCE -->
    <div x-show="guidanceEditOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="guidanceEditOpen = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Edit Guidance Link</h3>
            <form :action="guidanceEdit.actionUrl" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Label *</label><input type="text" name="label" x-model="guidanceEdit.label" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">URL / Path *</label><input type="text" name="url" x-model="guidanceEdit.url" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <input type="hidden" name="link_type" value="custom">
                <input type="hidden" name="target" value="_self">
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Sort Order</label><input type="number" name="sort_order" x-model="guidanceEdit.sort_order" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="flex items-center space-x-2"><input type="checkbox" name="is_active" value="1" :checked="guidanceEdit.is_active" id="gedit_act"><label for="gedit_act" class="text-xs font-bold text-[#0B3D2E]">Active</label></div>
                <div class="flex justify-end space-x-2 pt-2"><button type="button" @click="guidanceEditOpen = false" class="px-3 py-1.5 text-xs">Cancel</button><button type="submit" class="px-4 py-1.5 text-xs font-bold text-white bg-[#0B3D2E] rounded-xl">Update Guidance Item</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL: ADD SOCIAL LINK -->
    <div x-show="socialAddOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="socialAddOpen = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">+ Add Social Media Link</h3>
            <form method="POST" action="{{ route('admin.settings.footer.social.store') }}" class="space-y-3">
                @csrf
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Platform Name *</label><input type="text" name="platform" required placeholder="Facebook, Instagram, YouTube, WhatsApp, LinkedIn" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Full URL *</label><input type="text" name="url" required placeholder="https://facebook.com/astrotamal or https://wa.me/918392059201" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Sort Order</label><input type="number" name="sort_order" value="1" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="flex items-center space-x-2"><input type="checkbox" name="is_active" value="1" checked id="sadd_act"><label for="sadd_act" class="text-xs font-bold text-[#0B3D2E]">Active</label></div>
                <div class="flex justify-end space-x-2 pt-2"><button type="button" @click="socialAddOpen = false" class="px-3 py-1.5 text-xs">Cancel</button><button type="submit" class="px-4 py-1.5 text-xs font-bold text-white bg-[#0B3D2E] rounded-xl">Save Social Link</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT SOCIAL LINK -->
    <div x-show="socialEditOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="socialEditOpen = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Edit Social Media Link</h3>
            <form :action="socialEdit.actionUrl" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Platform Name *</label><input type="text" name="platform" x-model="socialEdit.platform" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Full URL *</label><input type="text" name="url" x-model="socialEdit.url" required class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div><label class="block text-xs font-bold text-[#0B3D2E]">Sort Order</label><input type="number" name="sort_order" x-model="socialEdit.sort_order" class="w-full px-3 py-2 text-xs bg-white border border-[#C8D8CF] rounded-xl"></div>
                <div class="flex items-center space-x-2"><input type="checkbox" name="is_active" value="1" :checked="socialEdit.is_active" id="sedit_act"><label for="sedit_act" class="text-xs font-bold text-[#0B3D2E]">Active</label></div>
                <div class="flex justify-end space-x-2 pt-2"><button type="button" @click="socialEditOpen = false" class="px-3 py-1.5 text-xs">Cancel</button><button type="submit" class="px-4 py-1.5 text-xs font-bold text-white bg-[#0B3D2E] rounded-xl">Update Social Link</button></div>
            </form>
        </div>
    </div>

</div>
@endsection
