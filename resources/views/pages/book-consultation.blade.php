@extends('layouts.app')

@section('title', 'Book a Consultation | Astrologer Tamal Chakraborty')
@section('meta_description', 'Book a personalized 1-on-1 Vedic Astrology consultation with Tamal Chakraborty. Select your consultation type, date & time slot, and enter birth details.')

@section('content')

<!-- Header Banner (Dark Green #06281F) -->
<section class="bg-[#06281F] text-[#FFFFFF] py-10 sm:py-12 lg:py-14 border-b border-[#145A43] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-left space-y-2">
        <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-[#C49A45] uppercase">
            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
            <span>QUICK BOOKING</span>
        </div>
        <h1 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#FFFFFF]">
            Select consultation type
        </h1>
        <p class="text-[#E8F1EC]/90 text-xs sm:text-sm max-w-2xl font-normal leading-relaxed">
            Choose your preferred urgency, date, time slot, and enter your details to confirm your private Vedic consultation.
        </p>
    </div>
</section>

<!-- Main Booking Section (Very Light Green #F3F8F5 Background) -->
<section class="bg-[#F3F8F5] text-[#17211D] py-10 lg:py-16 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-8 p-5 rounded-2xl bg-[#0B3D2E] border border-[#C49A45] text-[#FFFFFF] text-xs sm:text-sm font-medium flex items-start space-x-3 shadow-md">
                <svg class="w-6 h-6 text-[#C49A45] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <strong class="block font-bold text-[#C49A45] text-base mb-1">Booking Request Submitted!</strong>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 p-5 rounded-2xl bg-red-900 border border-red-700 text-red-100 text-xs sm:text-sm font-medium space-y-1 shadow-md">
                <strong class="block font-bold text-red-200 text-sm mb-1">Please fix the following issues:</strong>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('consultation.submit') }}" method="POST" id="bookingForm" class="space-y-8">
            @csrf

            <!-- TOP 2-COLUMN SECTION (Left ~60%, Right ~40% on Desktop) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- LEFT COLUMN (~60% width - Step 1 & Step 2) -->
                <div class="lg:col-span-7 space-y-8">
                    
                    <!-- STEP 1: SELECT CONSULTATION TYPE -->
                    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
                        <!-- Step Heading -->
                        <div class="flex items-center space-x-3 border-b border-[#C8D8CF] pb-4">
                            <span class="w-7 h-7 rounded-full bg-[#0B3D2E] text-[#FFFFFF] flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                            <h2 class="font-serif-luxury text-lg sm:text-xl font-bold uppercase tracking-wider text-[#0B3D2E]">
                                SELECT CONSULTATION TYPE
                            </h2>
                        </div>

                        <!-- 2 Side-by-Side Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <!-- Urgent Consultation Card -->
                            <label id="cardUrgent" class="relative block cursor-pointer rounded-2xl border-2 border-[#0B3D2E] bg-[#E8F1EC] p-5 transition-all shadow-sm">
                                <input type="radio" name="consultation_type" value="urgent" checked class="sr-only" onchange="updateConsultationType('urgent')">
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2 text-[#0B3D2E]">
                                            <span class="text-base">⚡</span>
                                            <span class="font-serif-luxury text-sm font-bold uppercase tracking-wider">URGENT</span>
                                        </div>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] rounded-full border border-[#0B3D2E]">
                                            WITHIN 24H
                                        </span>
                                    </div>
                                    <p class="text-xs text-[#60736B] font-normal leading-relaxed">
                                        Appointment within 24 hours
                                    </p>
                                    <div class="pt-2 border-t border-[#C8D8CF]/60 flex items-center justify-between">
                                        <span class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">₹5,000</span>
                                        <span id="checkUrgent" class="w-5 h-5 rounded-full bg-[#0B3D2E] text-[#FFFFFF] flex items-center justify-center text-xs font-bold">✓</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Normal Consultation Card -->
                            <label id="cardNormal" class="relative block cursor-pointer rounded-2xl border border-[#C8D8CF] bg-[#FFFFFF] p-5 transition-all shadow-xs hover:border-[#0B3D2E]">
                                <input type="radio" name="consultation_type" value="normal" class="sr-only" onchange="updateConsultationType('normal')">
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2 text-[#0B3D2E]">
                                            <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            <span class="font-serif-luxury text-sm font-bold uppercase tracking-wider">NORMAL</span>
                                        </div>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#0B3D2E] bg-[#E8F1EC] rounded-full border border-[#C8D8CF]">
                                            FLEXIBLE DATE
                                        </span>
                                    </div>
                                    <p class="text-xs text-[#60736B] font-normal leading-relaxed">
                                        Scheduled advance appointment
                                    </p>
                                    <div class="pt-2 border-t border-[#C8D8CF]/60 flex items-center justify-between">
                                        <span class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">₹3,000</span>
                                        <span id="checkNormal" class="w-5 h-5 rounded-full bg-transparent border border-[#C8D8CF] text-transparent flex items-center justify-center text-xs font-bold">✓</span>
                                    </div>
                                </div>
                            </label>

                        </div>
                    </div>

                    <!-- APPOINTMENT INFORMATION MESSAGE BANNER -->
                    <div class="bg-[#E8F1EC] border border-[#C8D8CF] rounded-xl p-4 flex items-start space-x-3 text-xs text-[#0B3D2E]">
                        <svg class="w-5 h-5 text-[#C49A45] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="space-y-1.5 leading-relaxed font-medium">
                            <p>Appointments are conducted via 1-on-1 Audio call. All birth details and personal discussions remain 100% strictly private & confidential.</p>
                            <p>This Payment Only For Single Time Consultation & No Retain Documents Provided.</p>
                        </div>
                    </div>

                    <!-- STEP 2: CONSULTATION MODE -->
                    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
                        <!-- Step Heading -->
                        <div class="flex items-center space-x-3 border-b border-[#C8D8CF] pb-4">
                            <span class="w-7 h-7 rounded-full bg-[#0B3D2E] text-[#FFFFFF] flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                            <h2 class="font-serif-luxury text-lg sm:text-xl font-bold uppercase tracking-wider text-[#0B3D2E]">
                                CONSULTATION MODE
                            </h2>
                        </div>

                        <!-- 2 Horizontal Selection Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <!-- Audio Consultation (Selectable) -->
                            <label class="relative flex items-center justify-between p-4 rounded-xl border-2 border-[#0B3D2E] bg-[#E8F1EC] cursor-pointer shadow-xs">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="mode" value="audio" checked class="accent-[#0B3D2E] w-4 h-4">
                                    <div class="w-8 h-8 rounded-full bg-[#FFFFFF] border border-[#C8D8CF] flex items-center justify-center text-[#0B3D2E]">
                                        <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <span class="font-serif-luxury text-sm font-bold text-[#17211D]">Audio Consultation</span>
                                </div>
                            </label>

                            <!-- Video Consultation (Locked & Disabled) -->
                            <div class="relative flex items-center justify-between p-4 rounded-xl border border-[#C8D8CF] bg-[#E8F1EC]/60 opacity-60 cursor-not-allowed select-none">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="mode" value="video" disabled class="accent-[#0B3D2E] w-4 h-4 cursor-not-allowed">
                                    <div class="w-8 h-8 rounded-full bg-[#E8F1EC] border border-[#C8D8CF] flex items-center justify-center text-[#60736B]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </div>
                                    <span class="font-serif-luxury text-sm font-bold text-[#60736B]">Video Consultation</span>
                                </div>
                                <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] rounded border border-[#0B3D2E]">
                                    LOCKED
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN (~40% width - Step 3: Select Date & Time) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
                        
                        <!-- Step Heading -->
                        <div class="flex items-center space-x-3 border-b border-[#C8D8CF] pb-4">
                            <span class="w-7 h-7 rounded-full bg-[#0B3D2E] text-[#FFFFFF] flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                            <h2 class="font-serif-luxury text-lg sm:text-xl font-bold uppercase tracking-wider text-[#0B3D2E]">
                                SELECT DATE & TIME
                            </h2>
                        </div>

                        <!-- Date Selection Buttons (Horizontal Pills) -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#0B3D2E]">Select Preferred Date</label>
                            <div id="datePillsContainer" class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-thin">
                                <!-- Dynamic Date Pills JS -->
                            </div>
                        </div>

                        <!-- Time Slot Selection Buttons (Dynamic 30-Minute Generation) -->
                        <div class="space-y-2.5 pt-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#0B3D2E]">Available Time Slots</label>
                            
                            <div id="slotsContainer" class="space-y-2 max-h-[320px] overflow-y-auto pr-1">
                                <div class="py-4 text-center text-xs text-[#60736B]">Loading available time slots...</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- FULL-WIDTH BOTTOM PANEL: STEP 4 CLIENT INFORMATION -->
            <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-6 sm:p-10 space-y-8 shadow-sm">
                
                <!-- Step Heading -->
                <div class="flex items-center space-x-3 border-b border-[#C8D8CF] pb-4">
                    <span class="w-7 h-7 rounded-full bg-[#0B3D2E] text-[#FFFFFF] flex items-center justify-center text-xs font-bold flex-shrink-0">4</span>
                    <h2 class="font-serif-luxury text-xl font-bold uppercase tracking-wider text-[#0B3D2E]">
                        CLIENT INFORMATION
                    </h2>
                </div>

                <!-- 3-Column Responsive Grid on Desktop -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 text-xs">
                    
                    <!-- 1. Full Name -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">FULL NAME *</label>
                        <input type="text" 
                               name="name" 
                               id="inputName" 
                               required 
                               oninput="validateForm()"
                               value="{{ auth()->check() ? auth()->user()->name : old('name') }}"
                               placeholder="Enter your full name" 
                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] placeholder-[#60736B]/60 focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 2. Date of Birth -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">DATE OF BIRTH *</label>
                        <input type="date" 
                               name="birth_date" 
                               id="inputBirthDate" 
                               required 
                               onchange="validateForm()"
                               value="{{ auth()->check() && auth()->user()->birth_date ? auth()->user()->birth_date->format('Y-m-d') : old('birth_date') }}"
                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 3. Time of Birth (Time Picker) -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">TIME OF BIRTH</label>
                        <input type="time" 
                               name="birth_time" 
                               id="inputBirthTime"
                               value="{{ auth()->check() && auth()->user()->birth_time ? (strtotime(auth()->user()->birth_time) ? date('H:i', strtotime(auth()->user()->birth_time)) : auth()->user()->birth_time) : old('birth_time') }}"
                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 4. Place of Birth -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">PLACE OF BIRTH</label>
                        <input type="text" 
                               name="birth_place" 
                               id="inputBirthPlace"
                               value="{{ auth()->check() ? auth()->user()->birth_place : old('birth_place') }}"
                               placeholder="e.g. Kolkata, West Bengal" 
                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] placeholder-[#60736B]/60 focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 5. Selected Date (Synced with Step 3) -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">SELECTED DATE *</label>
                        <input type="date" 
                               name="preferred_date" 
                               id="preferred_date" 
                               required 
                               min="{{ \Carbon\Carbon::now('Asia/Kolkata')->addDays(1)->format('Y-m-d') }}"
                               value="{{ \Carbon\Carbon::now('Asia/Kolkata')->addDays(1)->format('Y-m-d') }}"
                               class="w-full bg-[#E8F1EC] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#0B3D2E] font-bold focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 6. Selected Time (Synced with Step 3) -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">SELECTED TIME *</label>
                        <input type="text" 
                               name="preferred_time" 
                               id="preferred_time" 
                               required 
                               value="09:00 AM" 
                               readonly
                               class="w-full bg-[#E8F1EC] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#0B3D2E] font-bold focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 7. Mobile Number -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">MOBILE NUMBER *</label>
                        <input type="tel" 
                               name="phone" 
                               id="inputPhone" 
                               required 
                               oninput="validateForm()"
                               value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}"
                               placeholder="e.g. 96476 80707" 
                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] placeholder-[#60736B]/60 focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 8. WhatsApp Number -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">WHATSAPP NUMBER</label>
                        <input type="tel" 
                               name="whatsapp" 
                               value="{{ auth()->check() ? (auth()->user()->whatsapp ?? auth()->user()->phone) : old('whatsapp') }}"
                               placeholder="e.g. 96476 80707" 
                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] placeholder-[#60736B]/60 focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- 9. Email Address -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">EMAIL ADDRESS</label>
                        <input type="email" 
                               name="email" 
                               value="{{ auth()->check() ? auth()->user()->email : old('email') }}"
                               placeholder="e.g. ganesha4astro@gmail.com" 
                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] placeholder-[#60736B]/60 focus:outline-none focus:border-[#145A43]">
                    </div>

                    <!-- OPTIONAL CUSTOMER ACCOUNT CREATION -->
                    @guest
                        <div class="md:col-span-2 lg:col-span-3 border-t border-[#C8D8CF] pt-4">
                            <div class="bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl p-4 space-y-3">
                                <label class="flex items-start space-x-3 cursor-pointer">
                                    <input type="checkbox" 
                                           id="createAccountCheckbox" 
                                           name="create_account" 
                                           value="1" 
                                           onchange="toggleAccountPasswordFields()" 
                                           class="mt-0.5 accent-[#0B3D2E] w-4 h-4 rounded border-[#C8D8CF]">
                                    <div>
                                        <span class="text-xs font-bold text-[#0B3D2E]">Create an account to manage my bookings</span>
                                        <p class="text-[11px] text-[#60736B] mt-0.5">Create an account to easily view and manage your consultation bookings.</p>
                                    </div>
                                </label>

                                <div id="accountPasswordContainer" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1">CREATE PASSWORD *</label>
                                        <input type="password" 
                                               name="password" 
                                               id="inputAccountPassword" 
                                               placeholder="Min 8 characters" 
                                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1">CONFIRM PASSWORD *</label>
                                        <input type="password" 
                                               name="password_confirmation" 
                                               id="inputAccountPasswordConfirmation" 
                                               placeholder="Re-enter password" 
                                               class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2.5 text-xs text-[#17211D]">
                                    </div>
                                </div>

                                <div class="text-[11px] text-[#60736B] pt-1">
                                    Already have an account? <a href="{{ route('account.login') }}" class="font-bold text-[#0B3D2E] underline">Log in here</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="md:col-span-2 lg:col-span-3 bg-[#E8F1EC] border border-[#C49A45] rounded-xl p-3.5 flex items-center justify-between text-xs text-[#0B3D2E]">
                            <span class="font-semibold">✓ Booking as logged-in customer: <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</span>
                            <a href="{{ route('account.dashboard') }}" class="text-[11px] font-bold uppercase text-[#C49A45] underline">My Account</a>
                        </div>
                    @endguest

                    <!-- 9. Mention Your Queries (Full Width Area) -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[#0B3D2E] mb-1.5">MENTION YOUR QUERIES (OPTIONAL)</label>
                        <textarea name="notes" 
                                  rows="3" 
                                  placeholder="Mention any specific concerns (career, marriage, business, health) for discussion during your consultation..." 
                                  class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-[#17211D] placeholder-[#60736B]/60 focus:outline-none focus:border-[#145A43]"></textarea>
                    </div>

                </div>

                <!-- TERMS & CONDITIONS SECTION -->
                <div class="border-t border-[#C8D8CF] pt-6 space-y-4">
                    <div class="flex items-center space-x-2 text-sm font-bold text-[#0B3D2E]">
                        <span class="text-[#C49A45] text-base">★</span>
                        <span>Terms & Conditions</span>
                        <button type="button" 
                                onclick="openTermsModal()" 
                                class="text-xs text-[#0B3D2E] underline font-normal hover:text-[#145A43] ml-2">
                            View Terms & Conditions
                        </button>
                    </div>

                    <label class="flex items-start space-x-3 cursor-pointer">
                        <input type="checkbox" 
                               id="termsConsent" 
                               name="terms_consent" 
                               required 
                               onchange="validateForm()" 
                               class="mt-1 accent-[#0B3D2E] w-4 h-4 rounded border-[#C8D8CF]">
                        <span class="text-xs text-[#60736B] leading-relaxed">
                            I have read and agree to the Terms & Conditions.
                        </span>
                    </label>
                </div>

                <!-- CONFIRM & PROCEED CTA BUTTON + SUPPORT FOOTER -->
                <div class="border-t border-[#C8D8CF] pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    
                    <p class="text-xs text-[#60736B] font-normal text-center sm:text-left">
                        If you have any difficulty with booking or your account, please call 
                        <a href="tel:8392059201" class="font-bold text-[#0B3D2E] underline hover:text-[#145A43]">8392059201</a>.
                    </p>

                    <button type="submit" 
                            id="submitBtn" 
                            disabled 
                            class="w-full sm:w-auto px-8 py-4 text-xs font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] active:bg-[#06281F] rounded-full shadow-md border border-[#0B3D2E] hover:border-[#C49A45] transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2">
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
    <div class="bg-[#F3F8F5] border border-[#C8D8CF] rounded-2xl max-w-xl w-full p-6 sm:p-8 space-y-5 shadow-2xl relative max-h-[85vh] overflow-y-auto">
        <div class="flex items-center justify-between border-b border-[#C8D8CF] pb-3">
            <h3 class="font-serif-luxury text-xl font-bold text-[#0B3D2E]">Terms & Conditions</h3>
            <button type="button" onclick="closeTermsModal()" class="text-[#60736B] hover:text-[#0B3D2E] font-bold text-lg">✕</button>
        </div>
        <div class="text-xs text-[#60736B] space-y-3 leading-relaxed">
            <p><strong>1. Privacy & Confidentiality:</strong> All birth details, horoscopes, and audio consultation recordings remain strictly confidential between Astrologer Tamal Chakraborty and the client.</p>
            <p><strong>2. Appointment Rescheduling:</strong> Appointment timing will be confirmed by desk within 4 hours. Requests to reschedule must be submitted at least 6 hours before slot time.</p>
            <p><strong>3. Non-Refundable Policy:</strong> Consultation fees are strictly non-refundable once booking request has been confirmed.</p>
            <p><strong>4. Vedic Remedies:</strong> Astrological remedies provided are Vedic and non-superstitious recommendations to assist personal life decisions.</p>
        </div>
        <div class="pt-2 text-right border-t border-[#C8D8CF]">
            <button type="button" onclick="closeTermsModal()" class="px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] rounded-lg">Close</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const todayStr = '{{ \Carbon\Carbon::now("Asia/Kolkata")->format("Y-m-d") }}';
const tomorrowStr = '{{ \Carbon\Carbon::now("Asia/Kolkata")->addDays(1)->format("Y-m-d") }}';
const normalMinStr = '{{ \Carbon\Carbon::now("Asia/Kolkata")->addDays(7)->format("Y-m-d") }}';

let currentConsultationType = 'urgent';

function getMinDateForType(type) {
    return type === 'urgent' ? tomorrowStr : normalMinStr;
}

function updateConsultationType(type) {
    currentConsultationType = type;
    const cardUrgent = document.getElementById('cardUrgent');
    const cardNormal = document.getElementById('cardNormal');
    const checkUrgent = document.getElementById('checkUrgent');
    const checkNormal = document.getElementById('checkNormal');
    const submitBtnText = document.getElementById('submitBtnText');
    const dateInput = document.getElementById('preferred_date');

    if (type === 'urgent') {
        cardUrgent.className = 'relative block cursor-pointer rounded-2xl border-2 border-[#0B3D2E] bg-[#E8F1EC] p-5 transition-all shadow-sm';
        cardNormal.className = 'relative block cursor-pointer rounded-2xl border border-[#C8D8CF] bg-[#FFFFFF] p-5 transition-all shadow-xs hover:border-[#0B3D2E]';
        
        checkUrgent.className = 'w-5 h-5 rounded-full bg-[#0B3D2E] text-[#FFFFFF] flex items-center justify-center text-xs font-bold';
        checkNormal.className = 'w-5 h-5 rounded-full bg-transparent border border-[#C8D8CF] text-transparent flex items-center justify-center text-xs font-bold';

        submitBtnText.innerText = 'CONFIRM & PROCEED — ₹5,000';
    } else {
        cardNormal.className = 'relative block cursor-pointer rounded-2xl border-2 border-[#0B3D2E] bg-[#E8F1EC] p-5 transition-all shadow-sm';
        cardUrgent.className = 'relative block cursor-pointer rounded-2xl border border-[#C8D8CF] bg-[#FFFFFF] p-5 transition-all shadow-xs hover:border-[#0B3D2E]';

        checkNormal.className = 'w-5 h-5 rounded-full bg-[#0B3D2E] text-[#FFFFFF] flex items-center justify-center text-xs font-bold';
        checkUrgent.className = 'w-5 h-5 rounded-full bg-transparent border border-[#C8D8CF] text-transparent flex items-center justify-center text-xs font-bold';

        submitBtnText.innerText = 'CONFIRM & PROCEED — ₹3,000';
    }

    const minDate = getMinDateForType(type);
    dateInput.min = minDate;
    if (!dateInput.value || dateInput.value < minDate) {
        dateInput.value = minDate;
    }

    renderDatePills(type);
    loadSlotsForDate(dateInput.value);
}

function renderDatePills(type) {
    const container = document.getElementById('datePillsContainer');
    if (!container) return;
    container.innerHTML = '';

    const minDateStr = getMinDateForType(type);
    const dateInput = document.getElementById('preferred_date');
    const selectedDate = dateInput.value;

    const parts = minDateStr.split('-');
    const baseDate = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));

    for (let i = 0; i < 14; i++) {
        const d = new Date(baseDate);
        d.setDate(baseDate.getDate() + i);

        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        const dateStr = `${yyyy}-${mm}-${dd}`;

        const dayName = d.toLocaleDateString('en-US', { weekday: 'short' });
        const monthDay = d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });

        const isSelected = dateStr === selectedDate;

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = `date-btn flex-shrink-0 min-w-[76px] py-2 px-3 rounded-xl border text-center transition-all text-xs ${isSelected ? 'bg-[#0B3D2E] border-[#0B3D2E] text-[#FFFFFF] font-bold' : 'bg-[#FFFFFF] border-[#C8D8CF] text-[#17211D] font-medium hover:border-[#0B3D2E]'}`;
        btn.innerHTML = `<div class="text-[10px] uppercase font-bold tracking-wider">${dayName}</div><div class="text-xs font-semibold">${monthDay}</div>`;
        btn.onclick = function() { selectDate(dateStr, this); };
        container.appendChild(btn);
    }
}

function selectDate(dateVal, element) {
    const minDate = getMinDateForType(currentConsultationType);
    if (dateVal < minDate) {
        alert(currentConsultationType === 'urgent' ? 'Urgent consultation requires minimum 1 full day advance booking.' : 'Normal consultation requires minimum 7 calendar days advance booking.');
        dateVal = minDate;
    }

    document.getElementById('preferred_date').value = dateVal;
    renderDatePills(currentConsultationType);
    loadSlotsForDate(dateVal);
}

function loadSlotsForDate(dateVal) {
    const container = document.getElementById('slotsContainer');
    container.innerHTML = '<div class="py-4 text-center text-xs text-[#60736B]">Loading available time slots...</div>';

    fetch(`/api/available-slots?date=${dateVal}&type=${currentConsultationType}`)
        .then(res => res.json())
        .then(res => {
            if (!res.success || !res.data || !res.data.slots || res.data.slots.length === 0) {
                container.innerHTML = '<div class="py-4 text-center text-xs font-bold text-red-800">No time slots available for this date.</div>';
                document.getElementById('preferred_time').value = '';
                validateForm();
                return;
            }

            container.innerHTML = '';
            let firstAvailable = null;

            res.data.slots.forEach((item) => {
                if (item.available) {
                    if (!firstAvailable) firstAvailable = item.time;

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = `slot-btn w-full p-3 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold ${firstAvailable === item.time ? 'bg-[#0B3D2E] border-[#0B3D2E] text-[#FFFFFF]' : 'bg-[#FFFFFF] border-[#C8D8CF] text-[#17211D] hover:border-[#0B3D2E]'}`;
                    btn.onclick = function() { selectTimeSlot(item.time, this); };

                    const spanTime = document.createElement('span');
                    spanTime.innerText = item.time;

                    const badge = document.createElement('span');
                    badge.className = `slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded ${firstAvailable === item.time ? 'bg-[#C49A45] text-[#06281F]' : 'bg-[#E8F1EC] text-[#0B3D2E] border border-[#C8D8CF]'}`;
                    badge.innerText = firstAvailable === item.time ? 'Selected' : 'Available';

                    btn.appendChild(spanTime);
                    btn.appendChild(badge);
                    container.appendChild(btn);
                } else {
                    const div = document.createElement('div');
                    div.className = 'w-full p-3 rounded-xl border border-[#C8D8CF] bg-[#E8F1EC]/50 opacity-60 flex items-center justify-between text-xs cursor-not-allowed select-none';

                    const spanTime = document.createElement('span');
                    spanTime.className = 'line-through text-[#60736B] font-medium';
                    spanTime.innerText = item.time;

                    const badge = document.createElement('span');
                    badge.className = 'text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#60736B] text-[#FFFFFF]';
                    badge.innerText = 'Unavailable ❌';

                    div.appendChild(spanTime);
                    div.appendChild(badge);
                    container.appendChild(div);
                }
            });

            if (firstAvailable) {
                document.getElementById('preferred_time').value = firstAvailable;
            } else {
                document.getElementById('preferred_time').value = '';
            }
            validateForm();
        })
        .catch(err => {
            console.error('Error fetching slots:', err);
            container.innerHTML = '<div class="py-4 text-center text-xs text-red-800">Failed to load time slots.</div>';
        });
}

function selectTimeSlot(timeVal, element) {
    document.querySelectorAll('.slot-btn').forEach(btn => {
        btn.className = 'slot-btn w-full p-3 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold bg-[#FFFFFF] border-[#C8D8CF] text-[#17211D] hover:border-[#0B3D2E]';
        const badge = btn.querySelector('.slot-badge');
        if (badge) {
            badge.className = 'slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#E8F1EC] text-[#0B3D2E] border border-[#C8D8CF]';
            badge.innerText = 'Available';
        }
    });
    element.className = 'slot-btn w-full p-3 rounded-xl border flex items-center justify-between transition-all text-xs font-semibold bg-[#0B3D2E] border-[#0B3D2E] text-[#FFFFFF]';
    const activeBadge = element.querySelector('.slot-badge');
    if (activeBadge) {
        activeBadge.className = 'slot-badge text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-[#C49A45] text-[#06281F]';
        activeBadge.innerText = 'Selected';
    }
    document.getElementById('preferred_time').value = timeVal;
    validateForm();
}

function validateForm() {
    const name = document.getElementById('inputName').value.trim();
    const phone = document.getElementById('inputPhone').value.trim();
    const birthDate = document.getElementById('inputBirthDate').value.trim();
    const prefTime = document.getElementById('preferred_time').value.trim();
    const termsConsent = document.getElementById('termsConsent').checked;
    const submitBtn = document.getElementById('submitBtn');

    if (name !== '' && phone !== '' && birthDate !== '' && prefTime !== '' && termsConsent) {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}

function toggleAccountPasswordFields() {
    const chk = document.getElementById('createAccountCheckbox');
    const container = document.getElementById('accountPasswordContainer');
    const pwdInput = document.getElementById('inputAccountPassword');
    const pwdConfirmInput = document.getElementById('inputAccountPasswordConfirmation');

    if (chk && chk.checked) {
        container.classList.remove('hidden');
        if (pwdInput) pwdInput.required = true;
        if (pwdConfirmInput) pwdConfirmInput.required = true;
    } else {
        if (container) container.classList.add('hidden');
        if (pwdInput) { pwdInput.required = false; pwdInput.value = ''; }
        if (pwdConfirmInput) { pwdConfirmInput.required = false; pwdConfirmInput.value = ''; }
    }
}

function openTermsModal() {
    document.getElementById('termsModal').classList.remove('hidden');
}

function closeTermsModal() {
    document.getElementById('termsModal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', () => {
    const prefDateInput = document.getElementById('preferred_date');

    prefDateInput.addEventListener('change', function() {
        const minDate = getMinDateForType(currentConsultationType);
        if (this.value < minDate) {
            alert(currentConsultationType === 'urgent' ? 'Urgent consultation requires minimum 1 full day advance booking.' : 'Normal consultation requires minimum 7 calendar days advance booking.');
            this.value = minDate;
        }
        renderDatePills(currentConsultationType);
        loadSlotsForDate(this.value);
    });

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
