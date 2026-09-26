<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tamal Chakraborty — Premium Vedic Astrologer & Spiritual Mentor')</title>
    <meta name="description" content="@yield('meta_description', 'Discover personalized Vedic astrology guidance, Kundli birth chart analysis, career forecasts, relationship matching, and Vastu consultations with Tamal Chakraborty.')">
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="@yield('title', 'Tamal Chakraborty — Premium Vedic Astrologer')">
    <meta property="og:description" content="@yield('meta_description', 'Unlock your divine blueprint with authentic Vedic Astrology.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tamal_hero_portrait.jpg') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-navy-900 text-slate-100 antialiased selection:bg-gold-500 selection:text-navy-950 flex flex-col min-h-screen">

    <!-- Main Navigation Header -->
    <x-header />

    <!-- Main Content Area -->
    <main class="flex-grow pt-[72px] sm:pt-[84px] lg:pt-[96px]">
        @yield('content')
    </main>

    <!-- Global Pre-Footer Component -->
    <x-pre-footer />

    <!-- Site Footer -->
    <x-footer />

    @stack('scripts')
</body>
</html>
