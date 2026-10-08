@extends('admin.layouts.app')

@section('title', 'Shop Page CMS Management')

@section('content')
<div class="max-w-6xl mx-auto space-y-6" x-data="{ 
    activeTab: 'hero',
    editingCategory: null,
    showAddModal: false,
    showEditModal: false,
    
    toggles: {
        shop_hero_visible: {{ \App\Models\SiteSetting::get('shop_hero_visible', '1') == '1' ? 'true' : 'false' }},
        shop_grid_visible: {{ \App\Models\SiteSetting::get('shop_grid_visible', '1') == '1' ? 'true' : 'false' }},
        shop_cta_visible: {{ \App\Models\SiteSetting::get('shop_cta_visible', '1') == '1' ? 'true' : 'false' }}
    },

    editCategory(cat) {
        this.editingCategory = cat;
        this.showEditModal = true;
    }
}">

    <!-- Top Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-[#C49A45] tracking-widest uppercase mb-1">
                <span>CMS Content Editor</span>
                <span>•</span>
                <span>Ganesha Astro Consultancy</span>
            </div>
            <h1 class="text-2xl font-bold font-serif-luxury text-[#0B3D2E]">Shop Page Management</h1>
            <p class="text-xs text-[#60736B] mt-1">Manage Shop Hero intro, product categories, recommendation CTA section, links, and ON/OFF visibility.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('shop') }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] border border-[#C49A45]/30 flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Live Shop Page
            </a>
        </div>
    </div>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-xl text-xs font-semibold shadow-xs flex items-center justify-between">
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-xl text-xs space-y-1">
            <div class="font-bold">Please correct the following errors:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tab Buttons -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-2 shadow-xs flex flex-wrap gap-2">
        <button type="button" @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'bg-[#0B3D2E] text-[#FFFFFF]' : 'text-[#17211D] hover:bg-[#F3F8F5]'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all">
            1. Shop Hero / Intro
        </button>
        <button type="button" @click="activeTab = 'categories'" :class="activeTab === 'categories' ? 'bg-[#0B3D2E] text-[#FFFFFF]' : 'text-[#17211D] hover:bg-[#F3F8F5]'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all">
            2. Product Category Grid ({{ count($categories) }})
        </button>
        <button type="button" @click="activeTab = 'cta'" :class="activeTab === 'cta' ? 'bg-[#0B3D2E] text-[#FFFFFF]' : 'text-[#17211D] hover:bg-[#F3F8F5]'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all">
            3. Recommendation CTA
        </button>
    </div>

    <!-- MAIN FORM FOR SETTINGS -->
    <form method="POST" action="{{ route('admin.shop.settings.update') }}" class="space-y-6">
        @csrf

        <!-- TAB 1: HERO / INTRO SETTINGS -->
        <div x-show="activeTab === 'hero'" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs">
            <div class="flex items-center justify-between border-b border-[#C8D8CF] pb-3">
                <h3 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">Shop Hero / Intro Section</h3>
                <label class="flex items-center space-x-2.5 cursor-pointer">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                    <input type="hidden" name="shop_hero_visible" value="0">
                    <input type="checkbox" name="shop_hero_visible" value="1" x-model="toggles.shop_hero_visible" class="accent-[#0B3D2E] w-4 h-4 rounded">
                </label>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Shop Eyebrow</label>
                    <input type="text" name="shop_hero_eyebrow" value="{{ old('shop_hero_eyebrow', \App\Models\SiteSetting::get('shop_hero_eyebrow', '🛍 SHOP')) }}" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Shop Main Heading (Bengali / English)</label>
                    <input type="text" name="shop_hero_title" value="{{ old('shop_hero_title', \App\Models\SiteSetting::get('shop_hero_title', 'SHOP')) }}" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs sm:text-base font-bold text-[#0B3D2E]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Shop Description</label>
                    <textarea name="shop_hero_description" rows="3" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">{{ old('shop_hero_description', \App\Models\SiteSetting::get('shop_hero_description', 'Products are being added. For any product enquiry please call or WhatsApp us.')) }}</textarea>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] rounded-full text-xs font-bold uppercase tracking-widest transition-all shadow-md">
                    Save Hero Settings
                </button>
            </div>
        </div>

        <!-- TAB 2: PRODUCT CATEGORIES LIST -->
        <div x-show="activeTab === 'categories'" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-[#C8D8CF] pb-3 gap-3">
                <div>
                    <h3 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">Product Categories Management</h3>
                    <p class="text-xs text-[#60736B]">Add, edit, reorder or toggle active status of shop category cards.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Grid Visibility</span>
                        <input type="hidden" name="shop_grid_visible" value="0">
                        <input type="checkbox" name="shop_grid_visible" value="1" x-model="toggles.shop_grid_visible" class="accent-[#0B3D2E] w-4 h-4 rounded">
                    </label>
                    <button type="button" @click="showAddModal = true" class="px-4 py-2 bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] text-xs font-bold rounded-xl shadow-xs">
                        + Add Category
                    </button>
                </div>
            </div>

            @if($categories->isEmpty())
                <div class="py-8 text-center text-xs text-[#60736B]">No categories added yet.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                                <th class="pb-3 px-3">Icon</th>
                                <th class="pb-3 px-3">Category Name</th>
                                <th class="pb-3 px-3">Description</th>
                                <th class="pb-3 px-3">URL / Link</th>
                                <th class="pb-3 px-3">Order</th>
                                <th class="pb-3 px-3">Status</th>
                                <th class="pb-3 px-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                            @foreach($categories as $cat)
                                <tr class="hover:bg-[#F3F8F5] transition-colors">
                                    <td class="py-3.5 px-3 text-lg">
                                        {{ $cat->icon ?: '📦' }}
                                    </td>
                                    <td class="py-3.5 px-3">
                                        <div class="font-bold text-[#0B3D2E]">{{ $cat->name }}</div>
                                        <div class="text-[10px] text-[#60736B]">{{ $cat->slug }}</div>
                                    </td>
                                    <td class="py-3.5 px-3 text-xs text-[#60736B] max-w-xs truncate">
                                        {{ $cat->description ?: '—' }}
                                    </td>
                                    <td class="py-3.5 px-3 text-xs font-mono text-[#C49A45]">
                                        {{ $cat->url ?: '—' }}
                                    </td>
                                    <td class="py-3.5 px-3 font-bold">
                                        {{ $cat->sort_order }}
                                    </td>
                                    <td class="py-3.5 px-3">
                                        @if($cat->is_active)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Active</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-600">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-3 text-right space-x-2">
                                        <button type="button" @click="editCategory({{ json_encode($cat) }})" class="px-2.5 py-1 text-xs font-bold text-[#0B3D2E] bg-[#C49A45]/20 rounded-lg hover:bg-[#C49A45]/40">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.shop.categories.destroy', $cat) }}" class="inline-block" onsubmit="return confirm('Delete category {{ $cat->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 text-xs font-bold text-rose-800 bg-rose-100 rounded-lg hover:bg-rose-200">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="pt-2 border-t border-[#C8D8CF]">
                <button type="submit" class="px-6 py-3 bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] rounded-full text-xs font-bold uppercase tracking-widest transition-all shadow-md">
                    Save Grid Visibility Settings
                </button>
            </div>
        </div>

        <!-- TAB 3: RECOMMENDATION CTA SETTINGS -->
        <div x-show="activeTab === 'cta'" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs">
            <div class="flex items-center justify-between border-b border-[#C8D8CF] pb-3">
                <h3 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">Personalized Recommendation CTA (Below Grid)</h3>
                <label class="flex items-center space-x-2.5 cursor-pointer">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">CTA Visibility</span>
                    <input type="hidden" name="shop_cta_visible" value="0">
                    <input type="checkbox" name="shop_cta_visible" value="1" x-model="toggles.shop_cta_visible" class="accent-[#0B3D2E] w-4 h-4 rounded">
                </label>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">CTA Pill Eyebrow</label>
                    <input type="text" name="shop_cta_eyebrow" value="{{ old('shop_cta_eyebrow', \App\Models\SiteSetting::get('shop_cta_eyebrow', 'PERSONALIZED RECOMMENDATION')) }}" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">CTA Heading Title</label>
                    <input type="text" name="shop_cta_title" value="{{ old('shop_cta_title', \App\Models\SiteSetting::get('shop_cta_title', 'Need Guidance on Gemstones or Remedies?')) }}" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs sm:text-base font-bold text-[#0B3D2E]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">CTA Description Paragraph</label>
                    <textarea name="shop_cta_description" rows="3" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">{{ old('shop_cta_description', \App\Models\SiteSetting::get('shop_cta_description', 'Gemstones and Yantras work best when prescribed strictly according to your horoscope\'s planetary periods (Dasha) and planetary strength.')) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">CTA Button Text Label</label>
                        <input type="text" name="shop_cta_button_text" value="{{ old('shop_cta_button_text', \App\Models\SiteSetting::get('shop_cta_button_text', 'BOOK HOROSCOPE ANALYSIS')) }}" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs font-bold text-[#17211D]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">CTA Button Target URL</label>
                        <input type="text" name="shop_cta_button_url" value="{{ old('shop_cta_button_url', \App\Models\SiteSetting::get('shop_cta_button_url', '/book-consultation')) }}" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs font-mono text-[#17211D]">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] rounded-full text-xs font-bold uppercase tracking-widest transition-all shadow-md">
                    Save CTA Settings
                </button>
            </div>
        </div>
    </form>

    <!-- ADD CATEGORY MODAL -->
    <div x-show="showAddModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4">
        <div @click.away="showAddModal = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 max-w-lg w-full space-y-5 shadow-2xl">
            <div class="flex items-center justify-between border-b border-[#C8D8CF] pb-3">
                <h3 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">Add New Shop Category</h3>
                <button type="button" @click="showAddModal = false" class="text-gray-400 hover:text-gray-600 text-lg">✕</button>
            </div>

            <form method="POST" action="{{ route('admin.shop.categories.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Category Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Gemstone / Ratna" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Icon / Emoji</label>
                        <input type="text" name="icon" placeholder="e.g. 💎, 📿, 🐘" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="0" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Short Description</label>
                    <textarea name="description" rows="2" placeholder="e.g. Coming to the shop soon" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Category URL / Link</label>
                    <input type="text" name="url" placeholder="e.g. /contact or https://..." class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" value="1" checked class="accent-[#0B3D2E] w-4 h-4 rounded">
                    <label class="text-xs font-bold text-[#17211D]">Active (Visible in Category Grid)</label>
                </div>

                <div class="pt-3 flex justify-end space-x-3">
                    <button type="button" @click="showAddModal = false" class="px-4 py-2 text-xs font-bold text-[#60736B] bg-[#E8F1EC] rounded-xl">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-xs">Create Category</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT CATEGORY MODAL -->
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4">
        <div @click.away="showEditModal = false" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 max-w-lg w-full space-y-5 shadow-2xl">
            <div class="flex items-center justify-between border-b border-[#C8D8CF] pb-3">
                <h3 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">Edit Category: <span x-text="editingCategory?.name"></span></h3>
                <button type="button" @click="showEditModal = false" class="text-gray-400 hover:text-gray-600 text-lg">✕</button>
            </div>

            <form method="POST" :action="'/admin-tamal/shop/categories/' + (editingCategory?.id || '')" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Category Name *</label>
                    <input type="text" name="name" x-model="editingCategory.name" required class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Icon / Emoji</label>
                        <input type="text" name="icon" x-model="editingCategory.icon" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Sort Order</label>
                        <input type="number" name="sort_order" x-model="editingCategory.sort_order" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Short Description</label>
                    <textarea name="description" x-model="editingCategory.description" rows="2" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#17211D] mb-1">Category URL / Link</label>
                    <input type="text" name="url" x-model="editingCategory.url" placeholder="e.g. /contact or https://..." class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3.5 py-2.5 text-xs text-[#17211D]">
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" value="1" :checked="editingCategory?.is_active" class="accent-[#0B3D2E] w-4 h-4 rounded">
                    <label class="text-xs font-bold text-[#17211D]">Active (Visible in Category Grid)</label>
                </div>

                <div class="pt-3 flex justify-end space-x-3">
                    <button type="button" @click="showEditModal = false" class="px-4 py-2 text-xs font-bold text-[#60736B] bg-[#E8F1EC] rounded-xl">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-xs">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
