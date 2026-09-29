@extends('layouts.app')

@section('title', $service->title . ' — Tamal Chakraborty')

@section('content')

<!-- Header Banner -->
<section class="bg-[#F7F0E3] text-[#29211F] py-16 lg:py-20 border-b border-[#D8C6A8] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3">
        <div class="flex items-center space-x-2 text-xs font-bold uppercase tracking-wider text-[#C49A45]">
            <a href="{{ route('services.index') }}" class="hover:underline text-[#C49A45]">Services</a>
            <span>/</span>
            <span class="text-[#29211F]">{{ $service->title }}</span>
        </div>
        <h1 class="font-serif-luxury text-4xl sm:text-5xl font-bold text-[#29211F]">{{ $service->title }}</h1>
        <p class="text-[#81766D] text-sm max-w-2xl font-normal">{{ $service->short_description }}</p>
    </div>
</section>

<!-- Detail Content -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Main Content -->
            <div class="lg:col-span-8 space-y-8">
                <div class="rounded-2xl overflow-hidden shadow-md border border-[#D8C6A8] h-72 sm:h-96">
                    <img src="{{ asset($service->image) }}" 
                         alt="{{ $service->title }}" 
                         class="w-full h-full object-cover"
                         onerror="this.src='https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=800&auto=format&fit=crop'">
                </div>

                <div class="prose prose-lg max-w-none text-[#81766D] leading-relaxed space-y-4">
                    <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F]">About This Consultation</h3>
                    <p class="text-[#81766D]">{{ $service->full_description }}</p>

                    <h4 class="font-serif-luxury text-xl font-bold text-[#29211F] pt-4">What Will Be Covered:</h4>
                    <ul class="space-y-2 text-sm text-[#81766D]">
                        <li class="flex items-center space-x-2"><span class="text-[#541F1D] font-bold">✓</span><span>Detailed evaluation of primary planetary Dashas and transits.</span></li>
                        <li class="flex items-center space-x-2"><span class="text-[#541F1D] font-bold">✓</span><span>Identification of key planetary Yogas and Doshas in your horoscope.</span></li>
                        <li class="flex items-center space-x-2"><span class="text-[#541F1D] font-bold">✓</span><span>Specific timeline and windows of opportunity for key decisions.</span></li>
                        <li class="flex items-center space-x-2"><span class="text-[#541F1D] font-bold">✓</span><span>Customized, non-superstitious remedial measures and gemstone guidance.</span></li>
                        <li class="flex items-center space-x-2"><span class="text-[#541F1D] font-bold">✓</span><span>Direct Q&A session to answer your specific personal questions.</span></li>
                    </ul>
                </div>
            </div>

            <!-- Right Booking Sidebar Card -->
            <div class="lg:col-span-4">
                <div class="sticky top-28 bg-[#F7F0E3] text-[#29211F] rounded-2xl p-7 border border-[#D8C6A8] shadow-sm space-y-6">
                    <div class="border-b border-[#D8C6A8] pb-4">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#C49A45]">Consultation Fee</span>
                        <div class="font-serif-luxury text-3xl font-bold text-[#C49A45] mt-1">{{ $service->price ?? '₹2,500' }}</div>
                        <span class="text-xs text-[#81766D]">Duration: {{ $service->duration ?? '45 Mins' }}</span>
                    </div>

                    <div class="space-y-3 text-xs text-[#81766D]">
                        <div class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span class="text-[#29211F]">1-on-1 Video / Audio Call</span>
                        </div>
                        <div class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span class="text-[#29211F]">100% Confidential Session</span>
                        </div>
                    </div>

                    <a href="{{ route('consultation.book') }}" 
                       class="block text-center w-full py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow border border-[#D8C6A8] hover:border-[#C49A45] transition-all">
                        Book This Consultation →
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
