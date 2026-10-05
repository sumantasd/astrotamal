@extends('layouts.app')

@section('title', 'Contact & Appointments — Tamal Chakraborty')
@section('meta_description', 'Get in touch with AstroTamal for consultation enquiries, Vedic astrology questions, and appointment information in Kolkata, Bongaon, Ranaghat & More.')

@section('content')

<!-- 1. COMPACT CONTACT HERO (Warm Cream / Soft Beige Background) -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[360px] max-h-[440px]">
    <!-- Celestial Background Ornaments -->
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#C49A45]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#C49A45]">
            <a href="{{ route('home') }}" class="hover:text-[#541F1D] transition-colors">HOME</a>
            <span>/</span>
            <span class="text-[#29211F] font-semibold">CONTACT</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">GET IN TOUCH</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <!-- Main Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Let's Begin the Conversation
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-normal leading-relaxed">
            For consultation enquiries, questions or further information, get in touch with AstroTamal.
        </p>
    </div>
</section>

<!-- MAIN CONTACT CONTENT & FORM SECTION (Soft Beige #EDE3D4 Background) -->
<section class="bg-[#EDE3D4] text-[#29211F] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- 2. CONNECT WITH ASTROTAMAL HEADER -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">DIRECT CONNECT</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
                Connect With AstroTamal
            </h2>
            <p class="text-xs sm:text-sm text-[#81766D] font-normal leading-relaxed">
                For consultation enquiries and general information, you can reach us through the contact details below.
            </p>
            <div class="w-12 h-0.5 bg-[#C49A45] mx-auto mt-4"></div>
        </div>

        <!-- Success Flash Alert -->
        @if(session('success'))
            <div class="mb-10 p-5 bg-[#541F1D] border border-[#D8C6A8] text-[#F7F0E3] rounded-xl shadow-md flex items-start space-x-4">
                <svg class="w-6 h-6 text-[#C49A45] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h4 class="font-serif-luxury text-base font-semibold text-[#C49A45]">Message Received</h4>
                    <p class="text-xs text-[#F7F0E3] mt-1">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- 2-COLUMN LAYOUT -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">

            <!-- LEFT COLUMN: Contact Cards & Chamber Locations -->
            <div class="lg:col-span-5 space-y-8">
                
                <!-- Contact Information Cards -->
                <div class="space-y-4">
                    <!-- CARD 01: WEBSITE -->
                    <a href="https://astrotamal.com" target="_blank" rel="noopener noreferrer" class="group block bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-6 shadow-sm hover:border-[#C49A45] transition-all hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-lg bg-[#541F1D] text-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center flex-shrink-0 group-hover:bg-[#351211] transition-colors">
                                <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            </div>
                            <div>
                                <span class="block text-[11px] font-bold uppercase tracking-widest text-[#C49A45]">WEBSITE</span>
                                <span class="text-sm font-semibold text-[#29211F] group-hover:text-[#541F1D] transition-colors">astrotamal.com</span>
                            </div>
                        </div>
                    </a>

                    <!-- CARD 02: EMAIL -->
                    <a href="mailto:ganesha4astro@gmail.com" class="group block bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-6 shadow-sm hover:border-[#C49A45] transition-all hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-lg bg-[#541F1D] text-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center flex-shrink-0 group-hover:bg-[#351211] transition-colors">
                                <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="block text-[11px] font-bold uppercase tracking-widest text-[#C49A45]">EMAIL</span>
                                <span class="text-sm font-semibold text-[#29211F] group-hover:text-[#541F1D] transition-colors">ganesha4astro@gmail.com</span>
                            </div>
                        </div>
                    </a>

                    <!-- CARD 03: CONTACT -->
                    @php $contactPhoneSetting = \App\Models\SiteSetting::get('contact_phone', '8392059201'); @endphp
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactPhoneSetting) }}" class="group block bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-6 shadow-sm hover:border-[#C49A45] transition-all hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-lg bg-[#541F1D] text-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center flex-shrink-0 group-hover:bg-[#351211] transition-colors">
                                <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="block text-[11px] font-bold uppercase tracking-widest text-[#C49A45]">CONTACT</span>
                                <span class="text-sm font-semibold text-[#29211F] group-hover:text-[#541F1D] transition-colors">{{ $contactPhoneSetting }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- CHAMBER INFORMATION SECTION -->
                <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl p-7 text-[#29211F] relative overflow-hidden shadow-sm space-y-4">
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#C49A45]">CHAMBER LOCATIONS</span>
                    </div>

                    <h3 class="font-serif-luxury text-xl sm:text-2xl font-semibold text-[#29211F]">
                        Kolkata · Bongaon · Ranaghat & More
                    </h3>

                    <p class="text-xs text-[#81766D] font-normal leading-relaxed">
                        Consultation availability across selected chamber locations.
                    </p>

                    <div class="pt-3 border-t border-[#D8C6A8] flex items-center justify-between text-xs text-[#541F1D]">
                        <span class="font-medium text-[#81766D]">Chamber Address:</span>
                        <span class="font-semibold text-[#29211F]">Kolkata | Bongaon | Ranaghat & More</span>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: CONTACT FORM -->
            <div class="lg:col-span-7 bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-7 sm:p-10 shadow-sm space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#C49A45]">SEND A MESSAGE</span>
                    <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F] mt-1">
                        Send Us a Message
                    </h3>
                    <p class="text-xs sm:text-sm text-[#81766D] mt-1 font-normal">
                        Have a question or need more information? Send us a message and we will get back to you.
                    </p>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- FULL NAME -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">
                            FULL NAME <span class="text-[#C49A45]">*</span>
                        </label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Enter your full name" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                        @error('name')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- EMAIL ADDRESS & PHONE NUMBER -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">
                                EMAIL ADDRESS <span class="text-[#C49A45]">*</span>
                            </label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}" placeholder="name@example.com" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                            @error('email')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">
                                PHONE NUMBER
                            </label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g. 96476 80707" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                            @error('phone')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- SUBJECT -->
                    <div>
                        <label for="service_interest" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">
                            SUBJECT
                        </label>
                        <input type="text" id="service_interest" name="service_interest" value="{{ old('service_interest') }}" placeholder="Subject or topic of inquiry" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                        @error('service_interest')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- MESSAGE -->
                    <div>
                        <label for="message" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">
                            MESSAGE <span class="text-[#C49A45]">*</span>
                        </label>
                        <textarea id="message" name="message" rows="5" required placeholder="Write your message or question here..." class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all resize-y">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button type="submit" class="w-full py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] rounded-lg shadow hover:bg-[#351211] border border-[#D8C6A8] hover:border-[#C49A45] transition-all flex items-center justify-center space-x-2 group">
                        <span>SEND MESSAGE</span>
                        <span class="group-hover:translate-x-1 transition-transform text-[#C49A45]">→</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- PERSONAL CONSULTATION CTA SECTION -->
<section class="bg-[#FDFBF7] py-16 border-t border-[#D8C6A8]">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-5">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">PERSONAL CONSULTATION</span>
        <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
            Have Questions About Your Chart?
        </h2>
        <p class="text-xs sm:text-sm text-[#81766D] max-w-xl mx-auto font-normal leading-relaxed">
            Book a consultation to discuss your birth chart, planetary timing and important life questions.
        </p>
        <div class="pt-2">
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center justify-center space-x-2 px-8 py-4 bg-[#F7F0E3] text-[#541F1D] border border-[#D8C6A8] hover:border-[#C49A45] hover:bg-[#EDE3D4] font-bold text-xs uppercase tracking-widest rounded-lg transition-all shadow-sm">
                <span>BOOK A CONSULTATION</span>
                <span class="text-[#C49A45]">→</span>
            </a>
        </div>
    </div>
</section>

@endsection
