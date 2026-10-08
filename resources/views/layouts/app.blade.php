<!DOCTYPE html>
<html lang="{{ \App\Models\SiteSetting::get('default_language', 'en') }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @php
        $siteName = \App\Models\SiteSetting::get('site_name', 'Ganesha Astro Consultancy');
        $defaultTitle = \App\Models\SiteSetting::get('default_meta_title', 'Tamal Chakraborty | Best Astrologer in Kolkata | ' . $siteName);
        $defaultDescription = \App\Models\SiteSetting::get('default_meta_description', 'Empowering individuals globally with ancient Vedic wisdom, accurate birth chart readings, and practical spiritual remedies.');
        $defaultKeywords = \App\Models\SiteSetting::get('default_keywords', 'Vedic astrology, Astrologer in Kolkata, Kundli reading, Horoscope, Vastu consultant, Tamal Chakraborty');
        $robotsDirective = \App\Models\SiteSetting::get('robots_directive', 'index, follow');

        $canonicalBaseUrl = \App\Models\SiteSetting::get('canonical_base_url', config('app.url', 'https://astrotamal.com'));
        $defaultOgImage = \App\Models\SiteSetting::get('og_image', 'images/astrotamal-logo.png');
        if (!empty($defaultOgImage) && !str_starts_with($defaultOgImage, 'http://') && !str_starts_with($defaultOgImage, 'https://')) {
            $defaultOgImage = asset(ltrim($defaultOgImage, '/'));
        }

        $twitterCard = \App\Models\SiteSetting::get('twitter_card_type', 'summary_large_image');
        $googleVerification = \App\Models\SiteSetting::get('google_site_verification');
        $bingVerification = \App\Models\SiteSetting::get('bing_site_verification');

        $siteFavicon = \App\Models\SiteSetting::get('site_favicon', 'images/ganesha-logo.png');
        if (!empty($siteFavicon) && !str_starts_with($siteFavicon, 'http://') && !str_starts_with($siteFavicon, 'https://')) {
            $siteFavicon = asset(ltrim($siteFavicon, '/'));
        }

        $jsonLd = \App\Models\SiteSetting::get('json_ld_schema');
    @endphp

    <title>@yield('title', $title ?? $defaultTitle)</title>
    <meta name="description" content="@yield('meta_description', $metaDescription ?? $defaultDescription)">
    <meta name="keywords" content="@yield('keywords', $keywords ?? $defaultKeywords)">
    @if(!empty($robotsDirective))
        <meta name="robots" content="{{ $robotsDirective }}">
    @endif
    <link rel="canonical" href="@yield('canonical', $canonicalUrl ?? url()->current())">

    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title', $title ?? \App\Models\SiteSetting::get('og_title', $defaultTitle)))">
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description', $metaDescription ?? \App\Models\SiteSetting::get('og_description', $defaultDescription)))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('canonical', $canonicalUrl ?? url()->current())">
    <meta property="og:image" content="@yield('og_image', $ogImage ?? $defaultOgImage)">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="{{ $twitterCard }}">
    <meta name="twitter:title" content="@yield('twitter_title', View::yieldContent('og_title', View::yieldContent('title', $title ?? \App\Models\SiteSetting::get('twitter_title', $defaultTitle))))">
    <meta name="twitter:description" content="@yield('twitter_description', View::yieldContent('og_description', View::yieldContent('meta_description', $metaDescription ?? \App\Models\SiteSetting::get('twitter_description', $defaultDescription))))">
    <meta name="twitter:image" content="@yield('twitter_image', $twitterImage ?? View::yieldContent('og_image', $defaultOgImage))">

    <!-- Search Engine Verifications -->
    @if(!empty($googleVerification))
        <meta name="google-site-verification" content="{{ e($googleVerification) }}">
    @endif
    @if(!empty($bingVerification))
        <meta name="msvalidate.01" content="{{ e($bingVerification) }}">
    @endif

    <!-- Favicon / Brand Icon -->
    <link rel="icon" type="image/png" href="{{ $siteFavicon }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(!empty($jsonLd))
        <script type="application/ld+json">
            {!! $jsonLd !!}
        </script>
    @endif

    @stack('styles')
</head>
<body class="bg-[#F3F8F5] text-[#17211D] antialiased selection:bg-[#0B3D2E] selection:text-[#FFFFFF] flex flex-col min-h-screen">

    <!-- Main Navigation Header -->
    <x-header />

    <!-- Main Content Area -->
    <main class="flex-grow pt-[56px] sm:pt-[66px] lg:pt-[74px]">
        @yield('content')
    </main>

    <!-- Global Pre-Footer Component -->
    <x-pre-footer />

    <!-- Site Footer -->
    <x-footer />

    @stack('scripts')
</body>
</html>
