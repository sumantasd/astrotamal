@extends('admin.layouts.app')

@section('title', $service->exists ? 'Edit ' . $service->title : 'Create Service')

@section('content')
<div class="max-w-6xl mx-auto space-y-6" x-data="{ 
    activeTab: 'basic',
    coversItems: {{ json_encode(old('covers_items', $service->covers_items ?: [])) }},
    benefitsItems: {{ json_encode(old('benefits_items', $service->benefits_items ?: [])) }},
    processItems: {{ json_encode(old('process_items', $service->process_items ?: [])) }},
    dimensionsItems: {{ json_encode(old('dimensions_items', $service->dimensions_items ?: [])) }},
    whoForItems: {{ json_encode(old('who_for_items', $service->who_for_items ?: [])) }},
    questionsItems: {{ json_encode(old('questions_items', $service->questions_items ?: [])) }},
    expectationsItems: {{ json_encode(old('expectations_items', $service->expectations_items ?: [])) }},
    faqsItems: {{ json_encode(old('faqs_items', $service->faqs_items ?: [])) }},
    
    addCover() { this.coversItems.push({ number: sprintf('%02d', this.coversItems.length + 1), title: '', description: '' }); },
    removeCover(index) { this.coversItems.splice(index, 1); },
    
    addBenefit() { this.benefitsItems.push({ title: '', description: '' }); },
    removeBenefit(index) { this.benefitsItems.splice(index, 1); },

    addProcess() { this.processItems.push({ step: (this.processItems.length + 1).toString(), title: '', description: '' }); },
    removeProcess(index) { this.processItems.splice(index, 1); },

    addDimension() { this.dimensionsItems.push({ title: '', description: '' }); },
    removeDimension(index) { this.dimensionsItems.splice(index, 1); },

    addWhoFor() { this.whoForItems.push(''); },
    removeWhoFor(index) { this.whoForItems.splice(index, 1); },

    addQuestion() { this.questionsItems.push(''); },
    removeQuestion(index) { this.questionsItems.splice(index, 1); },

    addExpectation() { this.expectationsItems.push({ title: '', description: '' }); },
    removeExpectation(index) { this.expectationsItems.splice(index, 1); },

    addFaq() { this.faqsItems.push({ question: '', answer: '' }); },
    removeFaq(index) { this.faqsItems.splice(index, 1); }
}">

    <!-- Top Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-[#C49A45] tracking-widest uppercase mb-1">
                <a href="{{ route('admin.services.index') }}" class="hover:underline">Service Management</a>
                <span>•</span>
                <span>{{ $service->exists ? 'Full Service Editor' : 'New Service' }}</span>
            </div>
            <h1 class="text-2xl font-bold font-serif-luxury text-[#541F1D]">
                {{ $service->exists ? 'Edit: ' . $service->title : 'Add New Service' }}
            </h1>
            <p class="text-xs text-[#81766D] mt-1">Configure complete inner page content, repeatable cards, section order & visibility, and SEO settings.</p>
        </div>
        <div class="flex items-center space-x-3">
            @if($service->exists)
            <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#C49A45]/30 flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Live Page
            </a>
            @endif
            <a href="{{ route('admin.services.index') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#29211F] bg-[#F7F0E3] hover:bg-[#EDE3D4] border border-[#D8C6A8]">
                Cancel
            </a>
        </div>
    </div>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-xl text-xs font-semibold flex items-center justify-between shadow-xs">
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-xl text-xs space-y-1">
            <div class="font-bold">Please correct the validation errors below:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Form -->
    <form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" class="space-y-6">
        @csrf
        @if($service->exists)
            @method('PUT')
        @endif

        <!-- Tab Navigation Bar -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-2 shadow-xs flex flex-wrap gap-1">
            <button type="button" @click="activeTab = 'basic'" :class="activeTab === 'basic' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">Basic Info</button>
            <button type="button" @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">Hero Section</button>
            <button type="button" @click="activeTab = 'main'" :class="activeTab === 'main' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">Main Intro</button>
            <button type="button" @click="activeTab = 'covers'" :class="activeTab === 'covers' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">Scope / Covers</button>
            <button type="button" @click="activeTab = 'benefits'" :class="activeTab === 'benefits' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">Benefits & Process</button>
            <button type="button" @click="activeTab = 'dimensions'" :class="activeTab === 'dimensions' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">Dimensions & Who For</button>
            <button type="button" @click="activeTab = 'faqs'" :class="activeTab === 'faqs' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">FAQs & Methodology</button>
            <button type="button" @click="activeTab = 'cta'" :class="activeTab === 'cta' ? 'bg-[#541F1D] text-[#F7F0E3]' : 'text-[#29211F] hover:bg-[#F7F0E3]'" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all">CTA & SEO</button>
        </div>

        <!-- 1. TAB: BASIC INFO -->
        <div x-show="activeTab === 'basic'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs">
            <h3 class="text-base font-bold font-serif-luxury text-[#541F1D] border-b border-[#D8C6A8] pb-3">Basic Information & Listing Settings</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Service Title *</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">URL Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" required class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Badge / Short Category Title</label>
                    <input type="text" name="badge" value="{{ old('badge', $service->badge) }}" placeholder="e.g. Birth Chart, Transit & Timing" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Display Price Label</label>
                    <input type="text" name="price" value="{{ old('price', $service->price) }}" placeholder="e.g. Consultation, ₹2,500" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $service->duration ?: '45 Mins') }}" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?: 0) }}" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Short Listing Description</label>
                <textarea name="short_description" rows="2" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">{{ old('short_description', $service->short_description) }}</textarea>
            </div>

            <div class="flex flex-wrap gap-6 pt-2 border-t border-[#D8C6A8]/60">
                <label class="flex items-center space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    <span class="text-xs font-bold text-[#29211F]">Active (Visible in Public Services Listing)</span>
                </label>

                <label class="flex items-center space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    <span class="text-xs font-bold text-[#29211F]">Highlight as Featured Service</span>
                </label>
            </div>
        </div>

        <!-- 2. TAB: HERO SECTION -->
        <div x-show="activeTab === 'hero'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs">
            <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Service Inner Page Hero Section</h3>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                    <input type="checkbox" name="hero_visible" value="1" {{ old('hero_visible', $service->hero_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                </label>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Hero Eyebrow</label>
                    <input type="text" name="hero_eyebrow" value="{{ old('hero_eyebrow', $service->hero_eyebrow) }}" placeholder="e.g. JANMA KUNDLI READING" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Hero Heading Title</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $service->hero_title) }}" placeholder="e.g. Vedic Birth Chart Analysis" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Hero Subtitle / Description</label>
                    <textarea name="hero_description" rows="3" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">{{ old('hero_description', $service->hero_description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- 3. TAB: MAIN INTRO -->
        <div x-show="activeTab === 'main'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs">
            <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Main Introduction & Detailed Description</h3>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                    <input type="checkbox" name="main_content_visible" value="1" {{ old('main_content_visible', $service->main_content_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                </label>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Intro Eyebrow</label>
                    <input type="text" name="intro_eyebrow" value="{{ old('intro_eyebrow', $service->intro_eyebrow) }}" placeholder="e.g. DEEP ASTROLOGICAL EXAMINATION" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Intro Main Heading</label>
                    <input type="text" name="intro_heading" value="{{ old('intro_heading', $service->intro_heading) }}" placeholder="e.g. Beyond Generic Horoscope Readings: The Power of a Personalized Janma Kundli" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Full Detailed Description (HTML Formatted)</label>
                    <textarea name="full_description" rows="8" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F] font-mono">{{ old('full_description', $service->full_description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- 4. TAB: COVERS / SCOPE -->
        <div x-show="activeTab === 'covers'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs">
            <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">What This Service Covers (Repeatable Cards)</h3>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                    <input type="checkbox" name="covers_visible" value="1" {{ old('covers_visible', $service->covers_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                </label>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Eyebrow</label>
                    <input type="text" name="covers_eyebrow" value="{{ old('covers_eyebrow', $service->covers_eyebrow) }}" placeholder="e.g. ANALYTICAL SCOPE" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Title</label>
                    <input type="text" name="covers_title" value="{{ old('covers_title', $service->covers_title) }}" placeholder="e.g. What This Consultation Covers" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>
            </div>

            <div class="space-y-4 pt-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#541F1D]">Cover Cards List</span>
                    <button type="button" @click="addCover()" class="px-3 py-1.5 bg-[#541F1D] text-[#F7F0E3] rounded-lg text-xs font-bold hover:bg-[#351211]">+ Add Card</button>
                </div>

                <template x-for="(item, index) in coversItems" :key="index">
                    <div class="p-4 bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl space-y-3 relative">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[#541F1D]" x-text="'Card #' + (index + 1)"></span>
                            <button type="button" @click="removeCover(index)" class="text-rose-600 text-xs font-bold hover:underline">Delete Card</button>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-[#81766D]">Number Tag</label>
                                <input type="text" :name="'covers_items[' + index + '][number]'" x-model="item.number" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs">
                            </div>
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold uppercase text-[#81766D]">Card Title</label>
                                <input type="text" :name="'covers_items[' + index + '][title]'" x-model="item.title" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs font-bold">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-[#81766D]">Card Description</label>
                            <textarea :name="'covers_items[' + index + '][description]'" x-model="item.description" rows="2" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs"></textarea>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- 5. TAB: BENEFITS & PROCESS -->
        <div x-show="activeTab === 'benefits'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-8 shadow-xs">
            <!-- Benefits Sub-section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Why This Analysis Matters (Benefits)</h3>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                        <input type="checkbox" name="benefits_visible" value="1" {{ old('benefits_visible', $service->benefits_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Eyebrow</label>
                        <input type="text" name="benefits_eyebrow" value="{{ old('benefits_eyebrow', $service->benefits_eyebrow) }}" placeholder="e.g. PRACTICAL VALUE" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Title</label>
                        <input type="text" name="benefits_title" value="{{ old('benefits_title', $service->benefits_title) }}" placeholder="e.g. Why a Birth Chart Analysis Matters" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#541F1D]">Benefit Cards</span>
                        <button type="button" @click="addBenefit()" class="px-3 py-1 bg-[#541F1D] text-[#F7F0E3] rounded-lg text-xs font-bold hover:bg-[#351211]">+ Add Benefit</button>
                    </div>

                    <template x-for="(item, index) in benefitsItems" :key="index">
                        <div class="p-4 bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[#541F1D]" x-text="'Benefit #' + (index + 1)"></span>
                                <button type="button" @click="removeBenefit(index)" class="text-rose-600 text-xs font-bold hover:underline">Delete</button>
                            </div>
                            <input type="text" :name="'benefits_items[' + index + '][title]'" x-model="item.title" placeholder="Title" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs font-bold">
                            <textarea :name="'benefits_items[' + index + '][description]'" x-model="item.description" rows="2" placeholder="Description" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs"></textarea>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Process Sub-section -->
            <div class="space-y-4 pt-6 border-t border-[#D8C6A8]">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Consultation Process (How It Works)</h3>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                        <input type="checkbox" name="process_visible" value="1" {{ old('process_visible', $service->process_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Process Eyebrow</label>
                        <input type="text" name="process_eyebrow" value="{{ old('process_eyebrow', $service->process_eyebrow) }}" placeholder="e.g. CONSULTATION PROCESS" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Process Title</label>
                        <input type="text" name="process_title" value="{{ old('process_title', $service->process_title) }}" placeholder="e.g. How the Janma Kundli Session Works" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#541F1D]">Process Steps</span>
                        <button type="button" @click="addProcess()" class="px-3 py-1 bg-[#541F1D] text-[#F7F0E3] rounded-lg text-xs font-bold hover:bg-[#351211]">+ Add Step</button>
                    </div>

                    <template x-for="(item, index) in processItems" :key="index">
                        <div class="p-4 bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[#541F1D]" x-text="'Step #' + (index + 1)"></span>
                                <button type="button" @click="removeProcess(index)" class="text-rose-600 text-xs font-bold hover:underline">Delete</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
                                <input type="text" :name="'process_items[' + index + '][step]'" x-model="item.step" placeholder="Step #" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs">
                                <input type="text" :name="'process_items[' + index + '][title]'" x-model="item.title" placeholder="Step Title" class="sm:col-span-3 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs font-bold">
                            </div>
                            <input type="text" :name="'process_items[' + index + '][description]'" x-model="item.description" placeholder="Description" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- 6. TAB: DIMENSIONS & WHO FOR -->
        <div x-show="activeTab === 'dimensions'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-8 shadow-xs">
            <!-- Dimensions Sub-section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Key Life Dimensions / What You Get</h3>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                        <input type="checkbox" name="dimensions_visible" value="1" {{ old('dimensions_visible', $service->dimensions_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Eyebrow</label>
                        <input type="text" name="dimensions_eyebrow" value="{{ old('dimensions_eyebrow', $service->dimensions_eyebrow) }}" placeholder="e.g. LIFE DIMENSIONS" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Title</label>
                        <input type="text" name="dimensions_title" value="{{ old('dimensions_title', $service->dimensions_title) }}" placeholder="e.g. Key Life Dimensions Analyzed" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#541F1D]">Dimension Cards</span>
                        <button type="button" @click="addDimension()" class="px-3 py-1 bg-[#541F1D] text-[#F7F0E3] rounded-lg text-xs font-bold hover:bg-[#351211]">+ Add Dimension</button>
                    </div>

                    <template x-for="(item, index) in dimensionsItems" :key="index">
                        <div class="p-4 bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[#541F1D]" x-text="'Dimension #' + (index + 1)"></span>
                                <button type="button" @click="removeDimension(index)" class="text-rose-600 text-xs font-bold hover:underline">Delete</button>
                            </div>
                            <input type="text" :name="'dimensions_items[' + index + '][title]'" x-model="item.title" placeholder="Dimension Title (e.g. 1. Career & Profession)" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs font-bold">
                            <textarea :name="'dimensions_items[' + index + '][description]'" x-model="item.description" rows="2" placeholder="Description" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs"></textarea>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Who For Sub-section -->
            <div class="space-y-4 pt-6 border-t border-[#D8C6A8]">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Who This Consultation Is For</h3>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                        <input type="checkbox" name="who_for_visible" value="1" {{ old('who_for_visible', $service->who_for_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    </label>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Title</label>
                    <input type="text" name="who_for_title" value="{{ old('who_for_title', $service->who_for_title) }}" placeholder="e.g. Who This Consultation Is For" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#541F1D]">Bullet Points</span>
                        <button type="button" @click="addWhoFor()" class="px-3 py-1 bg-[#541F1D] text-[#F7F0E3] rounded-lg text-xs font-bold hover:bg-[#351211]">+ Add Bullet Point</button>
                    </div>

                    <template x-for="(item, index) in whoForItems" :key="index">
                        <div class="flex items-center space-x-2">
                            <input type="text" :name="'who_for_items[' + index + ']'" x-model="whoForItems[index]" placeholder="e.g. Individuals seeking a comprehensive understanding of their chart" class="w-full bg-[#F7F0E3] border border-[#D8C6A8] rounded-lg p-2.5 text-xs text-[#29211F]">
                            <button type="button" @click="removeWhoFor(index)" class="text-rose-600 text-xs font-bold px-2 py-1 hover:underline shrink-0">Delete</button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- 7. TAB: FAQS & METHODOLOGY -->
        <div x-show="activeTab === 'faqs'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-8 shadow-xs">
            <!-- FAQs Sub-section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Frequently Asked Questions (FAQs)</h3>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                        <input type="checkbox" name="faqs_visible" value="1" {{ old('faqs_visible', $service->faqs_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">FAQ Eyebrow</label>
                        <input type="text" name="faqs_eyebrow" value="{{ old('faqs_eyebrow', $service->faqs_eyebrow) }}" placeholder="e.g. FREQUENTLY ASKED QUESTIONS" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">FAQ Section Title</label>
                        <input type="text" name="faqs_title" value="{{ old('faqs_title', $service->faqs_title) }}" placeholder="e.g. Birth Chart FAQ" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#541F1D]">FAQ Accordion Items</span>
                        <button type="button" @click="addFaq()" class="px-3 py-1 bg-[#541F1D] text-[#F7F0E3] rounded-lg text-xs font-bold hover:bg-[#351211]">+ Add FAQ</button>
                    </div>

                    <template x-for="(item, index) in faqsItems" :key="index">
                        <div class="p-4 bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[#541F1D]" x-text="'FAQ #' + (index + 1)"></span>
                                <button type="button" @click="removeFaq(index)" class="text-rose-600 text-xs font-bold hover:underline">Delete</button>
                            </div>
                            <input type="text" :name="'faqs_items[' + index + '][question]'" x-model="item.question" placeholder="Question" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs font-bold">
                            <textarea :name="'faqs_items[' + index + '][answer]'" x-model="item.answer" rows="2" placeholder="Answer" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg p-2 text-xs"></textarea>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Methodology Sub-section -->
            <div class="space-y-4 pt-6 border-t border-[#D8C6A8]">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Astrological Approach & Methodology</h3>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                        <input type="checkbox" name="methodology_visible" value="1" {{ old('methodology_visible', $service->methodology_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    </label>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Section Title</label>
                    <input type="text" name="methodology_title" value="{{ old('methodology_title', $service->methodology_title) }}" placeholder="e.g. Astrological Approach & Methodology" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Methodology Text Content</label>
                    <textarea name="methodology_content" rows="4" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">{{ old('methodology_content', $service->methodology_content) }}</textarea>
                </div>
            </div>
        </div>

        <!-- 8. TAB: CTA & SEO -->
        <div x-show="activeTab === 'cta'" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 space-y-8 shadow-xs">
            <!-- Consultation CTA -->
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]">Bottom Consultation Call to Action (CTA)</h3>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Section Visibility</span>
                        <input type="checkbox" name="cta_visible" value="1" {{ old('cta_visible', $service->cta_visible ?? true) ? 'checked' : '' }} class="accent-[#541F1D] w-4 h-4 rounded">
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">CTA Eyebrow</label>
                        <input type="text" name="cta_eyebrow" value="{{ old('cta_eyebrow', $service->cta_eyebrow) }}" placeholder="e.g. • SCHEDULE YOUR SESSION •" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">CTA Heading Title</label>
                        <input type="text" name="cta_title" value="{{ old('cta_title', $service->cta_title) }}" placeholder="e.g. Ready to Explore Your Janma Kundli?" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">CTA Description</label>
                    <textarea name="cta_description" rows="2" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">{{ old('cta_description', $service->cta_description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">CTA Button Label</label>
                        <input type="text" name="cta_button_text" value="{{ old('cta_button_text', $service->cta_button_text) }}" placeholder="e.g. BOOK CONSULTATION" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">CTA Button Target URL</label>
                        <input type="text" name="cta_url" value="{{ old('cta_url', $service->cta_url) }}" placeholder="e.g. /book-consultation" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                    </div>
                </div>
            </div>

            <!-- SEO Settings Sub-section -->
            <div class="space-y-4 pt-6 border-t border-[#D8C6A8]">
                <h3 class="text-base font-bold font-serif-luxury text-[#541F1D] border-b border-[#D8C6A8] pb-3">Search Engine Optimization (SEO)</h3>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">SEO Title Tag</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $service->seo_title) }}" placeholder="e.g. Vedic Birth Chart Analysis & Janma Kundli Reading — Tamal Chakraborty" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Meta Description</label>
                    <textarea name="seo_meta_description" rows="3" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">{{ old('seo_meta_description', $service->seo_meta_description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-4 flex items-center justify-between shadow-xs">
            <span class="text-xs text-[#81766D] font-medium">Click Save Changes to immediately reflect your edits on the public Service page.</span>
            <button type="submit" class="px-8 py-3.5 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-full shadow-md transition-all">
                Save Service Changes
            </button>
        </div>
    </form>

</div>
@endsection
