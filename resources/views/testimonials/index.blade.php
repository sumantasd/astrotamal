@extends('layouts.app')

@section('title', 'Client Testimonials — Tamal Chakraborty')

@section('content')

<!-- 1. COMPACT TESTIMONIALS HERO -->
<section class="bg-[#0B1018] text-white py-16 lg:py-20 relative overflow-hidden border-b border-[#B08A2E]/20 min-h-[380px] flex items-center">
    <!-- Subtle Celestial Orbital Constellation Background -->
    <div class="absolute inset-0 pointer-events-none opacity-15">
        <svg class="w-full h-full text-[#D4AF37]" viewBox="0 0 1200 450" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="600" cy="225" r="380" stroke="currentColor" stroke-width="0.75" stroke-dasharray="4 6"/>
            <circle cx="600" cy="225" r="280" stroke="currentColor" stroke-width="0.5"/>
            <circle cx="600" cy="225" r="180" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4"/>
            <path d="M 100,225 L 1100,225" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
            <path d="M 600,0 L 600,450" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
        </svg>
    </div>

    <!-- Soft Ambient Golden Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-[#B08A2E]/10 blur-3xl rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Hero Content -->
            <div class="lg:col-span-8 space-y-4">
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-xs font-semibold tracking-widest text-[#D4AF37] uppercase">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">HOME</a>
                    <span class="text-slate-500">/</span>
                    <span class="text-slate-300">TESTIMONIALS</span>
                </nav>

                <!-- Eyebrow -->
                <div class="inline-flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">
                        CLIENT EXPERIENCES
                    </span>
                </div>

                <!-- Heading -->
                <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold text-[#FDFBF7] leading-tight">
                    What People Say
                </h1>

                <!-- Supporting Text -->
                <p class="text-slate-300 text-sm sm:text-base max-w-2xl font-light leading-relaxed">
                    Read experiences shared by people who have explored their questions and life circumstances through an astrological consultation.
                </p>
            </div>

            <!-- Decorative Star Illustration (Desktop) -->
            <div class="hidden lg:col-span-4 lg:flex items-center justify-end">
                <div class="relative w-48 h-48 sm:w-56 sm:h-56 rounded-full border border-[#B08A2E]/30 p-3 flex items-center justify-center bg-[#070A10]/60 backdrop-blur-sm shadow-2xl">
                    <div class="w-full h-full rounded-full border border-dashed border-[#D4AF37]/40 flex items-center justify-center p-4">
                        <svg class="w-24 h-24 text-[#D4AF37] opacity-80 animate-spin-slow" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                            <circle cx="50" cy="50" r="45" stroke-width="1"/>
                            <path d="M50 15 L50 85 M15 50 L85 50 M25 25 L75 75 M25 75 L75 25" stroke-width="0.5"/>
                            <circle cx="50" cy="50" r="8" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. EDITORIAL INTRODUCTION -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-20 border-b border-[#17202D]/10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-4">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#B08A2E] block">
            CLIENT EXPERIENCES
        </span>
        
        <h2 class="font-serif-luxury text-2xl sm:text-4xl font-bold text-[#17202D]">
            Every Consultation Begins With a Question.
        </h2>

        <p class="text-sm sm:text-base text-[#596273] leading-relaxed font-normal max-w-3xl mx-auto">
            Explore reflections and experiences shared by people who have consulted AstroTamal.
        </p>

        <div class="pt-2 flex justify-center">
            <div class="w-16 h-0.5 bg-[#B08A2E]/50 rounded-full"></div>
        </div>
    </div>
</section>

<!-- 3. MAIN TESTIMONIAL SECTION -->
<section class="bg-[#FDFBF7] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- FEATURED TESTIMONIAL (If records exist) -->
        @if($testimonials->isNotEmpty())
            @php $featured = $testimonials->first(); @endphp
            <div class="bg-white border border-[#E7E1D7] rounded-2xl p-8 sm:p-12 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Left: Large Quotation Mark Icon Badge -->
                    <div class="lg:col-span-3 flex lg:justify-center">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-[#0B1018] border border-[#B08A2E]/40 flex items-center justify-center text-[#D4AF37] font-serif text-6xl shadow-xl">
                            “
                        </div>
                    </div>

                    <!-- Right: Large Quote Content -->
                    <div class="lg:col-span-9 space-y-4">
                        <!-- Rating Stars -->
                        <div class="flex items-center space-x-1 text-[#D4AF37]">
                            @for($i = 0; $i < ($featured->rating ?? 5); $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>

                        <!-- Featured Review Text -->
                        <p class="font-serif text-xl sm:text-2xl text-[#17202D] leading-relaxed italic font-normal">
                            "{{ $featured->review }}"
                        </p>

                        <!-- Client Author Info -->
                        <div class="pt-2 border-t border-[#E7E1D7] flex items-center justify-between">
                            <div>
                                <h4 class="font-serif-luxury font-bold text-[#17202D] text-lg">
                                    {{ $featured->client_name }}
                                </h4>
                                <span class="text-xs text-[#596273] font-medium">
                                    {{ $featured->city }} @if($featured->service_tag) • <span class="text-[#9A7422] font-semibold">{{ $featured->service_tag }}</span> @endif
                                </span>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-[#B08A2E] bg-[#B08A2E]/10 px-3 py-1 rounded-full">
                                FEATURED REVIEW
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- MAIN TESTIMONIAL GRID (3 Cols Desktop, 2 Cols Tablet, 1 Col Mobile) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" />
            @endforeach
        </div>

        <!-- SUBMIT REVIEW FORM -->
        <div class="max-w-2xl mx-auto bg-white border border-[#E7E1D7] rounded-2xl p-8 sm:p-10 shadow-sm space-y-6">
            <div class="border-b border-[#E7E1D7] pb-4">
                <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#B08A2E] block mb-1">YOUR REFLECTION</span>
                <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Share Your Experience</h3>
                <p class="text-xs text-[#596273] font-normal mt-1">Have you received a consultation from Tamal Sir? Leave your feedback below.</p>
            </div>

            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('testimonials.store') }}" method="POST" class="space-y-5 text-xs">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[#17202D] font-bold uppercase tracking-wider text-[11px] mb-1.5">Your Name *</label>
                        <input type="text" 
                               name="client_name" 
                               required 
                               placeholder="e.g. Meera Kapur" 
                               class="w-full bg-white border border-[#17202D]/20 rounded-lg px-4 py-3 text-sm text-[#17202D] focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E] transition-colors">
                    </div>
                    <div>
                        <label class="block text-[#17202D] font-bold uppercase tracking-wider text-[11px] mb-1.5">City / Country *</label>
                        <input type="text" 
                               name="city" 
                               required 
                               placeholder="e.g. New Delhi" 
                               class="w-full bg-white border border-[#17202D]/20 rounded-lg px-4 py-3 text-sm text-[#17202D] focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E] transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[#17202D] font-bold uppercase tracking-wider text-[11px] mb-1.5">Service Consulted</label>
                        <input type="text" 
                               name="service_tag" 
                               placeholder="e.g. Birth Chart Analysis" 
                               class="w-full bg-white border border-[#17202D]/20 rounded-lg px-4 py-3 text-sm text-[#17202D] focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E] transition-colors">
                    </div>
                    <div>
                        <label class="block text-[#17202D] font-bold uppercase tracking-wider text-[11px] mb-1.5">Rating *</label>
                        <select name="rating" 
                                required 
                                class="w-full bg-white border border-[#17202D]/20 rounded-lg px-4 py-3 text-sm text-[#17202D] focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E] transition-colors">
                            <option value="5">★★★★★ (5 / 5)</option>
                            <option value="4">★★★★☆ (4 / 5)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[#17202D] font-bold uppercase tracking-wider text-[11px] mb-1.5">Your Review / Experience *</label>
                    <textarea name="review" 
                              rows="4" 
                              required 
                              placeholder="Describe how the astrological guidance helped you..." 
                              class="w-full bg-white border border-[#17202D]/20 rounded-lg px-4 py-3 text-sm text-[#17202D] focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E] transition-colors"></textarea>
                </div>

                <button type="submit" 
                        class="w-full py-4 text-xs font-bold uppercase tracking-widest text-slate-950 bg-gradient-to-r from-[#D4AF37] to-[#B08A2E] rounded-lg shadow-lg hover:brightness-110 transition-all">
                    SUBMIT REVIEW →
                </button>
            </form>
        </div>

    </div>
</section>

<!-- 5. PERSONAL CONSULTATION CTA (LIGHT IVORY #FDFBF7) -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 lg:py-20 border-t border-[#17202D]/10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-5">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#B08A2E] block">
            A PERSONAL CONVERSATION
        </span>

        <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">
            Have Questions of Your Own?
        </h2>

        <p class="text-[#596273] text-sm sm:text-base font-normal max-w-xl mx-auto leading-relaxed">
            Explore your birth chart, timing and important life questions through a personalised astrological consultation.
        </p>

        <div class="pt-4 flex justify-center">
            <a href="{{ route('consultation.book') }}" 
               class="inline-flex items-center px-8 py-3.5 rounded-lg text-xs font-bold uppercase tracking-widest text-slate-950 bg-gradient-to-r from-[#D4AF37] to-[#B08A2E] hover:brightness-110 shadow-xl transition-all">
                <span>BOOK A CONSULTATION</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@endsection
