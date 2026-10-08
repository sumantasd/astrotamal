<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Scheduled Maintenance — {{ \App\Models\SiteSetting::get('site_name', 'Ganesha Astro Consultancy') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ganesha-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#06281F] text-[#F7F0E3] font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="max-w-xl w-full bg-[#0B3D2E] border border-[#C49A45]/40 rounded-3xl p-8 sm:p-12 shadow-2xl text-center space-y-6 relative overflow-hidden">
        
        <!-- Subtle Glow -->
        <div class="absolute -top-24 -left-24 w-48 h-48 bg-[#C49A45]/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-[#C49A45]/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Logo / Icon -->
        <div class="flex justify-center">
            <div class="w-20 h-20 rounded-full bg-[#06281F] border-2 border-[#C49A45] p-3 flex items-center justify-center shadow-lg">
                <img src="{{ asset(\App\Models\SiteSetting::get('site_logo', 'images/ganesha-logo.png')) }}" 
                     alt="Logo" 
                     class="max-h-full max-w-full object-contain">
            </div>
        </div>

        <!-- Heading -->
        <div class="space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">SCHEDULED MAINTENANCE</span>
            <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3]">
                We'll Be Back Shortly
            </h1>
        </div>

        <!-- Message -->
        <p class="text-xs sm:text-sm text-[#D8CDBD]/90 leading-relaxed max-w-md mx-auto">
            {{ \App\Models\SiteSetting::get('site_name', 'Ganesha Astro Consultancy') }} is currently undergoing brief scheduled system updates to enhance your experience. We appreciate your patience!
        </p>

        <!-- Direct Action Buttons -->
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
            @php
                $phone = \App\Models\SiteSetting::get('contact_phone', '8392059201');
                $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
                $whatsapp = \App\Models\SiteSetting::get('whatsapp_number', '8392059201');
                $cleanWhatsapp = preg_replace('/[^0-9]/', '', $whatsapp);
            @endphp
            <a href="tel:{{ $cleanPhone }}" 
               class="w-full sm:w-auto px-6 py-3 rounded-full bg-[#145A43] hover:bg-[#06281F] text-white text-xs font-bold transition-all shadow-md border border-[#C49A45]/40">
                📞 Call {{ $phone }}
            </a>
            <a href="https://wa.me/91{{ $cleanWhatsapp }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="w-full sm:w-auto px-6 py-3 rounded-full bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-all shadow-md">
                💬 WhatsApp Consultation
            </a>
        </div>

        <!-- Admin Access Link -->
        <div class="pt-6 border-t border-[#C49A45]/20 text-[11px] text-[#D8CDBD]/60">
            Administrator? <a href="{{ route('admin.login') }}" class="text-[#C49A45] hover:underline font-semibold">Sign in to Admin Panel</a>
        </div>

    </div>

</body>
</html>
