@extends('layouts.app')

@section('title', 'Book a Consultation | Astrologer Tamal Chakraborty')
@section('meta_description', 'Book a personalized 1-on-1 Vedic Astrology consultation with Tamal Chakraborty. Select your service, date & time slot, and enter birth details.')

@section('content')

<!-- Header Banner -->
<section class="bg-navy-950 text-white py-16 lg:py-20 border-b border-gold-500/20 relative overflow-hidden">
    <!-- Starfield & Glow Background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gold-500/10 via-navy-900 to-navy-950 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
        <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-gold-400 uppercase">
            <span class="w-2 h-2 rounded-full bg-gold-500"></span>
            <span>PERSONALIZED VEDIC GUIDANCE</span>
        </div>
        <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white">
            Book Your Private Consultation
        </h1>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto font-light leading-relaxed">
            Select your consultation type, choose your preferred date & time, and provide your birth details for accurate Vedic horoscope evaluation.
        </p>
    </div>
</section>

<!-- Main Booking Section -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 lg:py-24 relative" style="background-color: #FDFBF7 !important; color: #17202D !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left Info Sidebar (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Trust Card -->
                <div class="bg-[#FAF8F5] border border-[#17202D]/15 p-6 sm:p-7 rounded-2xl space-y-6 shadow-sm">
                    <h3 class="font-serif-luxury text-xl font-bold text-[#17202D] border-b border-[#17202D]/10 pb-3">
                        Why Consult Tamal Chakraborty?
                    </h3>

                    <ul class="space-y-4 text-xs sm:text-sm text-[#4B5563]">
                        <li class="flex items-start space-x-3">
                            <span class="w-5 h-5 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#17202D] block font-semibold">15+ Years Experience</strong>
                                Deep mastery in Parashara & Jaimini classical Vedic astrology.
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="w-5 h-5 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#17202D] block font-semibold">100% Confidentiality</strong>
                                Your birth details, personal concerns, and remedies remain strictly private.
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="w-5 h-5 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#17202D] block font-semibold">Practical Remedies</strong>
                                Non-superstitious remedies focused on lifestyle, mantras, and certified gemstones.
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="w-5 h-5 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#17202D] block font-semibold">Global Video/Audio Call</strong>
                                Consult comfortably from anywhere worldwide via Google Meet / WhatsApp / Phone.
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Support Contact Card -->
                <div class="bg-[#FAF8F5] border border-[#17202D]/15 p-6 rounded-2xl space-y-4 shadow-sm text-xs">
                    <h4 class="font-serif-luxury text-base font-bold text-[#17202D]">Need Help with Booking?</h4>
                    <p class="text-[#566171]">Get in touch with AstroTamal for scheduling assistance.</p>
                    <div class="pt-2 space-y-2 text-[#17202D] font-medium">
                        <p class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#B08A2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <a href="tel:+919647680707" class="hover:text-[#9A7422] transition-colors">96476 80707</a>
                        </p>
                        <p class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#B08A2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:support@astrotamal.com" class="hover:text-[#9A7422] transition-colors">support@astrotamal.com</a>
                        </p>
                        <p class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#B08A2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            <a href="https://astrotamal.com" target="_blank" rel="noopener noreferrer" class="hover:text-[#9A7422] transition-colors">astrotamal.com</a>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Right Booking Form (8 cols) -->
            <div class="lg:col-span-8">
                <div class="bg-white border border-[#17202D]/15 p-6 sm:p-10 rounded-2xl shadow-md space-y-8">
                    
                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs sm:text-sm font-medium flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <strong class="block font-bold text-emerald-950">Booking Request Received!</strong>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('consultation.submit') }}" method="POST" class="space-y-8 text-xs sm:text-sm">
                        @csrf

                        <!-- Step 1: Select Service -->
                        <div class="space-y-4">
                            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D] flex items-center space-x-2 border-b border-[#17202D]/10 pb-3">
                                <span class="w-6 h-6 rounded-full bg-[#17202D] text-white flex items-center justify-center text-xs font-sans">1</span>
                                <span>Select Consultation Service</span>
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                @foreach($services as $index => $srv)
                                    <label class="relative flex items-start p-4 rounded-xl border border-[#17202D]/15 bg-[#FAF8F5] cursor-pointer hover:border-[#9A7422] transition-all has-[:checked]:border-[#9A7422] has-[:checked]:bg-gold-500/10">
                                        <input type="radio" name="service_id" value="{{ $srv->id }}" {{ $loop->first ? 'checked' : '' }} class="mt-1 accent-[#9A7422] mr-3">
                                        <div>
                                            <span class="block font-serif-luxury text-base font-bold text-[#17202D]">{{ $srv->title }}</span>
                                            <span class="block text-[11px] text-[#566171] mt-0.5 leading-snug">{{ $srv->short_description }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Step 2: Preferred Date & Time -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D] flex items-center space-x-2 border-b border-[#17202D]/10 pb-3">
                                <span class="w-6 h-6 rounded-full bg-[#17202D] text-white flex items-center justify-center text-xs font-sans">2</span>
                                <span>Preferred Date & Time Slot</span>
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">Select Preferred Date *</label>
                                    <input type="date" name="preferred_date" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                </div>

                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">Select Time Slot *</label>
                                    <select name="preferred_time" required class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                        <option value="Morning (10:00 AM - 01:00 PM IST)">Morning (10:00 AM – 01:00 PM IST)</option>
                                        <option value="Afternoon (02:00 PM - 05:00 PM IST)">Afternoon (02:00 PM – 05:00 PM IST)</option>
                                        <option value="Evening (06:00 PM - 09:00 PM IST)">Evening (06:00 PM – 09:00 PM IST)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Personal Information -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D] flex items-center space-x-2 border-b border-[#17202D]/10 pb-3">
                                <span class="w-6 h-6 rounded-full bg-[#17202D] text-white flex items-center justify-center text-xs font-sans">3</span>
                                <span>Personal Information</span>
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">Full Name *</label>
                                    <input type="text" name="name" required placeholder="e.g. Rahul Sharma" class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                </div>

                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">Email Address *</label>
                                    <input type="email" name="email" required placeholder="e.g. rahul@example.com" class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                </div>

                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">Phone / WhatsApp *</label>
                                    <input type="tel" name="phone" required placeholder="e.g. 96476 80707" class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Birth Details -->
                        <div class="space-y-4 pt-2">
                            <div class="border-b border-[#17202D]/10 pb-3 flex flex-col sm:flex-row sm:items-baseline justify-between">
                                <h3 class="font-serif-luxury text-xl font-bold text-[#17202D] flex items-center space-x-2">
                                    <span class="w-6 h-6 rounded-full bg-[#17202D] text-white flex items-center justify-center text-xs font-sans">4</span>
                                    <span>Birth Details (For Accurate Janam Kundli)</span>
                                </h3>
                                <span class="text-[11px] text-[#80601B] font-serif-luxury italic mt-1 sm:mt-0">* Essential for Vedic calculations</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">Date of Birth</label>
                                    <input type="date" name="birth_date" class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                </div>

                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">Exact Time of Birth (with AM/PM)</label>
                                    <input type="text" name="birth_time" placeholder="e.g. 08:45 AM" class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                </div>

                                <div>
                                    <label class="block font-bold text-[#17202D] mb-1.5">City / Place of Birth</label>
                                    <input type="text" name="birth_place" placeholder="e.g. Kolkata, West Bengal" class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]">
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Specific Notes -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D] flex items-center space-x-2 border-b border-[#17202D]/10 pb-3">
                                <span class="w-6 h-6 rounded-full bg-[#17202D] text-white flex items-center justify-center text-xs font-sans">5</span>
                                <span>Specific Questions or Concerns (Optional)</span>
                            </h3>

                            <div>
                                <textarea name="notes" rows="3" placeholder="Mention any specific areas (career change, business launch date, marriage timing, or personal challenges) you wish to focus on..." class="w-full bg-[#FAF8F5] border border-[#17202D]/20 rounded-lg px-4 py-3 text-[#17202D] focus:outline-none focus:border-[#9A7422]"></textarea>
                            </div>
                        </div>

                        <!-- Submit CTA -->
                        <div class="pt-4 border-t border-[#17202D]/10">
                            <button type="submit" class="w-full py-4 text-xs font-bold uppercase tracking-widest text-navy-950 bg-gold-gradient rounded-lg shadow-xl gold-glow hover:scale-[1.01] transition-transform border border-gold-300">
                                Confirm & Book Consultation →
                            </button>
                            <p class="text-[11px] text-[#6B7280] text-center mt-3 font-normal">
                                Strict 100% privacy guaranteed. Our desk will contact you within 4 hours to confirm appointment slot.
                            </p>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
