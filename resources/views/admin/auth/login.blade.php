<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F7F0E3]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Sign In | Ganesha Astro Consultancy</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif-luxury { font-family: 'Cinzel', serif; }
        .font-sans-luxury { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full font-sans-luxury bg-[#F7F0E3] text-[#29211F] antialiased selection:bg-[#541F1D] selection:text-[#F7F0E3] flex items-center justify-center p-4 sm:p-6 relative overflow-x-hidden">

    <!-- Background Subtle Temple Glow & Zodiac Watermark -->
    <div class="fixed inset-0 bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-[#C49A45]/15 via-[#F7F0E3] to-[#EDE3D4] pointer-events-none"></div>

    <div class="w-full max-w-4xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-8 relative z-10 py-4">

        <!-- LEFT BRANDING PANEL -->
        <div class="w-full lg:w-[50%] hidden lg:flex flex-col justify-between space-y-6 text-center pr-4">
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-[1.01]">
                    <img src="{{ asset('images/astrotamal-logo.png') }}" alt="Ganesha Astro Consultancy" class="h-20 w-auto max-w-[320px] mx-auto object-contain">
                </a>
                <div class="flex items-center justify-center space-x-3 text-xs font-bold tracking-[0.25em] text-[#C49A45] uppercase">
                    <span class="w-10 h-px bg-[#D8C6A8]"></span>
                    <span>GUIDANCE • CLARITY • POSITIVE LIFE</span>
                    <span class="w-10 h-px bg-[#D8C6A8]"></span>
                </div>
            </div>

            <div class="relative py-2 px-6 text-center max-w-md mx-auto">
                <blockquote class="font-serif-luxury italic text-lg text-[#541F1D] leading-relaxed">
                    “Let the divine wisdom light your path to a better tomorrow.”
                </blockquote>
            </div>

            <div class="relative rounded-3xl overflow-hidden border-2 border-[#D8C6A8] shadow-xl bg-[#EDE3D4]/40 max-w-md mx-auto w-full aspect-[4/3]">
                <img src="{{ asset('images/admin-ganesha-hero.jpg') }}" alt="Ganesha Astro Consultancy Devotional Idol" class="w-full h-full object-cover object-top">
            </div>
        </div>

        <!-- RIGHT LOGIN CARD -->
        <div class="w-full lg:w-[50%] max-w-md mx-auto">
            <div class="bg-[#FDFBF7] border-2 border-[#D8C6A8] rounded-3xl p-7 sm:p-9 shadow-2xl relative overflow-hidden">
                
                <div class="text-center space-y-3 mb-6 relative z-10">
                    <a href="{{ route('home') }}" class="inline-block">
                        <img src="{{ asset('images/astrotamal-logo.png') }}" alt="Ganesha Astro Consultancy" class="h-14 w-auto max-w-[240px] mx-auto object-contain">
                    </a>
                    <div>
                        <h1 class="font-serif-luxury text-2xl font-bold text-[#541F1D]">Welcome to AstroTamal Admin</h1>
                        <p class="text-xs text-[#81766D] mt-1">Authorized sign in for administration desk</p>
                    </div>
                </div>

                @if (session('status'))
                    <div class="mb-5 p-3.5 rounded-xl bg-emerald-900/10 border border-emerald-800/30 text-emerald-900 text-xs text-center font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 p-3.5 rounded-xl bg-red-900/10 border border-red-800/30 text-red-900 text-xs font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center space-x-1.5">
                                <span>⚠️</span>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4.5 relative z-10">
                    @csrf

                    <div class="space-y-1.5 text-left">
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#29211F]">
                            Email Address
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               placeholder="admin@example.com" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D]/50 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>

                    <div class="space-y-1.5 text-left">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#29211F]">
                            Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required 
                               placeholder="Enter your password" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D]/50 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>

                    <div class="flex items-center justify-between text-xs pt-0.5">
                        <label class="flex items-center space-x-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" id="remember" class="accent-[#541F1D] w-4 h-4 rounded border-[#D8C6A8]">
                            <span class="text-[#81766D] font-medium">Remember me</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full py-3.5 px-6 text-xs sm:text-sm font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-full shadow-lg border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 flex items-center justify-center space-x-3 group cursor-pointer">
                            <span>Sign In</span>
                            <div class="w-6 h-6 rounded-full bg-[#541F1D] group-hover:bg-[#C49A45] text-[#F7F0E3] flex items-center justify-center transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>

                <div class="mt-7 pt-4 border-t border-[#D8C6A8]/50 text-center text-[11px] font-bold tracking-[0.25em] text-[#81766D] uppercase">
                    OM • SHANTI • SUCCESS
                </div>
            </div>
        </div>

    </div>

</body>
</html>
