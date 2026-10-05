<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F7F0E3]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') | Ganesha Astro Consultancy</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, ::before, ::after {
            box-sizing: border-box;
        }
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        .font-serif-luxury { font-family: 'Cinzel', serif; }
        .font-sans-luxury { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Custom Scrollbar for Luxury Aesthetics */
        .custom-sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .custom-sidebar-scroll::-webkit-scrollbar-track {
            background: #29211F;
        }
        .custom-sidebar-scroll::-webkit-scrollbar-thumb {
            background: #C49A45;
            border-radius: 4px;
        }

        /* HARDENED ADMIN SHELL LAYOUT RULES (PREVENTS ANY SIDEBAR OVERLAP) */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            height: 100vh;
            box-sizing: border-box;
            z-index: 50;
        }

        @media (min-width: 1024px) {
            .admin-main {
                margin-left: 260px !important;
                width: calc(100% - 260px) !important;
                min-width: 0;
                min-height: 100vh;
                box-sizing: border-box;
            }
        }

        @media (max-width: 1023.98px) {
            .admin-main {
                margin-left: 0 !important;
                width: 100% !important;
                min-width: 0;
                min-height: 100vh;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-[#F7F0E3] text-[#29211F] font-sans-luxury antialiased selection:bg-[#541F1D] selection:text-[#F7F0E3] overflow-x-hidden">

    <div x-data="{ 
        sidebarOpen: false, 
        profileDropdown: false,
        openGroups: {
            bookings: {{ request()->routeIs('admin.appointments.*', 'admin.blocked-slots.*', 'admin.schedule.*', 'admin.payments.*') ? 'true' : 'true' }},
            astrology: {{ request()->routeIs('admin.services.*', 'admin.horoscopes.*') ? 'true' : 'false' }},
            content: {{ request()->routeIs('admin.pages.*', 'admin.blogs.*', 'admin.media.*', 'admin.testimonials.*', 'admin.faqs.*', 'admin.inquiries.*') ? 'true' : 'false' }},
            config: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }},
            admin: {{ request()->routeIs('admin.users.*', 'admin.profile.*', 'admin.settings.sidebar*', 'admin.settings.backup*') ? 'true' : 'true' }}
        },
        toggleGroup(group) {
            this.openGroups[group] = !this.openGroups[group];
        }
    }" class="min-h-screen relative w-full overflow-x-hidden">

        <!-- Mobile Drawer Overlay Backdrop -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black/60 lg:hidden"
             @click="sidebarOpen = false" 
             style="display: none;"></div>

        <!-- LEFT SIDEBAR NAVIGATION (FIXED 260px DESKTOP) -->
        <aside class="admin-sidebar fixed inset-y-0 left-0 z-50 w-[260px] bg-[#351211] text-[#F7F0E3] border-r border-[#D8C6A8]/20 flex flex-col justify-between transition-transform duration-300 lg:translate-x-0 custom-sidebar-scroll overflow-y-auto"
               :class="sidebarOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full lg:translate-x-0'">

            <div>
                <!-- Brand Header -->
                <div class="p-4 text-center border-b border-[#D8C6A8]/15 bg-[#29211F]/60 relative">
                    <!-- Mobile Close Button -->
                    <button type="button" 
                            @click="sidebarOpen = false" 
                            class="lg:hidden absolute top-3 right-3 text-[#EDE3D4]/70 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors"
                            aria-label="Close navigation sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="inline-block transition-transform hover:scale-[1.02]">
                        <img src="{{ asset('images/astrotamal-logo.png') }}" alt="Ganesha Astro Consultancy" class="h-10 w-auto mx-auto object-contain drop-shadow-md">
                    </a>
                    <div class="mt-1.5 text-[10px] font-bold tracking-[0.18em] text-[#C49A45] uppercase">
                        TAMAL CHAKRABORTY
                    </div>
                    <div class="text-[8.5px] font-medium tracking-wider text-[#EDE3D4]/60 uppercase">
                        ASTROLOGY & VASTU EXPERT
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-3.5 space-y-3">

                    <!-- SECTION 1: MAIN MENU -->
                    @if(\App\Services\SidebarMenuService::isGroupVisible('dashboard'))
                        @if(\App\Services\SidebarMenuService::isItemVisible('dashboard', 'main'))
                            <div>
                                <div class="px-3 pb-1.5 text-[9px] font-extrabold tracking-[0.18em] text-[#C49A45]/80 uppercase">
                                    MAIN MENU
                                </div>
                                <a href="{{ route('admin.dashboard') }}" 
                                   @click="sidebarOpen = false"
                                   class="flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard*') ? 'bg-[#541F1D] text-[#F7F0E3] shadow-md border border-[#C49A45]/40 font-bold' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                    <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                            </div>
                        @endif
                    @endif

                    <!-- SECTION 2: BOOKINGS & REVENUE -->
                    @if(\App\Services\SidebarMenuService::isGroupVisible('bookings'))
                        <div>
                            <button type="button" 
                                    @click="toggleGroup('bookings')" 
                                    :aria-expanded="openGroups.bookings"
                                    class="w-full flex items-center justify-between px-3 py-1.5 text-[9px] font-extrabold tracking-[0.18em] text-[#C49A45]/80 uppercase hover:text-[#C49A45] transition-colors focus:outline-none">
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-[#C49A45]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    BOOKINGS & REVENUE
                                </span>
                                <svg class="w-3.5 h-3.5 text-[#C49A45]/70 transition-transform duration-200" :class="openGroups.bookings ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <div x-show="openGroups.bookings" x-collapse class="mt-1 space-y-1 pl-1">
                                @if(\App\Services\SidebarMenuService::isItemVisible('bookings', 'appointments'))
                                    <!-- Appointments -->
                                    <a href="{{ route('admin.appointments.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.appointments*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Appointments</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('bookings', 'blocked_slots'))
                                    <!-- Blocked Dates & Slots -->
                                    <a href="{{ route('admin.blocked-slots.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.blocked-slots*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                        <span>Blocked Dates & Slots</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('bookings', 'booking_schedule'))
                                    <!-- Booking Schedule -->
                                    <a href="{{ route('admin.schedule.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.schedule*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Booking Schedule</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('bookings', 'payments'))
                                    <!-- Payments & Transactions -->
                                    <a href="{{ route('admin.payments.transactions') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.payments.transactions*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Payments & Transactions</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('bookings', 'payment_settings'))
                                    <!-- Payment Gateway Settings -->
                                    <a href="{{ route('admin.payments.settings') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.payments.settings*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>Payment Gateway Settings</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- SECTION 3: ASTROLOGY SERVICES -->
                    @if(\App\Services\SidebarMenuService::isGroupVisible('astrology'))
                        <div>
                            <button type="button" 
                                    @click="toggleGroup('astrology')" 
                                    :aria-expanded="openGroups.astrology"
                                    class="w-full flex items-center justify-between px-3 py-1.5 text-[9px] font-extrabold tracking-[0.18em] text-[#C49A45]/80 uppercase hover:text-[#C49A45] transition-colors focus:outline-none">
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-[#C49A45]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    ASTROLOGY SERVICES
                                </span>
                                <svg class="w-3.5 h-3.5 text-[#C49A45]/70 transition-transform duration-200" :class="openGroups.astrology ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <div x-show="openGroups.astrology" x-collapse class="mt-1 space-y-1 pl-1">
                                @if(\App\Services\SidebarMenuService::isItemVisible('astrology', 'services'))
                                    <!-- Services Management -->
                                    <a href="{{ route('admin.services.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.services*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                        </svg>
                                        <span>Services Management</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('astrology', 'horoscopes'))
                                    <!-- Horoscope Management -->
                                    <a href="{{ route('admin.horoscopes.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.horoscopes.index') && !request('period_type') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        <span>Horoscope Management</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('astrology', 'daily_horoscope'))
                                    <!-- Daily Horoscope -->
                                    <a href="{{ route('admin.horoscopes.index', ['period_type' => 'daily']) }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request('period_type') == 'daily' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m14.485-6.485l-1.414 1.414M6.929 17.071l-1.414 1.414m12.728 0l-1.414-1.414M6.929 6.929L5.515 5.515"/>
                                        </svg>
                                        <span>Daily Horoscope</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('astrology', 'weekly_horoscope'))
                                    <!-- Weekly / Monthly / Yearly Horoscope -->
                                    <a href="{{ route('admin.horoscopes.index', ['period_type' => 'weekly']) }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ in_array(request('period_type'), ['weekly', 'monthly', 'yearly']) ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Weekly / Monthly / Yearly</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('astrology', 'zodiac_signs'))
                                    <!-- Zodiac Signs -->
                                    <a href="{{ route('admin.horoscopes.signs') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.horoscopes.signs*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                        </svg>
                                        <span>Zodiac Signs</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- SECTION 4: WEBSITE CONTENT -->
                    @if(\App\Services\SidebarMenuService::isGroupVisible('content'))
                        <div>
                            <button type="button" 
                                    @click="toggleGroup('content')" 
                                    :aria-expanded="openGroups.content"
                                    class="w-full flex items-center justify-between px-3 py-1.5 text-[9px] font-extrabold tracking-[0.18em] text-[#C49A45]/80 uppercase hover:text-[#C49A45] transition-colors focus:outline-none">
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-[#C49A45]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    WEBSITE CONTENT
                                </span>
                                <svg class="w-3.5 h-3.5 text-[#C49A45]/70 transition-transform duration-200" :class="openGroups.content ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <div x-show="openGroups.content" x-collapse class="mt-1 space-y-1 pl-1">
                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'page_manager'))
                                    <!-- Page & Section Manager -->
                                    <a href="{{ route('admin.pages.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.pages.index') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                        </svg>
                                        <span>Page & Section Manager</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'homepage'))
                                    <!-- Homepage Editor -->
                                    <a href="{{ route('admin.homepage.edit') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.homepage.*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        <span>Home Page Management</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'about_page'))
                                    <!-- About Page Editor -->
                                    <a href="{{ route('admin.pages.edit', 'about') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.pages.edit') && request('slug') == 'about' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span>About Page Editor</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'services_page'))
                                    <!-- Services Page Editor -->
                                    <a href="{{ route('admin.services-page.edit') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.services-page.*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span>Services Page Editor</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'shop'))
                                    <!-- Shop Management -->
                                    <a href="{{ route('admin.shop.edit') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.shop.*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z"/>
                                        </svg>
                                        <span>Shop Management</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'blogs'))
                                    <!-- Blog Management -->
                                    <a href="{{ route('admin.blogs.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.blogs*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                        <span>Blog Management</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'media'))
                                    <!-- Gallery & Videos -->
                                    <a href="{{ route('admin.media.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.media*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Gallery & Videos</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'testimonials'))
                                    <!-- Testimonials -->
                                    <a href="{{ route('admin.testimonials.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.testimonials*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        <span>Testimonials</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'faqs'))
                                    <!-- FAQs -->
                                    <a href="{{ route('admin.faqs.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.faqs*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>FAQs</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('content', 'inquiries'))
                                    <!-- Contact Inquiries -->
                                    <a href="{{ route('admin.inquiries.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.inquiries*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Contact Inquiries</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- SECTION 5: WEBSITE CONFIGURATION -->
                    @if(\App\Services\SidebarMenuService::isGroupVisible('config'))
                        <div>
                            <button type="button" 
                                    @click="toggleGroup('config')" 
                                    :aria-expanded="openGroups.config"
                                    class="w-full flex items-center justify-between px-3 py-1.5 text-[9px] font-extrabold tracking-[0.18em] text-[#C49A45]/80 uppercase hover:text-[#C49A45] transition-colors focus:outline-none">
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-[#C49A45]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                    WEBSITE CONFIGURATION
                                </span>
                                <svg class="w-3.5 h-3.5 text-[#C49A45]/70 transition-transform duration-200" :class="openGroups.config ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <div x-show="openGroups.config" x-collapse class="mt-1 space-y-1 pl-1">
                                @if(\App\Services\SidebarMenuService::isItemVisible('config', 'header'))
                                    <!-- Header & Navigation -->
                                    <a href="{{ route('admin.settings.header') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.settings.header') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                        </svg>
                                        <span>Header & Navigation</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('config', 'footer'))
                                    <!-- Footer Manager -->
                                    <a href="{{ route('admin.settings.footer') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.settings.footer') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span>Footer Manager</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('config', 'general'))
                                    <!-- General Website Settings -->
                                    <a href="{{ route('admin.settings.general') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.settings.general') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        </svg>
                                        <span>General Settings</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('config', 'seo'))
                                    <!-- SEO Settings -->
                                    <a href="{{ route('admin.settings.seo') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.settings.seo') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                        <span>SEO Settings</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- SECTION 6: ADMINISTRATION -->
                    @if(\App\Services\SidebarMenuService::isGroupVisible('admin'))
                        <div>
                            <button type="button" 
                                    @click="toggleGroup('admin')" 
                                    :aria-expanded="openGroups.admin"
                                    class="w-full flex items-center justify-between px-3 py-1.5 text-[9px] font-extrabold tracking-[0.18em] text-[#C49A45]/80 uppercase hover:text-[#C49A45] transition-colors focus:outline-none">
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-[#C49A45]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    ADMINISTRATION
                                </span>
                                <svg class="w-3.5 h-3.5 text-[#C49A45]/70 transition-transform duration-200" :class="openGroups.admin ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <div x-show="openGroups.admin" x-collapse class="mt-1 space-y-1 pl-1">
                                @if(\App\Services\SidebarMenuService::isItemVisible('admin', 'users'))
                                    <!-- Admin Users -->
                                    <a href="{{ route('admin.users.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.users*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        <span>Admin Users</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('admin', 'profile'))
                                    <!-- My Profile & Security -->
                                    <a href="{{ route('admin.profile.edit') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.profile*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        <span>My Profile & Security</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('admin', 'sidebar_settings'))
                                    <!-- Sidebar Menu Settings -->
                                    <a href="{{ route('admin.settings.sidebar') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.settings.sidebar*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                        </svg>
                                        <span>Sidebar Menu Visibility</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('admin', 'backups'))
                                    <!-- Backup & Restore -->
                                    <a href="{{ route('admin.settings.backup.index') }}" 
                                       @click="sidebarOpen = false"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium transition-all {{ request()->routeIs('admin.settings.backup*') ? 'bg-[#541F1D] text-[#F7F0E3] font-bold border border-[#C49A45]/40 shadow-xs' : 'text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3]' }}">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                        </svg>
                                        <span>Backup & Restore</span>
                                    </a>
                                @endif

                                @if(\App\Services\SidebarMenuService::isItemVisible('admin', 'view_website'))
                                    <!-- View Live Website -->
                                    <a href="{{ route('home') }}" 
                                       target="_blank"
                                       class="flex items-center px-3 py-2 rounded-xl text-xs font-medium text-[#EDE3D4]/80 hover:bg-[#541F1D]/50 hover:text-[#F7F0E3] transition-all group">
                                        <svg class="w-4 h-4 mr-2.5 text-[#C49A45] group-hover:scale-110 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        <span>View Live Website</span>
                                    </a>
                                @endif

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('admin.logout') }}" class="w-full pt-1">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full flex items-center px-3 py-2 rounded-xl text-xs font-bold text-red-300 hover:bg-red-950/40 hover:text-red-200 border border-red-900/30 transition-all">
                                        <svg class="w-4 h-4 mr-2.5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                </nav>
            </div>

            <!-- Bottom Website Link Footer -->
            <div class="p-3 border-t border-[#D8C6A8]/15 bg-[#29211F]/50 text-center">
                <div class="text-[9.5px] font-semibold text-[#EDE3D4]/50">
                    ASTROTAMAL ADMIN v1.0
                </div>
            </div>
        </aside>

        <!-- MAIN APPLICATION WRAPPER (EXPLICIT 260px DESKTOP OFFSET) -->
        <main class="admin-main bg-[#F7F0E3] flex flex-col min-w-0 overflow-x-hidden">
            
            <!-- STICKY TOPBAR HEADER -->
            <header class="sticky top-0 z-30 bg-[#FDFBF7] border-b border-[#D8C6A8] py-3 px-4 sm:px-6 flex items-center justify-between shadow-xs w-full">
                
                <!-- Left Header: Mobile Toggle & Search Bar -->
                <div class="flex items-center space-x-3 flex-1 max-w-sm sm:max-w-md">
                    <button type="button" 
                            @click="sidebarOpen = true"
                            class="lg:hidden p-1.5 rounded-xl text-[#541F1D] hover:bg-[#EDE3D4]/50 focus:outline-none"
                            aria-label="Open Navigation Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Search Input -->
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#81766D]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" 
                               placeholder="Search anything..." 
                               class="w-full pl-8 pr-4 py-1.5 text-xs sm:text-sm bg-[#EDE3D4]/40 border border-[#D8C6A8]/70 rounded-full text-[#29211F] placeholder-[#81766D] focus:outline-none focus:bg-[#FDFBF7] focus:border-[#C49A45] transition-all">
                    </div>
                </div>

                <!-- Right Header: Notifications & User Profile -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    
                    <!-- Notification Bell Icon -->
                    <button type="button" class="relative p-1.5 text-[#541F1D] hover:bg-[#EDE3D4]/50 rounded-full transition-colors" title="Notifications">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-[#C49A45] ring-2 ring-[#FDFBF7]"></span>
                    </button>

                    <!-- User Profile Dropdown Menu -->
                    <div class="relative" @click.away="profileDropdown = false">
                        <button type="button" 
                                @click="profileDropdown = !profileDropdown"
                                class="flex items-center space-x-2.5 p-1 rounded-full hover:bg-[#EDE3D4]/50 transition-colors focus:outline-none"
                                aria-expanded="false">
                            <div class="w-8 h-8 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center font-bold text-xs shadow-xs border border-[#C49A45]/40">
                                {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline-block text-xs font-bold text-[#541F1D]">
                                {{ auth()->user()->name ?? 'Admin User' }}
                            </span>
                            <svg class="w-3.5 h-3.5 text-[#81766D] hidden sm:inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Profile Dropdown Content -->
                        <div x-show="profileDropdown" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl shadow-xl py-2 z-50 divide-y divide-[#D8C6A8]/40"
                             style="display: none;">
                            
                            <div class="px-4 py-2">
                                <p class="text-xs font-bold text-[#541F1D]">{{ auth()->user()->name ?? 'Administrator' }}</p>
                                <p class="text-[10px] text-[#81766D] truncate">{{ auth()->user()->email ?? 'admin@astrotamal.com' }}</p>
                            </div>

                            <div class="py-1">
                                <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-xs text-[#29211F] hover:bg-[#EDE3D4]/50 transition-colors">
                                    My Profile & Security
                                </a>
                                <a href="{{ route('admin.settings.general') }}" class="block px-4 py-2 text-xs text-[#29211F] hover:bg-[#EDE3D4]/50 transition-colors">
                                    Website Settings
                                </a>
                            </div>

                            <div class="py-1">
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-xs font-bold text-red-700 hover:bg-red-50 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </header>

            <!-- BREADCRUMB & PAGE HEADER BAR -->
            <div class="bg-[#FDFBF7]/60 border-b border-[#D8C6A8]/60 py-4 px-4 sm:px-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h1 class="font-serif-luxury text-xl sm:text-2xl font-bold tracking-tight text-[#541F1D]">
                            @yield('header_title', 'Dashboard')
                        </h1>
                        <p class="text-xs text-[#81766D] font-normal mt-0.5">
                            @yield('header_subtitle', 'Manage AstroTamal Consultancy operations and website content')
                        </p>
                    </div>

                    @yield('header_actions')
                </div>
            </div>

            <!-- MAIN PAGE CONTENT CONTAINER -->
            <div class="p-4 sm:p-6 lg:p-8 flex-1">
                @yield('content')
            </div>

            <!-- ADMIN FOOTER -->
            <footer class="bg-[#FDFBF7] border-t border-[#D8C6A8] py-4 px-6 text-center text-xs text-[#81766D]">
                <div>&copy; {{ date('Y') }} <strong>Ganesha Astro Consultancy</strong> (Tamal Chakraborty). All Rights Reserved.</div>
            </footer>

        </main>

    </div>

    @stack('scripts')
</body>
</html>
