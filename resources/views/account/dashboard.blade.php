@extends('layouts.app')

@section('title', 'Customer Dashboard — Ganesha Astro Consultancy')

@section('content')
<section class="bg-[#F7F0E3] text-[#29211F] py-8 sm:py-12 min-h-[80vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Status Alert Messages -->
        @if(session('status'))
            <div class="p-4 rounded-xl bg-[#EDE3D4] border border-[#C49A45]/50 text-[#541F1D] text-sm font-semibold flex items-center justify-between shadow-xs">
                <div class="flex items-center space-x-2">
                    <span class="text-base">✨</span>
                    <span>{{ session('status') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-[#541F1D]/60 hover:text-[#541F1D] text-xs font-bold uppercase tracking-wider">Dismiss</button>
            </div>
        @endif

        <!-- HERO BANNER (Wide Burgundy Card) -->
        <div class="bg-[#351211] rounded-[24px] p-6 sm:p-8 lg:p-10 border border-[#C49A45]/40 shadow-xl text-[#F7F0E3] relative overflow-hidden">
            <!-- Background Decorative Overlay -->
            <div class="absolute -right-16 -top-16 w-80 h-80 bg-[#541F1D] rounded-full blur-3xl opacity-50 pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#C49A45_1px,transparent_1px)] opacity-10 pointer-events-none [background-size:20px_20px]"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6 lg:gap-10">
                
                <!-- Left Content -->
                <div class="space-y-3 max-w-2xl">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-[#541F1D]/80 border border-[#C49A45]/40 text-[#C49A45] text-[10px] sm:text-xs font-bold uppercase tracking-[0.2em]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45] animate-pulse"></span>
                        <span>CUSTOMER DASHBOARD</span>
                    </div>

                    <h1 class="font-serif-luxury text-2xl sm:text-4xl lg:text-5xl font-bold text-[#F7F0E3] tracking-wide leading-tight">
                        Namaste, {{ $user->name }}
                    </h1>

                    <p class="text-xs sm:text-sm text-[#D8C6A8] font-light leading-relaxed">
                        Welcome to Ganesha Astro Consultancy. Manage your consultations, review past readings, and update your account details.
                    </p>

                    <!-- User Contact Outlined Pills -->
                    <div class="flex flex-wrap items-center gap-2.5 pt-1 text-xs">
                        <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-[#29211F]/70 border border-[#C49A45]/30 text-[#F7F0E3]">
                            <svg class="w-3.5 h-3.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ $user->email }}</span>
                        </span>
                        @if($user->phone)
                            <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-[#29211F]/70 border border-[#C49A45]/30 text-[#F7F0E3]">
                                <svg class="w-3.5 h-3.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>{{ $user->phone }}</span>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Right Side: Spiritual Emblem -->
                <div class="flex items-center space-x-4 self-start lg:self-center bg-[#541F1D]/50 border border-[#C49A45]/30 p-4 rounded-2xl backdrop-blur-xs flex-shrink-0">
                    <div class="w-14 h-14 rounded-full bg-[#EDE3D4] border border-[#C49A45] flex items-center justify-center p-2 shadow-inner flex-shrink-0">
                        <img src="{{ asset('images/ganesha-logo.png') }}" alt="Lord Ganesha" class="w-full h-full object-contain" />
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-[#C49A45]">GANESHA BLESSINGS</span>
                        <span class="font-serif text-sm font-bold text-[#F7F0E3]">Vedic Guidance & Solutions</span>
                        <span class="block text-[11px] text-[#D8C6A8] font-light mt-0.5">Astrologer Tamal Chakraborty</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- SUMMARY STATISTICS ROW (4 Cards) -->
        @php
            $totalCount = $appointments->count();
            $completedCount = $appointments->where('status', 'Completed')->count();
            $upcomingCount = $appointments->whereIn('status', ['Confirmed', 'Pending Payment'])->where('status', '!=', 'Cancelled')->where('status', '!=', 'Expired')->count();
            $cancelledCount = $appointments->where('status', 'Cancelled')->count();
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            
            <!-- Card 1: Total Bookings -->
            <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-5 shadow-xs hover:border-[#C49A45] transition-all duration-300 flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-[#EDE3D4] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0">
                    <svg class="w-6 h-6 text-[#541F1D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <span class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#541F1D] block leading-none">{{ $totalCount }}</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#29211F] mt-1">Total Bookings</h4>
                    <span class="text-[11px] text-[#81766D]">All time consultations</span>
                </div>
            </div>

            <!-- Card 2: Completed -->
            <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-5 shadow-xs hover:border-[#C49A45] transition-all duration-300 flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100/80 border border-emerald-300 flex items-center justify-center text-emerald-800 flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <span class="font-serif-luxury text-2xl sm:text-3xl font-bold text-emerald-900 block leading-none">{{ $completedCount }}</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#29211F] mt-1">Completed</h4>
                    <span class="text-[11px] text-[#81766D]">Sessions completed</span>
                </div>
            </div>

            <!-- Card 3: Upcoming -->
            <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-5 shadow-xs hover:border-[#C49A45] transition-all duration-300 flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100/80 border border-amber-300 flex items-center justify-center text-amber-800 flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <span class="font-serif-luxury text-2xl sm:text-3xl font-bold text-amber-900 block leading-none">{{ $upcomingCount }}</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#29211F] mt-1">Upcoming</h4>
                    <span class="text-[11px] text-[#81766D]">Scheduled sessions</span>
                </div>
            </div>

            <!-- Card 4: Cancelled -->
            <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-5 shadow-xs hover:border-[#C49A45] transition-all duration-300 flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-rose-100/80 border border-rose-300 flex items-center justify-center text-rose-800 flex-shrink-0">
                    <svg class="w-6 h-6 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <span class="font-serif-luxury text-2xl sm:text-3xl font-bold text-rose-900 block leading-none">{{ $cancelledCount }}</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#29211F] mt-1">Cancelled</h4>
                    <span class="text-[11px] text-[#81766D]">Cancelled sessions</span>
                </div>
            </div>

        </div>

        <!-- TWO COLUMN MAIN DASHBOARD CONTENT -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN (70%): Consultation History -->
            <div class="lg:col-span-8 space-y-6" x-data="{ activeTab: 'all' }">
                
                <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-[24px] p-5 sm:p-7 space-y-6 shadow-xs">
                    
                    <!-- Header Row -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#D8C6A8] pb-5">
                        <div>
                            <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#541F1D]">Your Consultation History</h2>
                            <p class="text-xs text-[#81766D]">View details and receipt PDFs for your booked sessions</p>
                        </div>
                        <a href="{{ route('consultation.book') }}" 
                           class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] px-4 py-2.5 rounded-xl border border-[#C49A45]/40 transition-all self-start sm:self-auto">
                            + Book New Consultation
                        </a>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex flex-wrap gap-2 border-b border-[#D8C6A8]/60 pb-3">
                        <button type="button" @click="activeTab = 'all'" 
                                :class="activeTab === 'all' ? 'bg-[#541F1D] text-[#F7F0E3] border-[#C49A45]' : 'bg-[#F7F0E3] text-[#29211F] border-[#D8C6A8] hover:border-[#C49A45]'"
                                class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg border transition-all">
                            All ({{ $totalCount }})
                        </button>

                        <button type="button" @click="activeTab = 'upcoming'" 
                                :class="activeTab === 'upcoming' ? 'bg-[#541F1D] text-[#F7F0E3] border-[#C49A45]' : 'bg-[#F7F0E3] text-[#29211F] border-[#D8C6A8] hover:border-[#C49A45]'"
                                class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg border transition-all">
                            Upcoming ({{ $upcomingCount }})
                        </button>

                        <button type="button" @click="activeTab = 'completed'" 
                                :class="activeTab === 'completed' ? 'bg-[#541F1D] text-[#F7F0E3] border-[#C49A45]' : 'bg-[#F7F0E3] text-[#29211F] border-[#D8C6A8] hover:border-[#C49A45]'"
                                class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg border transition-all">
                            Completed ({{ $completedCount }})
                        </button>

                        <button type="button" @click="activeTab = 'cancelled'" 
                                :class="activeTab === 'cancelled' ? 'bg-[#541F1D] text-[#F7F0E3] border-[#C49A45]' : 'bg-[#F7F0E3] text-[#29211F] border-[#D8C6A8] hover:border-[#C49A45]'"
                                class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg border transition-all">
                            Cancelled ({{ $cancelledCount }})
                        </button>
                    </div>

                    <!-- Bookings List -->
                    @if($appointments->isEmpty())
                        <div class="text-center py-12 px-4 bg-[#EDE3D4]/40 rounded-2xl border border-dashed border-[#D8C6A8] space-y-3">
                            <div class="w-16 h-16 bg-[#EDE3D4] border border-[#D8C6A8] rounded-full flex items-center justify-center mx-auto text-2xl text-[#541F1D]">
                                📜
                            </div>
                            <h3 class="font-serif-luxury text-lg font-bold text-[#541F1D]">No consultation records found yet</h3>
                            <p class="text-xs text-[#81766D] max-w-md mx-auto leading-relaxed">
                                When you book an astrological consultation with Tamal Chakraborty, your sessions will appear here.
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('consultation.book') }}" 
                                   class="inline-flex items-center px-6 py-3 rounded-xl bg-[#541F1D] text-[#F7F0E3] font-bold text-xs uppercase tracking-widest hover:bg-[#351211] border border-[#C49A45] transition-all shadow-md">
                                    BOOK CONSULTATION NOW →
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($appointments as $item)
                                @php
                                    $isCompleted = $item->status === 'Completed';
                                    $isCancelled = $item->status === 'Cancelled';
                                    $isUpcoming = in_array($item->status, ['Confirmed', 'Pending Payment']) && !$isCancelled && $item->status !== 'Expired';
                                    $categoryGroup = $isCompleted ? 'completed' : ($isCancelled ? 'cancelled' : 'upcoming');
                                @endphp

                                <div x-show="activeTab === 'all' || activeTab === '{{ $categoryGroup }}'" 
                                     class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-5 space-y-4 hover:border-[#C49A45] transition-all duration-300 shadow-xs">
                                    
                                    <!-- Top Row: Reference + Status Badges -->
                                    <div class="flex flex-wrap items-center justify-between gap-2 border-b border-[#D8C6A8]/60 pb-3">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-mono text-xs font-bold text-[#541F1D] bg-[#EDE3D4] px-2.5 py-1 rounded-lg border border-[#D8C6A8]">
                                                {{ $item->booking_reference }}
                                            </span>
                                            <span class="text-xs font-semibold text-[#81766D]">
                                                {{ $item->service->title ?? 'Vedic Astrology Consultation' }}
                                            </span>
                                        </div>

                                        <!-- Status Badges -->
                                        <div class="flex items-center space-x-2">
                                            @if($item->status === 'Confirmed' && $item->payment_status === 'Paid')
                                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300 text-[11px] font-bold">
                                                    ✓ Confirmed & Paid
                                                </span>
                                            @elseif($item->status === 'Completed')
                                                <span class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 border border-blue-300 text-[11px] font-bold">
                                                    ✓ Session Completed
                                                </span>
                                            @elseif($item->status === 'Cancelled')
                                                <span class="px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-800 border border-rose-300 text-[11px] font-bold">
                                                    Cancelled
                                                </span>
                                            @elseif($item->status === 'Expired' || $item->payment_status === 'Expired')
                                                <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 border border-amber-300 text-[11px] font-bold">
                                                    Expired
                                                </span>
                                            @else
                                                <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 border border-amber-300 text-[11px] font-bold">
                                                    Pending Payment
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Middle Row: Schedule & Consultation Info -->
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                                        <div>
                                            <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">SCHEDULED DATE</span>
                                            <span class="font-bold text-[#541F1D] text-sm">{{ \Carbon\Carbon::parse($item->preferred_date)->format('D, d M Y') }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">TIME SLOT</span>
                                            <span class="font-semibold text-[#29211F]">{{ $item->preferred_time }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">TYPE & MODE</span>
                                            <span class="font-semibold text-[#29211F]">{{ $item->consultation_type }} • Audio Call</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Action Bar -->
                                    <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-[#D8C6A8]/60">
                                        <div class="text-xs">
                                            <span class="text-[#81766D]">Amount:</span>
                                            <span class="font-bold text-[#541F1D] text-sm ml-1">₹{{ number_format($item->amount, 2) }}</span>
                                        </div>

                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('account.booking.show', ['reference' => $item->booking_reference]) }}" 
                                               class="text-xs font-bold text-[#541F1D] hover:underline">
                                                View Details →
                                            </a>

                                            @if($item->payment_status === 'Paid')
                                                <a href="{{ route('consultation.receipt.pdf', ['reference' => $item->booking_reference]) }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center px-3 py-1.5 rounded-lg bg-[#541F1D] text-[#F7F0E3] text-xs font-bold hover:bg-[#351211] transition-all border border-[#C49A45]/40">
                                                    📄 PDF Receipt
                                                </a>
                                            @elseif($item->payment_status === 'Pending' && $item->status !== 'Expired')
                                                <a href="{{ route('consultation.checkout', ['reference' => $item->booking_reference]) }}" 
                                                   class="inline-flex items-center px-3 py-1.5 rounded-lg bg-[#C49A45] text-[#541F1D] text-xs font-bold hover:bg-[#a37c30] transition-all">
                                                    Pay Now
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

            </div>

            <!-- RIGHT COLUMN (30%): Profile Card, Account Settings, Support -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Profile Summary Card -->
                <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-[24px] p-6 space-y-4 shadow-xs text-center">
                    <!-- Circular Avatar with First Initial -->
                    <div class="w-20 h-20 rounded-full bg-[#541F1D] text-[#F7F0E3] border-2 border-[#C49A45] flex items-center justify-center mx-auto text-3xl font-serif-luxury font-bold shadow-md">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="font-serif-luxury text-xl font-bold text-[#541F1D]">{{ $user->name }}</h3>
                        <p class="text-xs text-[#81766D] truncate mt-0.5">{{ $user->email }}</p>
                        @if($user->phone)
                            <p class="text-xs text-[#81766D] mt-0.5">📱 {{ $user->phone }}</p>
                        @endif
                    </div>

                    <div class="pt-2 border-t border-[#D8C6A8]/60">
                        <a href="{{ route('account.profile') }}" 
                           class="inline-block w-full py-2.5 px-4 rounded-xl bg-[#EDE3D4] hover:bg-[#D8C6A8] text-[#541F1D] text-xs font-bold uppercase tracking-wider transition-all">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <!-- Account Settings Navigation Card -->
                <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-[24px] p-6 space-y-4 shadow-xs">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#541F1D] border-b border-[#D8C6A8] pb-3">
                        Account Settings
                    </h4>

                    <div class="space-y-3">
                        <!-- Edit Profile -->
                        <a href="{{ route('account.profile') }}" class="group flex items-start space-x-3 p-3 rounded-xl bg-[#F7F0E3] hover:bg-[#EDE3D4] border border-[#D8C6A8]/60 transition-all">
                            <div class="w-8 h-8 rounded-lg bg-[#EDE3D4] text-[#541F1D] flex items-center justify-center flex-shrink-0 font-bold text-sm">
                                👤
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-[#541F1D] group-hover:text-[#351211]">Edit Profile</h5>
                                <p class="text-[11px] text-[#81766D]">Update your personal information</p>
                            </div>
                        </a>

                        <!-- Change Password -->
                        <a href="{{ route('account.password') }}" class="group flex items-start space-x-3 p-3 rounded-xl bg-[#F7F0E3] hover:bg-[#EDE3D4] border border-[#D8C6A8]/60 transition-all">
                            <div class="w-8 h-8 rounded-lg bg-[#EDE3D4] text-[#541F1D] flex items-center justify-center flex-shrink-0 font-bold text-sm">
                                🔒
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-[#541F1D] group-hover:text-[#351211]">Change Password</h5>
                                <p class="text-[11px] text-[#81766D]">Keep your account secure</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Need Help Card -->
                <div class="bg-[#351211] border border-[#C49A45]/40 rounded-[24px] p-6 space-y-4 text-[#F7F0E3] shadow-md">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#C49A45]">DESK SUPPORT</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-[#F7F0E3]">Need Help?</h4>
                        <p class="text-xs text-[#D8C6A8] leading-relaxed">
                            For any support related to your consultation, feel free to contact us.
                        </p>
                    </div>

                    <div class="space-y-2 pt-2 border-t border-[#C49A45]/30">
                        <a href="tel:8392059201" 
                           class="flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl bg-[#541F1D] hover:bg-[#2A0E0D] text-[#F7F0E3] text-xs font-bold border border-[#C49A45]/40 transition-all">
                            <span>📞 Call 8392059201</span>
                        </a>

                        <a href="https://wa.me/918392059201" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl bg-emerald-900/80 hover:bg-emerald-900 text-emerald-100 text-xs font-bold border border-emerald-500/40 transition-all">
                            <span>💬 WhatsApp 8392059201</span>
                        </a>

                        <a href="mailto:ganesha4astro@gmail.com" 
                           class="flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl bg-[#EDE3D4] hover:bg-[#D8C6A8] text-[#541F1D] text-xs font-bold transition-all">
                            <span>✉️ Email Support</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
@endsection
