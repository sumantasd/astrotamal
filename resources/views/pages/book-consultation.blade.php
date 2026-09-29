@extends('layouts.app')

@section('title', 'Book a Consultation | Astrologer Tamal Chakraborty')
@section('meta_description', 'Book a personalized 1-on-1 Vedic Astrology consultation with Tamal Chakraborty. Select your consultation type, date & time slot, and enter birth details.')

@section('content')

<!-- Header Banner -->
<section class="bg-[#F7F0E3] text-[#29211F] py-10 sm:py-12 lg:py-14 border-b border-[#D8C6A8] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-left space-y-2">
        <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-[#C49A45] uppercase">
            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
            <span>QUICK BOOKING</span>
        </div>
        <h1 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#541F1D]">
            Select consultation type
        </h1>
        <p class="text-[#81766D] text-xs sm:text-sm max-w-2xl font-normal leading-relaxed">
            Choose your preferred urgency, date, time slot, and enter your details to confirm your private Vedic consultation.
        </p>
    </div>
</section>

<!-- Main Booking Section -->
<section class="bg-[#F7F0E3] text-[#29211F] py-10 lg:py-16 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-8 p-5 rounded-2xl bg-[#541F1D] border border-[#D8C6A8] text-[#F7F0E3] text-xs sm:text-sm font-medium flex items-start space-x-3 shadow-md">
                <svg class="w-6 h-6 text-[#C49A45] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <strong class="block font-bold text-[#C49A45] text-base mb-1">Booking Request Submitted!</strong>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <form action="{{ route('consultation.submit') }}" method="POST" id="bookingForm" class="space-y-8">
            @csrf

            <!-- TOP 2-COLUMN SECTION (Left ~60%, Right ~40% on Desktop) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- LEFT COLUMN (~60% width - Step 1 & Step 2) -->
                <div class="lg:col-span-7 space-y-8">
                    
                    <!-- STEP 1: SELECT CONSULTATION TYPE -->
                    <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
                        <!-- Step Heading -->
                        <div class="flex items-center space-x-3 border-b border-[#D8C6A8] pb-4">
                            <span class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                            <h2 class="font-serif-luxury text-lg sm:text-xl font-bold uppercase tracking-wider text-[#541F1D]">
                                SELECT CONSULTATION TYPE
                            </h2>
                        </div>

                        <!-- 2 Side-by-Side Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <!-- Urgent Consultation Card -->
                            <label id="cardUrgent" class="relative block cursor-pointer rounded-2xl border-2 border-[#C49A45] bg-[#EDE3D4] p-5 transition-all shadow-sm">
                                <input type="radio" name="consultation_type" value="urgent" checked class="sr-only" onchange="updateConsultationType('urgent')">
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2 text-[#541F1D]">
                                            <span class="text-base">⚡</span>
                                            <span class="font-serif-luxury text-sm font-bold uppercase tracking-wider">URGENT</span>
                                        </div>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] rounded-full border border-[#D8C6A8]">
                                            WITHIN 24H
                                        </span>
                                    </div>
                                    <p class="text-xs text-[#81766D] font-normal leading-relaxed">
                                        Appointment should be within 24 hours
                                    </p>
                                    <div class="pt-2 border-t border-[#D8C6A8]/60 flex items-center justify-between">
                                        <span class="font-serif-luxury text-2xl font-bold text-[#541F1D]">₹5,000</span>
                                        <span id="checkUrgent" class="w-5 h-5 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold">✓</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Normal Consultation Card -->
                            <label id="cardNormal" class="relative block cursor-pointer rounded-2xl border border-[#D8C6A8] bg-[#F7F0E3] p-5 transition-all shadow-xs hover:border-[#C49A45]">
                                <input type="radio" name="consultation_type" value="normal" class="sr-only" onchange="updateConsultationType('normal')">
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2 text-[#541F1D]">
                                            <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            <span class="font-serif-luxury text-sm font-bold uppercase tracking-wider">NORMAL</span>
                                        </div>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] rounded-full border border-[#D8C6A8]">
                                            WITHIN A WEEK
                                        </span>
                                    </div>
                                    <p class="text-xs text-[#81766D] font-normal leading-relaxed">
                                        Appointment within one week
                                    </p>
                                    <div class="pt-2 border-t border-[#D8C6A8]/60 flex items-center justify-between">
                                        <span class="font-serif-luxury text-2xl font-bold text-[#541F1D]">₹3,000</span>
                                        <span id="checkNormal" class="w-5 h-5 rounded-full bg-transparent border border-[#D8C6A8] text-transparent flex items-center justify-center text-xs font-bold">✓</span>
                                    </div>
                                </div>
                            </label>

                        </div>
                    </div>

                    <!-- APPOINTMENT INFORMATION MESSAGE BANNER -->
                    <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl p-4 flex items-start space-x-3 text-xs text-[#541F1D]">
                        <svg class="w-5 h-5 text-[#C49A45] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="leading-relaxed font-medium">
                            Appointments are conducted via 1-on-1 Audio call. All birth details and personal discussions remain 100% strictly private & confidential.
                        </p>
                    </div>

                    <!-- STEP 2: CONSULTATION MODE -->
                    <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
                        <!-- Step Heading -->
                        <div class="flex items-center space-x-3 border-b border-[#D8C6A8] pb-4">
                            <span class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                            <h2 class="font-serif-luxury text-lg sm:text-xl font-bold uppercase tracking-wider text-[#541F1D]">
                                CONSULTATION MODE
                            </h2>
                        </div>

                        <!-- 2 Horizontal Selection Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <!-- Audio Consultation (Selectable) -->
                            <label class="relative flex items-center justify-between p-4 rounded-xl border-2 border-[#C49A45] bg-[#EDE3D4] cursor-pointer shadow-xs">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="mode" value="audio" checked class="accent-[#541F1D] w-4 h-4">
                                    <div class="w-8 h-8 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D]">
                                        <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <span class="font-serif-luxury text-sm font-bold text-[#29211F]">Audio Consultation</span>
                                </div>
                            </label>

                            <!-- Video Consultation (Locked & Disabled) -->
                            <div class="relative flex items-center justify-between p-4 rounded-xl border border-[#D8C6A8] bg-[#EDE3D4]/60 opacity-60 cursor-not-allowed select-none">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="mode" value="video" disabled class="accent-[#541F1D] w-4 h-4 cursor-not-allowed">
                                    <div class="w-8 h-8 rounded-full bg-[#EDE3D4] border border-[#D8C6A8] flex items-center justify-center text-[#81766D]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </div>
                                    <span class="font-serif-luxury text-sm font-bold text-[#81766D]">Video Consultation</span>
                                </div>
                                <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] rounded border border-[#D8C6A8]">
                                    LOCKED
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN (~40% width - Step 3: Select Date & Time) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
                        
                        <!-- Step Heading -->
                        <div class="flex items-center space-x-3 border-b border-[#D8C6A8] pb-4">
                            <span class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                            <h2 class="font-serif-luxury text-lg sm:text-xl font-bold uppercase tracking-wider text-[#541F1D]">
                                SELECT DATE & TIME
                            </h2>
                        </div>

                        <!-- Date Selection Buttons (Horizontal Pills) -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#541F1D]">Select Preferred Date</label>
                            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-thin">
                                @php
                                    $startDate = \Carbon\Carbon::now();
                                @endphp
                                @for($i = 0; $i < 5; $i++)
                                    @php
                                        $currDate = (clone $startDate)->addDays($i);
                                        $formattedVal = $currDate->format('Y-m-d');
                                        $dayName = $currDate->format('D');
                                        $dateNum = $currDate->format('d M');
                                    @endphp
                                    <button type="button" 
                                            onclick="selectDate('{{ $formattedVal }}', this)" 
                                            class="date-btn flex-1 min-w-[76px] py-2.5 px-3 rounded-xl border text-center transition-all text-xs font-medium {{ $i === 0 ? 'bg-[#EDE3D4] border-[#C49A45] text-[#541F1D] font-bold' : 'bg-[#FDFBF7] border-[#D8C6A8] text-[#29211F] hover:border-[#C49A45]' }}">
                                        <span class="block text-[10px] uppercase font-bold text-[#81766D]">{{ $dayName }}</span>
                                        <span class="block font-serif-luxury font-bold text-xs mt-0.5 text-[#541F1D]">{{ $dateNum }}</span>
                                    </button>
                                @endfor
                            </div>
                        </div>

                        <!-- Time Slot Selection Buttons (Vertical Arrangement) -->
                        <div class="space-y-2.5 pt-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#541F1D]">Available Time Slots</label>
                            
                            <!-- Slot 1 (Urgent Slot) -->
                            <button type="button" 
                                    id="slotMorning"
                                    onclick="selectTimeSlot('10:00 AM - 01:00 PM IST', this)" 
                                    class="slot-btn w-full p-3.5 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold bg-[#EDE3D4] border-[#C49A45] text-[#541F1D]">
                                <span>10:00 AM – 01:00 PM (Morning Urgent Slot)</span>
                                <span class="slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#541F1D] text-[#F7F0E3]">Selected</span>
                            </button>

                            <!-- Slot 2 (Normal Slot) -->
                            <button type="button" 
                                    id="slotAfternoon"
                                    onclick="selectTimeSlot('02:00 PM - 05:00 PM IST', this)" 
                                    class="slot-btn w-full p-3.5 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold bg-[#FDFBF7] border-[#D8C6A8] text-[#29211F] hover:border-[#C49A45]">
                                <span>02:00 PM – 05:00 PM (Afternoon)</span>
                                <span class="slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#EDE3D4] text-[#541F1D] border border-[#D8C6A8]">Available</span>
                            </button>

                            <!-- Slot 3 (Normal Slot) -->
                            <button type="button" 
                                    id="slotEvening"
                                    onclick="selectTimeSlot('06:00 PM - 09:00 PM IST', this)" 
                                    class="slot-btn w-full p-3.5 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold bg-[#FDFBF7] border-[#D8C6A8] text-[#29211F] hover:border-[#C49A45]">
                                <span>06:00 PM – 09:00 PM (Evening)</span>
                                <span class="slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#EDE3D4] text-[#541F1D] border border-[#D8C6A8]">Available</span>
                            </button>

                            <!-- Slot 4 (Unavailable - Struck through & Disabled) -->
                            <div class="w-full p-3.5 rounded-xl border border-[#D8C6A8] bg-[#EDE3D4]/70 opacity-60 flex items-center justify-between text-xs cursor-not-allowed select-none">
                                <span class="line-through text-[#81766D] font-medium">09:30 PM – 11:30 PM (Night)</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#81766D] text-[#F7F0E3]">Booked</span>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!-- FULL-WIDTH BOTTOM PANEL: STEP 4 CLIENT INFORMATION -->
            <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-10 space-y-8 shadow-sm">
                
                <!-- Step Heading -->
                <div class="flex items-center space-x-3 border-b border-[#D8C6A8] pb-4">
                    <span class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold flex-shrink-0">4</span>
                    <h2 class="font-serif-luxury text-xl font-bold uppercase tracking-wider text-[#541F1D]">
                        CLIENT INFORMATION
                    </h2>
                </div>

                <!-- 3-Column Responsive Grid on Desktop -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 text-xs">
                    
                    <!-- 1. Full Name -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">FULL NAME *</label>
                        <input type="text" 
                               name="name" 
                               id="inputName" 
                               required 
                               oninput="validateForm()"
                               placeholder="Enter your full name" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 2. Date of Birth -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">DATE OF BIRTH *</label>
                        <input type="date" 
                               name="birth_date" 
                               id="inputBirthDate" 
                               required 
                               onchange="validateForm()"
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 3. Time of Birth -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">TIME OF BIRTH</label>
                        <input type="text" 
                               name="birth_time" 
                               placeholder="e.g. 08:30 AM" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 4. Selected Date (Synced with Step 3) -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">SELECTED DATE *</label>
                        <input type="date" 
                               name="preferred_date" 
                               id="preferred_date" 
                               required 
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               class="w-full bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#541F1D] font-bold focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 5. Selected Time (Synced with Step 3) -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">SELECTED TIME *</label>
                        <input type="text" 
                               name="preferred_time" 
                               id="preferred_time" 
                               required 
                               value="10:00 AM - 01:00 PM IST" 
                               readonly
                               class="w-full bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#541F1D] font-bold focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 6. Mobile Number -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">MOBILE NUMBER *</label>
                        <input type="tel" 
                               name="phone" 
                               id="inputPhone" 
                               required 
                               oninput="validateForm()"
                               placeholder="e.g. 96476 80707" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 7. WhatsApp Number -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">WHATSAPP NUMBER</label>
                        <input type="tel" 
                               name="whatsapp" 
                               placeholder="e.g. 96476 80707" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 8. Email Address -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">EMAIL ADDRESS</label>
                        <input type="email" 
                               name="email" 
                               placeholder="e.g. support@astrotamal.com" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <!-- 9. Mention Your Queries (Full Width Area) -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#541F1D] mb-1.5">MENTION YOUR QUERIES (OPTIONAL)</label>
                        <textarea name="notes" 
                                  rows="3" 
                                  placeholder="Mention any specific concerns (career, marriage, business, health) for discussion during your consultation..." 
                                  class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 focus:outline-none focus:border-[#C49A45]"></textarea>
                    </div>

                </div>

                <!-- TERMS & CONDITIONS SECTION -->
                <div class="border-t border-[#D8C6A8] pt-6 space-y-4">
                    <div class="flex items-center space-x-2 text-sm font-bold text-[#541F1D]">
                        <span class="text-[#C49A45] text-base">★</span>
                        <span>Terms & Conditions</span>
                        <button type="button" 
                                onclick="openTermsModal()" 
                                class="text-xs text-[#541F1D] underline font-normal hover:text-[#351211] ml-2">
                            View Terms & Conditions
                        </button>
                    </div>

                    <label class="flex items-start space-x-3 cursor-pointer">
                        <input type="checkbox" 
                               id="termsConsent" 
                               name="terms_consent" 
                               required 
                               onchange="validateForm()" 
                               class="mt-1 accent-[#541F1D] w-4 h-4 rounded border-[#D8C6A8]">
                        <span class="text-xs text-[#81766D] leading-relaxed">
                            I have read and agree to the Terms & Conditions.
                        </span>
                    </label>
                </div>

                <!-- CONFIRM & PROCEED CTA BUTTON + SUPPORT FOOTER -->
                <div class="border-t border-[#D8C6A8] pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    
                    <p class="text-xs text-[#81766D] font-normal text-center sm:text-left">
                        If you have any difficulty with booking or your account, please call 
                        <a href="tel:8392059201" class="font-bold text-[#541F1D] underline hover:text-[#351211]">8392059201</a>.
                    </p>

                    <button type="submit" 
                            id="submitBtn" 
                            disabled 
                            class="w-full sm:w-auto px-8 py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-full shadow-md border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2">
                        <span id="submitBtnText">CONFIRM & PROCEED — ₹5,000</span>
                        <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>

                </div>

            </div>

        </form>

    </div>
</section>

<!-- TERMS & CONDITIONS MODAL -->
<div id="termsModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
    <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl max-w-xl w-full p-6 sm:p-8 space-y-5 shadow-2xl relative max-h-[85vh] overflow-y-auto">
        <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
            <h3 class="font-serif-luxury text-xl font-bold text-[#541F1D]">Terms & Conditions</h3>
            <button type="button" onclick="closeTermsModal()" class="text-[#81766D] hover:text-[#541F1D] font-bold text-lg">✕</button>
        </div>
        <div class="text-xs text-[#81766D] space-y-3 leading-relaxed">
            <p><strong>1. Privacy & Confidentiality:</strong> All birth details, horoscopes, and audio consultation recordings remain strictly confidential between Astrologer Tamal Chakraborty and the client.</p>
            <p><strong>2. Appointment Rescheduling:</strong> Appointment timing will be confirmed by desk within 4 hours. Requests to reschedule must be submitted at least 6 hours before slot time.</p>
            <p><strong>3. Non-Refundable Policy:</strong> Consultation fees are strictly non-refundable once booking request has been confirmed.</p>
            <p><strong>4. Vedic Remedies:</strong> Astrological remedies provided are Vedic and non-superstitious recommendations to assist personal life decisions.</p>
        </div>
        <div class="pt-2 text-right border-t border-[#D8C6A8]">
            <button type="button" onclick="closeTermsModal()" class="px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] rounded-lg">Close</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const todayStr = '{{ \Carbon\Carbon::now("Asia/Kolkata")->format("Y-m-d") }}';
const tomorrowStr = '{{ \Carbon\Carbon::now("Asia/Kolkata")->addDays(1)->format("Y-m-d") }}';
const maxNormalStr = '{{ \Carbon\Carbon::now("Asia/Kolkata")->addDays(7)->format("Y-m-d") }}';

function updateConsultationType(type) {
    const cardUrgent = document.getElementById('cardUrgent');
    const cardNormal = document.getElementById('cardNormal');
    const checkUrgent = document.getElementById('checkUrgent');
    const checkNormal = document.getElementById('checkNormal');
    const submitBtnText = document.getElementById('submitBtnText');
    const dateInput = document.getElementById('preferred_date');

    if (type === 'urgent') {
        cardUrgent.className = 'relative block cursor-pointer rounded-2xl border-2 border-[#C49A45] bg-[#EDE3D4] p-5 transition-all shadow-sm';
        cardNormal.className = 'relative block cursor-pointer rounded-2xl border border-[#D8C6A8] bg-[#F7F0E3] p-5 transition-all shadow-xs hover:border-[#C49A45]';
        
        checkUrgent.className = 'w-5 h-5 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold';
        checkNormal.className = 'w-5 h-5 rounded-full bg-transparent border border-[#D8C6A8] text-transparent flex items-center justify-center text-xs font-bold';

        submitBtnText.innerText = 'CONFIRM & PROCEED — ₹5,000';
        
        if (dateInput) {
            dateInput.min = todayStr;
            dateInput.max = tomorrowStr;
            if (dateInput.value < todayStr || dateInput.value > tomorrowStr) {
                dateInput.value = todayStr;
            }
        }

        const slotMorning = document.getElementById('slotMorning');
        if (slotMorning) selectTimeSlot('10:00 AM - 01:00 PM IST', slotMorning);
    } else {
        cardNormal.className = 'relative block cursor-pointer rounded-2xl border-2 border-[#C49A45] bg-[#EDE3D4] p-5 transition-all shadow-sm';
        cardUrgent.className = 'relative block cursor-pointer rounded-2xl border border-[#D8C6A8] bg-[#F7F0E3] p-5 transition-all shadow-xs hover:border-[#C49A45]';

        checkNormal.className = 'w-5 h-5 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold';
        checkUrgent.className = 'w-5 h-5 rounded-full bg-transparent border border-[#D8C6A8] text-transparent flex items-center justify-center text-xs font-bold';

        submitBtnText.innerText = 'CONFIRM & PROCEED — ₹3,000';
        
        if (dateInput) {
            dateInput.min = tomorrowStr;
            dateInput.max = maxNormalStr;
            if (dateInput.value < tomorrowStr || dateInput.value > maxNormalStr) {
                dateInput.value = tomorrowStr;
            }
        }

        const slotAfternoon = document.getElementById('slotAfternoon');
        if (slotAfternoon) selectTimeSlot('02:00 PM - 05:00 PM IST', slotAfternoon);
    }
}

function selectDate(dateVal, element) {
    document.querySelectorAll('.date-btn').forEach(btn => {
        btn.className = 'date-btn flex-1 min-w-[76px] py-2.5 px-3 rounded-xl border text-center transition-all text-xs font-medium bg-[#FDFBF7] border-[#D8C6A8] text-[#29211F] hover:border-[#C49A45]';
    });
    element.className = 'date-btn flex-1 min-w-[76px] py-2.5 px-3 rounded-xl border text-center transition-all text-xs font-bold bg-[#EDE3D4] border-[#C49A45] text-[#541F1D]';
    document.getElementById('preferred_date').value = dateVal;
}

function selectTimeSlot(timeVal, element) {
    document.querySelectorAll('.slot-btn').forEach(btn => {
        btn.className = 'slot-btn w-full p-3.5 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold bg-[#FDFBF7] border-[#D8C6A8] text-[#29211F] hover:border-[#C49A45]';
        const badge = btn.querySelector('.slot-badge');
        if (badge) {
            badge.className = 'slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#EDE3D4] text-[#541F1D] border border-[#D8C6A8]';
            badge.innerText = 'Available';
        }
    });
    element.className = 'slot-btn w-full p-3.5 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold bg-[#EDE3D4] border-[#C49A45] text-[#541F1D]';
    const activeBadge = element.querySelector('.slot-badge');
    if (activeBadge) {
        activeBadge.className = 'slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#541F1D] text-[#F7F0E3]';
        activeBadge.innerText = 'Selected';
    }
    document.getElementById('preferred_time').value = timeVal;
}

function validateForm() {
    const name = document.getElementById('inputName').value.trim();
    const phone = document.getElementById('inputPhone').value.trim();
    const birthDate = document.getElementById('inputBirthDate').value.trim();
    const termsConsent = document.getElementById('termsConsent').checked;
    const submitBtn = document.getElementById('submitBtn');

    if (name !== '' && phone !== '' && birthDate !== '' && termsConsent) {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}

function openTermsModal() {
    document.getElementById('termsModal').classList.remove('hidden');
}

function closeTermsModal() {
    document.getElementById('termsModal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');
    if (type === 'normal') {
        const normalRadio = document.querySelector('input[name="consultation_type"][value="normal"]');
        if (normalRadio) {
            normalRadio.checked = true;
            updateConsultationType('normal');
        }
    } else {
        updateConsultationType('urgent');
    }
    validateForm();
});
</script>
@endpush
