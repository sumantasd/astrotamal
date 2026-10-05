@extends('admin.layouts.app')

@section('title', 'Header & Navigation Management')
@section('header_title', 'Header & Navigation Management')
@section('header_subtitle', 'Configure public desktop & mobile header layout, logo, navigation menu tree, colors, and action buttons.')

@section('content')
<div x-data="{ 
    activeTab: 'general',
    addModalOpen: false,
    editModalOpen: false,
    editItem: {
        id: null,
        label: '',
        parent_id: '',
        link_type: 'internal',
        route_name: 'home',
        url: '',
        icon: '',
        target: '_self',
        sort_order: 0,
        is_active: true,
        actionUrl: ''
    },
    openEdit(item, updateUrl) {
        this.editItem = {
            id: item.id,
            label: item.label,
            parent_id: item.parent_id || '',
            link_type: item.link_type,
            route_name: item.route_name || 'home',
            url: item.url || '',
            icon: item.icon || '',
            target: item.target || '_self',
            sort_order: item.sort_order || 0,
            is_active: !!item.is_active,
            actionUrl: updateUrl
        };
        this.editModalOpen = true;
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

    <!-- Top Action Bar & Tabs -->
    <div class="bg-[#FDFBF7] p-6 rounded-3xl border border-[#D8C6A8] shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Header & Navigation Management</h1>
            <p class="text-xs text-[#81766D] mt-1">Manage public navigation links, dropdown submenus, right-side CTA buttons, and header appearance.</p>
        </div>

        <div class="flex items-center space-x-3 w-full md:w-auto justify-end">
            <form method="POST" action="{{ route('admin.settings.header.reset') }}" onsubmit="return confirm('Reset Header & Navigation settings to defaults? This will restore default menu items and brand colors.')">
                @csrf
                <button type="submit" class="px-4 py-2 text-xs font-bold text-amber-900 bg-amber-100 hover:bg-amber-200 border border-amber-300 rounded-xl transition-all">
                    ↺ Reset Header to Default
                </button>
            </form>

            <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#D8C6A8] transition-all">
                ← Back to Settings
            </a>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex border-b border-[#D8C6A8] space-x-2 overflow-x-auto pb-1">
        <button @click="activeTab = 'general'" 
                :class="activeTab === 'general' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border-[#C49A45]' : 'bg-[#FDFBF7] text-[#541F1D] border-transparent hover:bg-[#EDE3D4]'"
                class="px-5 py-2.5 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            ⚙️ Header General Settings
        </button>
        <button @click="activeTab = 'navigation'" 
                :class="activeTab === 'navigation' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border-[#C49A45]' : 'bg-[#FDFBF7] text-[#541F1D] border-transparent hover:bg-[#EDE3D4]'"
                class="px-5 py-2.5 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            📌 Navigation Menu Items (CRUD)
        </button>
        <button @click="activeTab = 'actions'" 
                :class="activeTab === 'actions' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border-[#C49A45]' : 'bg-[#FDFBF7] text-[#541F1D] border-transparent hover:bg-[#EDE3D4]'"
                class="px-5 py-2.5 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            🔘 Right Side Header Actions
        </button>
        <button @click="activeTab = 'mobile'" 
                :class="activeTab === 'mobile' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border-[#C49A45]' : 'bg-[#FDFBF7] text-[#541F1D] border-transparent hover:bg-[#EDE3D4]'"
                class="px-5 py-2.5 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            📱 Mobile Header Settings
        </button>
        <button @click="activeTab = 'preview'" 
                :class="activeTab === 'preview' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border-[#C49A45]' : 'bg-[#FDFBF7] text-[#541F1D] border-transparent hover:bg-[#EDE3D4]'"
                class="px-5 py-2.5 rounded-t-2xl border-t border-x text-xs transition-all whitespace-nowrap">
            👁️ Header Live Preview
        </button>
    </div>

    <!-- TAB 1: HEADER GENERAL SETTINGS -->
    <div x-show="activeTab === 'general'" x-cloak>
        <form method="POST" action="{{ route('admin.settings.header.update-general') }}" enctype="multipart/form-data" class="bg-[#FDFBF7] p-6 rounded-3xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Header Active Toggle -->
                <div class="col-span-1 md:col-span-2 flex items-center justify-between p-4 bg-[#EDE3D4]/40 rounded-2xl border border-[#D8C6A8]">
                    <div>
                        <span class="block text-sm font-bold text-[#541F1D]">Enable Public Header</span>
                        <span class="text-xs text-[#81766D]">Controls whether the main site navigation header bar displays on public pages.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="header_enabled" value="1" {{ $settings['header_enabled'] == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Brand Logo Settings -->
                <div class="space-y-4 p-4 bg-[#EDE3D4]/20 rounded-2xl border border-[#D8C6A8]">
                    <h3 class="font-serif-luxury text-sm font-bold text-[#541F1D]">Brand Logo Configuration</h3>

                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl flex items-center justify-center">
                            <img src="{{ asset($settings['header_logo']) }}" alt="Current Logo" class="h-10 w-auto object-contain">
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Upload New Logo (Image)</label>
                            <input type="file" name="logo_file" accept="image/*" class="w-full text-xs text-[#81766D] file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#EDE3D4] file:text-[#541F1D]">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Logo Width (px)</label>
                            <input type="text" name="header_logo_width" value="{{ $settings['header_logo_width'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Logo Height (px)</label>
                            <input type="text" name="header_logo_height" value="{{ $settings['header_logo_height'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Logo Link</label>
                            <input type="text" name="header_logo_link" value="{{ $settings['header_logo_link'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        </div>
                    </div>
                </div>

                <!-- Header Styling & Colors -->
                <div class="space-y-4 p-4 bg-[#EDE3D4]/20 rounded-2xl border border-[#D8C6A8]">
                    <h3 class="font-serif-luxury text-sm font-bold text-[#541F1D]">Color Palette & Layout</h3>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Background Color</label>
                            <div class="flex items-center space-x-2">
                                <input type="color" name="header_bg_color" value="{{ $settings['header_bg_color'] }}" class="w-8 h-8 rounded-lg cursor-pointer border-0">
                                <input type="text" name="header_bg_color" value="{{ $settings['header_bg_color'] }}" class="flex-1 px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Text Color</label>
                            <div class="flex items-center space-x-2">
                                <input type="color" name="header_text_color" value="{{ $settings['header_text_color'] }}" class="w-8 h-8 rounded-lg cursor-pointer border-0">
                                <input type="text" name="header_text_color" value="{{ $settings['header_text_color'] }}" class="flex-1 px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Active Menu Color</label>
                            <div class="flex items-center space-x-2">
                                <input type="color" name="header_active_color" value="{{ $settings['header_active_color'] }}" class="w-8 h-8 rounded-lg cursor-pointer border-0">
                                <input type="text" name="header_active_color" value="{{ $settings['header_active_color'] }}" class="flex-1 px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Border Color</label>
                            <div class="flex items-center space-x-2">
                                <input type="color" name="header_border_color" value="{{ $settings['header_border_color'] }}" class="w-8 h-8 rounded-lg cursor-pointer border-0">
                                <input type="text" name="header_border_color" value="{{ $settings['header_border_color'] }}" class="flex-1 px-3 py-1.5 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 pt-2">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Header Height</label>
                            <input type="text" name="header_height" value="{{ $settings['header_height'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        </div>
                        <div class="flex items-center pt-5 space-x-2">
                            <input type="checkbox" name="header_sticky" value="1" id="cb_sticky" {{ $settings['header_sticky'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                            <label for="cb_sticky" class="text-xs font-bold text-[#541F1D]">Sticky Header</label>
                        </div>
                        <div class="flex items-center pt-5 space-x-2">
                            <input type="checkbox" name="header_shadow" value="1" id="cb_shadow" {{ $settings['header_shadow'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                            <label for="cb_shadow" class="text-xs font-bold text-[#541F1D]">Header Shadow</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Hidden Mobile & Action Fields to Prevent Loss when submitting General -->
            <input type="hidden" name="header_action_account_enabled" value="{{ $settings['header_action_account_enabled'] }}">
            <input type="hidden" name="header_action_account_guest_label" value="{{ $settings['header_action_account_guest_label'] }}">
            <input type="hidden" name="header_action_account_auth_label" value="{{ $settings['header_action_account_auth_label'] }}">
            <input type="hidden" name="header_action_booking_enabled" value="{{ $settings['header_action_booking_enabled'] }}">
            <input type="hidden" name="header_action_booking_label" value="{{ $settings['header_action_booking_label'] }}">
            <input type="hidden" name="header_action_booking_url" value="{{ $settings['header_action_booking_url'] }}">

            <input type="hidden" name="mobile_header_enabled" value="{{ $settings['mobile_header_enabled'] }}">
            <input type="hidden" name="mobile_logo_width" value="{{ $settings['mobile_logo_width'] }}">
            <input type="hidden" name="mobile_logo_height" value="{{ $settings['mobile_logo_height'] }}">
            <input type="hidden" name="mobile_hamburger_enabled" value="{{ $settings['mobile_hamburger_enabled'] }}">
            <input type="hidden" name="mobile_menu_bg" value="{{ $settings['mobile_menu_bg'] }}">
            <input type="hidden" name="mobile_menu_text_color" value="{{ $settings['mobile_menu_text_color'] }}">
            <input type="hidden" name="mobile_menu_active_color" value="{{ $settings['mobile_menu_active_color'] }}">
            <input type="hidden" name="mobile_account_visible" value="{{ $settings['mobile_account_visible'] }}">
            <input type="hidden" name="mobile_booking_visible" value="{{ $settings['mobile_booking_visible'] }}">

            <div class="flex justify-end pt-4 border-t border-[#D8C6A8]/40">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] shadow-md border border-[#C49A45]/40 transition-all">
                    Save General Header Settings
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 2: NAVIGATION MENU MANAGEMENT (CRUD) -->
    <div x-show="activeTab === 'navigation'" x-cloak class="space-y-6">
        <div class="bg-[#FDFBF7] p-6 rounded-3xl border border-[#D8C6A8] shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-serif-luxury text-base font-bold text-[#541F1D]">Navigation Menu Tree</h3>
                    <p class="text-xs text-[#81766D]">Add, edit, reorder, or organize main menu links and dropdown submenus.</p>
                </div>
                <button type="button" @click="addModalOpen = true" class="px-4 py-2 text-xs font-bold text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-xl shadow-xs">
                    + Add Navigation Item
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 text-[11px] font-bold uppercase tracking-wider text-[#81766D]">
                            <th class="pb-3 px-3">Sort Order</th>
                            <th class="pb-3 px-3">Menu Label</th>
                            <th class="pb-3 px-3">Link Type</th>
                            <th class="pb-3 px-3">Destination URL / Route</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                        @foreach ($navItems->whereNull('parent_id') as $item)
                            <!-- Top Level Menu Item -->
                            <tr class="hover:bg-[#EDE3D4]/30 transition-colors font-medium">
                                <td class="py-3 px-3 font-mono font-bold text-[#541F1D]">
                                    #{{ $item->sort_order }}
                                </td>
                                <td class="py-3 px-3 font-bold text-[#541F1D] flex items-center space-x-2">
                                    <span>{{ $item->label }}</span>
                                    @if($item->children->count() > 0)
                                        <span class="px-1.5 py-0.5 text-[9px] bg-[#EDE3D4] text-[#541F1D] rounded font-mono">Dropdown ({{ $item->children->count() }})</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-[#EDE3D4] text-[#541F1D]">
                                        {{ $item->link_type }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 font-mono text-[11px] text-[#81766D]">
                                    {{ $item->link_type === 'internal' ? $item->route_name : ($item->url ?: '-') }}
                                </td>
                                <td class="py-3 px-3">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $item->is_active ? 'Active' : 'Disabled' }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-right space-x-2">
                                    <button type="button" 
                                            @click="openEdit({{ json_encode($item) }}, '{{ route('admin.settings.header.nav.update', $item) }}')" 
                                            class="px-3 py-1 text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] rounded-lg border border-[#D8C6A8]">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.settings.header.nav.destroy', $item) }}" class="inline-block" onsubmit="return confirm('Delete this menu item and all its submenus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-red-800 bg-red-100 hover:bg-red-200 rounded-lg">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Submenu Items (Indent) -->
                            @foreach ($item->children as $child)
                                <tr class="bg-[#EDE3D4]/20 hover:bg-[#EDE3D4]/40 transition-colors text-[11px]">
                                    <td class="py-2 px-3 pl-6 font-mono text-[#81766D]">
                                        └ #{{ $child->sort_order }}
                                    </td>
                                    <td class="py-2 px-3 pl-8 text-[#541F1D] font-semibold">
                                        ↳ {{ $child->label }}
                                    </td>
                                    <td class="py-2 px-3">
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase bg-[#D8C6A8]/50 text-[#541F1D]">
                                            {{ $child->link_type }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-3 font-mono text-[10px] text-[#81766D]">
                                        {{ $child->link_type === 'internal' ? $child->route_name : ($child->url ?: '-') }}
                                    </td>
                                    <td class="py-2 px-3">
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase {{ $child->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $child->is_active ? 'Active' : 'Disabled' }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-3 text-right space-x-1">
                                        <button type="button" 
                                                @click="openEdit({{ json_encode($child) }}, '{{ route('admin.settings.header.nav.update', $child) }}')" 
                                                class="px-2.5 py-0.5 text-[11px] font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] rounded border border-[#D8C6A8]">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.settings.header.nav.destroy', $child) }}" class="inline-block" onsubmit="return confirm('Delete this submenu item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-0.5 text-[11px] font-bold text-red-800 bg-red-100 hover:bg-red-200 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 3: RIGHT SIDE HEADER ACTIONS -->
    <div x-show="activeTab === 'actions'" x-cloak>
        <form method="POST" action="{{ route('admin.settings.header.update-general') }}" class="bg-[#FDFBF7] p-6 rounded-3xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf

            <!-- Preserve General & Mobile Settings -->
            <input type="hidden" name="header_enabled" value="{{ $settings['header_enabled'] }}">
            <input type="hidden" name="header_logo_width" value="{{ $settings['header_logo_width'] }}">
            <input type="hidden" name="header_logo_height" value="{{ $settings['header_logo_height'] }}">
            <input type="hidden" name="header_logo_link" value="{{ $settings['header_logo_link'] }}">
            <input type="hidden" name="header_bg_color" value="{{ $settings['header_bg_color'] }}">
            <input type="hidden" name="header_text_color" value="{{ $settings['header_text_color'] }}">
            <input type="hidden" name="header_active_color" value="{{ $settings['header_active_color'] }}">
            <input type="hidden" name="header_border_color" value="{{ $settings['header_border_color'] }}">
            <input type="hidden" name="header_height" value="{{ $settings['header_height'] }}">
            <input type="hidden" name="header_sticky" value="{{ $settings['header_sticky'] }}">
            <input type="hidden" name="header_shadow" value="{{ $settings['header_shadow'] }}">

            <input type="hidden" name="mobile_header_enabled" value="{{ $settings['mobile_header_enabled'] }}">
            <input type="hidden" name="mobile_logo_width" value="{{ $settings['mobile_logo_width'] }}">
            <input type="hidden" name="mobile_logo_height" value="{{ $settings['mobile_logo_height'] }}">
            <input type="hidden" name="mobile_hamburger_enabled" value="{{ $settings['mobile_hamburger_enabled'] }}">
            <input type="hidden" name="mobile_menu_bg" value="{{ $settings['mobile_menu_bg'] }}">
            <input type="hidden" name="mobile_menu_text_color" value="{{ $settings['mobile_menu_text_color'] }}">
            <input type="hidden" name="mobile_menu_active_color" value="{{ $settings['mobile_menu_active_color'] }}">
            <input type="hidden" name="mobile_account_visible" value="{{ $settings['mobile_account_visible'] }}">
            <input type="hidden" name="mobile_booking_visible" value="{{ $settings['mobile_booking_visible'] }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Action 1: Customer Account Button -->
                <div class="p-5 bg-[#EDE3D4]/30 rounded-2xl border border-[#D8C6A8] space-y-4">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                        <h3 class="font-serif-luxury text-sm font-bold text-[#541F1D]">1. Customer Account Action Button</h3>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="header_action_account_enabled" value="1" {{ $settings['header_action_account_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                            <span class="text-xs font-bold text-[#541F1D]">Enabled</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Logged Out Label</label>
                        <input type="text" name="header_action_account_guest_label" value="{{ $settings['header_action_account_guest_label'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        <span class="text-[10px] text-[#81766D]">Points to /account/login when guest</span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Logged In Label</label>
                        <input type="text" name="header_action_account_auth_label" value="{{ $settings['header_action_account_auth_label'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        <span class="text-[10px] text-[#81766D]">Points to /account when customer logged in</span>
                    </div>
                </div>

                <!-- Action 2: Quick Booking CTA Button -->
                <div class="p-5 bg-[#EDE3D4]/30 rounded-2xl border border-[#D8C6A8] space-y-4">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                        <h3 class="font-serif-luxury text-sm font-bold text-[#541F1D]">2. Quick Booking CTA Button</h3>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="header_action_booking_enabled" value="1" {{ $settings['header_action_booking_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                            <span class="text-xs font-bold text-[#541F1D]">Enabled</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Button Text Label</label>
                        <input type="text" name="header_action_booking_label" value="{{ $settings['header_action_booking_label'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Destination Route / URL</label>
                        <input type="text" name="header_action_booking_url" value="{{ $settings['header_action_booking_url'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        <span class="text-[10px] text-[#81766D]">Default route: consultation.book (/book-consultation)</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-[#D8C6A8]/40">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] shadow-md border border-[#C49A45]/40 transition-all">
                    Save Action Buttons Settings
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 4: MOBILE HEADER SETTINGS -->
    <div x-show="activeTab === 'mobile'" x-cloak>
        <form method="POST" action="{{ route('admin.settings.header.update-general') }}" class="bg-[#FDFBF7] p-6 rounded-3xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf

            <!-- Preserve General & Action Settings -->
            <input type="hidden" name="header_enabled" value="{{ $settings['header_enabled'] }}">
            <input type="hidden" name="header_logo_width" value="{{ $settings['header_logo_width'] }}">
            <input type="hidden" name="header_logo_height" value="{{ $settings['header_logo_height'] }}">
            <input type="hidden" name="header_logo_link" value="{{ $settings['header_logo_link'] }}">
            <input type="hidden" name="header_bg_color" value="{{ $settings['header_bg_color'] }}">
            <input type="hidden" name="header_text_color" value="{{ $settings['header_text_color'] }}">
            <input type="hidden" name="header_active_color" value="{{ $settings['header_active_color'] }}">
            <input type="hidden" name="header_border_color" value="{{ $settings['header_border_color'] }}">
            <input type="hidden" name="header_height" value="{{ $settings['header_height'] }}">
            <input type="hidden" name="header_sticky" value="{{ $settings['header_sticky'] }}">
            <input type="hidden" name="header_shadow" value="{{ $settings['header_shadow'] }}">

            <input type="hidden" name="header_action_account_enabled" value="{{ $settings['header_action_account_enabled'] }}">
            <input type="hidden" name="header_action_account_guest_label" value="{{ $settings['header_action_account_guest_label'] }}">
            <input type="hidden" name="header_action_account_auth_label" value="{{ $settings['header_action_account_auth_label'] }}">
            <input type="hidden" name="header_action_booking_enabled" value="{{ $settings['header_action_booking_enabled'] }}">
            <input type="hidden" name="header_action_booking_label" value="{{ $settings['header_action_booking_label'] }}">
            <input type="hidden" name="header_action_booking_url" value="{{ $settings['header_action_booking_url'] }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mobile Enable & Dimensions -->
                <div class="p-5 bg-[#EDE3D4]/30 rounded-2xl border border-[#D8C6A8] space-y-4">
                    <h3 class="font-serif-luxury text-sm font-bold text-[#541F1D]">Mobile Navigation Bar Configuration</h3>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="mobile_header_enabled" value="1" id="cb_mob_en" {{ $settings['mobile_header_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                        <label for="cb_mob_en" class="text-xs font-bold text-[#541F1D]">Enable Mobile Header Bar</label>
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="mobile_hamburger_enabled" value="1" id="cb_mob_ham" {{ $settings['mobile_hamburger_enabled'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                        <label for="cb_mob_ham" class="text-xs font-bold text-[#541F1D]">Enable Hamburger Menu Button</label>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Mobile Logo Width (px)</label>
                            <input type="text" name="mobile_logo_width" value="{{ $settings['mobile_logo_width'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Mobile Logo Height (px)</label>
                            <input type="text" name="mobile_logo_height" value="{{ $settings['mobile_logo_height'] }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        </div>
                    </div>
                </div>

                <!-- Mobile Drawer Styling & Actions Visibility -->
                <div class="p-5 bg-[#EDE3D4]/30 rounded-2xl border border-[#D8C6A8] space-y-4">
                    <h3 class="font-serif-luxury text-sm font-bold text-[#541F1D]">Mobile Drawer Colors & Buttons</h3>

                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="block text-[11px] font-bold text-[#541F1D] mb-1">Drawer BG</label>
                            <input type="color" name="mobile_menu_bg" value="{{ $settings['mobile_menu_bg'] }}" class="w-full h-8 rounded cursor-pointer border-0">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#541F1D] mb-1">Text Color</label>
                            <input type="color" name="mobile_menu_text_color" value="{{ $settings['mobile_menu_text_color'] }}" class="w-full h-8 rounded cursor-pointer border-0">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#541F1D] mb-1">Active Color</label>
                            <input type="color" name="mobile_menu_active_color" value="{{ $settings['mobile_menu_active_color'] }}" class="w-full h-8 rounded cursor-pointer border-0">
                        </div>
                    </div>

                    <div class="space-y-2 pt-2 border-t border-[#D8C6A8]/60">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" name="mobile_account_visible" value="1" id="cb_mob_acc" {{ $settings['mobile_account_visible'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                            <label for="cb_mob_acc" class="text-xs font-bold text-[#541F1D]">Show Account Icon/Button in Mobile Header Bar</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" name="mobile_booking_visible" value="1" id="cb_mob_book" {{ $settings['mobile_booking_visible'] == '1' ? 'checked' : '' }} class="rounded border-[#D8C6A8]">
                            <label for="cb_mob_book" class="text-xs font-bold text-[#541F1D]">Show Quick Booking Button in Mobile Drawer</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-[#D8C6A8]/40">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] shadow-md border border-[#C49A45]/40 transition-all">
                    Save Mobile Header Settings
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 5: HEADER LIVE PREVIEW -->
    <div x-show="activeTab === 'preview'" x-cloak class="space-y-6">
        <!-- Desktop Header Preview Card -->
        <div class="bg-[#FDFBF7] p-6 rounded-3xl border border-[#D8C6A8] shadow-xs space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#541F1D]">Desktop Header Live Visual Preview</h3>
            <p class="text-xs text-[#81766D]">Real-time visual simulation of saved desktop header bar appearance:</p>

            <div class="p-4 rounded-2xl border border-[#D8C6A8]" style="background-color: {{ $settings['header_bg_color'] }}; border-color: {{ $settings['header_border_color'] }};">
                <div class="flex items-center justify-between min-h-[60px] px-4">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <img src="{{ asset($settings['header_logo']) }}" alt="Preview Logo" style="max-width: {{ $settings['header_logo_width'] }}px; max-height: {{ $settings['header_logo_height'] }}px;" class="object-contain">
                    </div>

                    <!-- Navigation Tree -->
                    <nav class="flex items-center space-x-4 text-xs font-semibold">
                        @foreach ($navItems->whereNull('parent_id')->where('is_active', true) as $index => $item)
                            <span class="py-1 px-2 rounded hover:underline cursor-pointer" style="color: {{ $index === 0 ? $settings['header_active_color'] : $settings['header_text_color'] }}; font-weight: {{ $index === 0 ? 'bold' : 'normal' }};">
                                {{ $item->label }}
                                @if($item->children->count() > 0) ▾ @endif
                            </span>
                        @endforeach
                    </nav>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2">
                        @if($settings['header_action_account_enabled'] == '1')
                            <span class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-[#D8C6A8] bg-[#EDE3D4]/60 text-[#541F1D]">
                                👤 {{ $settings['header_action_account_guest_label'] }}
                            </span>
                        @endif

                        @if($settings['header_action_booking_enabled'] == '1')
                            <span class="px-4 py-2 text-xs font-bold uppercase rounded-lg bg-[#541F1D] text-[#F7F0E3] shadow-xs">
                                {{ $settings['header_action_booking_label'] }} →
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Header Preview Card -->
        <div class="bg-[#FDFBF7] p-6 rounded-3xl border border-[#D8C6A8] shadow-xs space-y-4">
            <h3 class="font-serif-luxury text-base font-bold text-[#541F1D]">Mobile Header Live Visual Preview</h3>
            
            <div class="max-w-sm mx-auto p-4 rounded-2xl border border-[#D8C6A8] space-y-3" style="background-color: {{ $settings['mobile_menu_bg'] }}; border-color: {{ $settings['header_border_color'] }};">
                <div class="flex items-center justify-between pb-2 border-b border-[#D8C6A8]">
                    <img src="{{ asset($settings['header_logo']) }}" alt="Mobile Logo Preview" style="max-width: {{ $settings['mobile_logo_width'] }}px; max-height: {{ $settings['mobile_logo_height'] }}px;" class="object-contain">

                    <div class="flex items-center space-x-2">
                        @if($settings['mobile_account_visible'] == '1')
                            <span class="px-2 py-1 text-[11px] font-bold bg-[#EDE3D4] text-[#541F1D] rounded">👤</span>
                        @endif
                        @if($settings['mobile_hamburger_enabled'] == '1')
                            <span class="px-2 py-1 text-xs font-bold bg-[#EDE3D4] text-[#541F1D] rounded">☰</span>
                        @endif
                    </div>
                </div>

                <div class="space-y-1.5 text-xs pt-1">
                    @foreach ($navItems->whereNull('parent_id')->where('is_active', true) as $index => $item)
                        <div class="py-1.5 px-3 rounded font-medium border-b border-[#D8C6A8]/30" style="color: {{ $index === 0 ? $settings['mobile_menu_active_color'] : $settings['mobile_menu_text_color'] }};">
                            {{ $item->label }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: ADD NAVIGATION MENU ITEM -->
    <div x-show="addModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="addModalOpen = false" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-5">
            <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                <h3 class="font-serif-luxury text-base font-bold text-[#541F1D]">+ Add Navigation Menu Item</h3>
                <button type="button" @click="addModalOpen = false" class="text-[#81766D] hover:text-[#541F1D] font-bold text-lg">✕</button>
            </div>

            <form method="POST" action="{{ route('admin.settings.header.nav.store') }}" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Menu Label *</label>
                    <input type="text" name="label" required placeholder="e.g. Services, Remedies, Contact" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Parent Menu Item</label>
                        <select name="parent_id" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            <option value="">None (Top Level Menu)</option>
                            @foreach ($parentCandidates as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Link Type *</label>
                        <select name="link_type" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            <option value="internal">Internal Route</option>
                            <option value="custom">Custom URL Path</option>
                            <option value="external">External URL</option>
                            <option value="none">No Link (Dropdown Parent)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Internal Route Selection</label>
                    <select name="route_name" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        @foreach ($availableRoutes as $rKey => $rLabel)
                            <option value="{{ $rKey }}">{{ $rLabel }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Custom / External URL</label>
                    <input type="text" name="url" placeholder="e.g. /numerology-calculator or https://example.com" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Target Window</label>
                        <select name="target" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            <option value="_self">Same Tab (_self)</option>
                            <option value="_blank">New Tab (_blank)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="1" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                    </div>

                    <div class="flex items-center pt-5 space-x-2">
                        <input type="checkbox" name="is_active" value="1" id="add_active" checked class="rounded border-[#D8C6A8]">
                        <label for="add_active" class="text-xs font-bold text-[#541F1D]">Is Active</label>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#D8C6A8]/60 flex justify-end space-x-3">
                    <button type="button" @click="addModalOpen = false" class="px-4 py-2 text-xs font-semibold text-[#81766D]">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-[#541F1D] hover:bg-[#351211] rounded-xl">
                        Save Navigation Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT NAVIGATION MENU ITEM -->
    <div x-show="editModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="editModalOpen = false" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-5">
            <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                <h3 class="font-serif-luxury text-base font-bold text-[#541F1D]">Edit Navigation Menu Item</h3>
                <button type="button" @click="editModalOpen = false" class="text-[#81766D] hover:text-[#541F1D] font-bold text-lg">✕</button>
            </div>

            <form :action="editItem.actionUrl" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Menu Label *</label>
                    <input type="text" name="label" x-model="editItem.label" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Parent Menu Item</label>
                        <select name="parent_id" x-model="editItem.parent_id" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            <option value="">None (Top Level Menu)</option>
                            @foreach ($parentCandidates as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Link Type *</label>
                        <select name="link_type" x-model="editItem.link_type" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            <option value="internal">Internal Route</option>
                            <option value="custom">Custom URL Path</option>
                            <option value="external">External URL</option>
                            <option value="none">No Link (Dropdown Parent)</option>
                        </select>
                    </div>
                </div>

                <div x-show="editItem.link_type === 'internal'">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Internal Route Selection</label>
                    <select name="route_name" x-model="editItem.route_name" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                        @foreach ($availableRoutes as $rKey => $rLabel)
                            <option value="{{ $rKey }}">{{ $rLabel }}</option>
                        @endforeach
                    </select>
                </div>

                <div x-show="editItem.link_type === 'custom' || editItem.link_type === 'external'">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Custom / External URL</label>
                    <input type="text" name="url" x-model="editItem.url" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Target Window</label>
                        <select name="target" x-model="editItem.target" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                            <option value="_self">Same Tab (_self)</option>
                            <option value="_blank">New Tab (_blank)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Sort Order</label>
                        <input type="number" name="sort_order" x-model="editItem.sort_order" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl">
                    </div>

                    <div class="flex items-center pt-5 space-x-2">
                        <input type="checkbox" name="is_active" value="1" id="edit_active" :checked="editItem.is_active" class="rounded border-[#D8C6A8]">
                        <label for="edit_active" class="text-xs font-bold text-[#541F1D]">Is Active</label>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#D8C6A8]/60 flex justify-end space-x-3">
                    <button type="button" @click="editModalOpen = false" class="px-4 py-2 text-xs font-semibold text-[#81766D]">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-[#541F1D] hover:bg-[#351211] rounded-xl">
                        Update Navigation Item
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
