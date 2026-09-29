@extends('layouts.app')

@section('title', $appointment->payment_status === 'Paid' ? 'Booking Confirmed | Astrologer Tamal Chakraborty' : 'Booking Status | Astrologer Tamal Chakraborty')
@section('meta_description', 'View your official consultation booking receipt and payment status with Ganesha Astro Consultancy.')

@section('content')

@php
    $isPaid = $appointment->payment_status === 'Paid' && $appointment->status === 'Confirmed';
    $isFailed = $appointment->payment_status === 'Failed';
    $isPending = !$isPaid && !$isFailed;
    
    $consultationDate = \Carbon\Carbon::parse($appointment->preferred_date)->setTimezone('Asia/Kolkata');
    $createdDate = \Carbon\Carbon::parse($appointment->created_at)->setTimezone('Asia/Kolkata');
@endphp

<!-- Header Banner -->
<section class="bg-[#F7F0E3] text-[#29211F] py-10 sm:py-12 border-b border-[#D8C6A8] relative overflow-hidden print:hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-3">
        @if($isPaid)
            <div class="w-16 h-16 bg-[#541F1D] text-[#C49A45] rounded-full flex items-center justify-center mx-auto border-2 border-[#C49A45] shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-[#C49A45] uppercase">
                <span>VERIFIED & CONFIRMED</span>
            </div>
            <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold tracking-tight text-[#541F1D]">
                Booking Confirmed!
            </h1>
            <p class="text-[#81766D] text-xs sm:text-sm max-w-xl mx-auto font-normal">
                Thank you, {{ $appointment->name }}. Your 1-on-1 consultation with Astrologer Tamal Chakraborty is officially confirmed.
            </p>
        @elseif($isFailed)
            <div class="w-16 h-16 bg-red-900 text-red-200 rounded-full flex items-center justify-center mx-auto border-2 border-red-700 shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-red-800 uppercase">
                <span>PAYMENT UNVERIFIED / FAILED</span>
            </div>
            <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold tracking-tight text-[#541F1D]">
                Payment Failure
            </h1>
            <p class="text-[#81766D] text-xs sm:text-sm max-w-xl mx-auto font-normal">
                We could not verify your payment for booking reference {{ $appointment->booking_reference }}. Please try again.
            </p>
        @else
            <div class="w-16 h-16 bg-amber-800 text-amber-200 rounded-full flex items-center justify-center mx-auto border-2 border-amber-600 shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-amber-800 uppercase">
                <span>PAYMENT PENDING</span>
            </div>
            <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold tracking-tight text-[#541F1D]">
                Complete Your Payment
            </h1>
            <p class="text-[#81766D] text-xs sm:text-sm max-w-xl mx-auto font-normal">
                Your consultation slot is temporarily reserved. Complete payment to confirm your booking.
            </p>
        @endif
    </div>
</section>

<!-- Confirmation Receipt Section -->
<section class="bg-[#F7F0E3] py-10 lg:py-16 print:py-0 print:bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 print:px-0 print:max-w-full">

        <div class="bg-[#FDFBF7] border-2 border-[#C49A45] rounded-2xl p-6 sm:p-10 space-y-8 shadow-xl relative print:border-none print:shadow-none print:p-0">

            <!-- Official Stamp / Badge -->
            <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-6">
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-widest text-[#C49A45]">GANESHA ASTRO CONSULTANCY</span>
                    <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#541F1D]">Consultation Booking Receipt</h2>
                    <span class="text-xs text-[#81766D] block mt-0.5">Vedic Astrologer Tamal Chakraborty</span>
                </div>
                <div class="text-right">
                    <span class="text-xs text-[#81766D] block mb-1">Status</span>
                    @if($isPaid)
                        <span class="px-3 py-1.5 bg-[#351211] text-[#F7F0E3] border border-[#C49A45] text-xs font-bold rounded-full uppercase tracking-wider shadow-xs">
                            ✓ CONFIRMED & PAID
                        </span>
                    @elseif($isFailed)
                        <span class="px-3 py-1.5 bg-red-900 text-white border border-red-700 text-xs font-bold rounded-full uppercase tracking-wider">
                            ✕ PAYMENT FAILED
                        </span>
                    @else
                        <span class="px-3 py-1.5 bg-amber-800 text-amber-100 border border-amber-600 text-xs font-bold rounded-full uppercase tracking-wider">
                            ⏳ PENDING PAYMENT
                        </span>
                    @endif
                </div>
            </div>

            <!-- Receipt Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                
                <div class="bg-[#EDE3D4] p-4 rounded-xl border border-[#D8C6A8] space-y-1">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">BOOKING REFERENCE</span>
                    <span class="font-mono text-base font-bold text-[#541F1D]">{{ $appointment->booking_reference }}</span>
                </div>

                <div class="bg-[#EDE3D4] p-4 rounded-xl border border-[#D8C6A8] space-y-1">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">PAYMENT TRANSACTION ID</span>
                    <span class="font-mono text-xs font-bold text-[#541F1D] truncate block">
                        {{ $isPaid ? ($appointment->payment_reference ?? 'VERIFIED_ONLINE') : 'UNPAID / PENDING' }}
                    </span>
                </div>

                <div class="bg-[#FDFBF7] p-4 rounded-xl border border-[#D8C6A8] space-y-1">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">CONSULTATION DATE (ASIA/KOLKATA)</span>
                    <span class="font-bold text-[#541F1D] text-sm">📅 {{ $consultationDate->format('l, d F Y') }}</span>
                </div>

                <div class="bg-[#FDFBF7] p-4 rounded-xl border border-[#D8C6A8] space-y-1">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">EXACT TIME SLOT</span>
                    <span class="font-bold text-[#541F1D] text-sm">⏰ {{ $appointment->preferred_time }}</span>
                </div>

                <div class="bg-[#FDFBF7] p-4 rounded-xl border border-[#D8C6A8] space-y-1">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">CONSULTATION TYPE & MODE</span>
                    <span class="font-bold text-[#541F1D] text-sm">⚡ {{ $appointment->consultation_type }} Consultation (1-on-1 Audio)</span>
                </div>

                <div class="bg-[#FDFBF7] p-4 rounded-xl border border-[#D8C6A8] space-y-1">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#81766D]">VERIFIED AMOUNT PAID</span>
                    <span class="font-bold text-[#541F1D] text-base">₹{{ number_format($appointment->amount, 2) }} INR</span>
                </div>

            </div>

            <!-- Client Info & Birth Details -->
            <div class="bg-[#EDE3D4]/70 p-5 rounded-xl border border-[#D8C6A8] space-y-3 text-xs">
                <h3 class="font-serif-luxury font-bold text-[#541F1D] text-sm uppercase tracking-wider border-b border-[#D8C6A8] pb-2">
                    Client Information & Birth Details
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-[#541F1D]">
                    <div>
                        <span class="block text-[10px] text-[#81766D] uppercase font-bold">Client Name</span>
                        <span class="font-semibold text-sm">{{ $appointment->name }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-[#81766D] uppercase font-bold">Mobile Number</span>
                        <span class="font-semibold text-sm">{{ $appointment->phone }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-[#81766D] uppercase font-bold">Date of Birth</span>
                        <span class="font-semibold text-sm">{{ $appointment->birth_date ? \Carbon\Carbon::parse($appointment->birth_date)->format('d M Y') : 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-[#81766D] uppercase font-bold">Time of Birth</span>
                        <span class="font-semibold text-sm">
                            @if($appointment->birth_time)
                                {{ \Carbon\Carbon::parse($appointment->birth_time)->format('h:i A') }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-[#81766D] uppercase font-bold">Place of Birth</span>
                        <span class="font-semibold text-sm">{{ $appointment->birth_place ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-[#81766D] uppercase font-bold">Booking Created</span>
                        <span class="font-semibold text-sm">{{ $createdDate->format('d M Y, h:i A') }}</span>
                    </div>
                </div>
            </div>

            @if($isPaid)
                <!-- What Happens Next Instructions -->
                <div class="bg-[#541F1D] text-[#F7F0E3] p-6 rounded-xl border border-[#D8C6A8] space-y-3 print:bg-white print:text-black print:border-black">
                    <h3 class="font-serif-luxury text-base font-bold text-[#C49A45] print:text-black flex items-center space-x-2">
                        <span>📞</span>
                        <span>What Happens Next?</span>
                    </h3>
                    <ul class="text-xs space-y-2 leading-relaxed opacity-95 list-disc list-inside">
                        <li>Our desk team will initiate a 1-on-1 Audio Call on your mobile number (<strong>{{ $appointment->phone }}</strong>) at your scheduled slot.</li>
                        <li>Please keep your birth details and specific queries ready prior to your consultation time.</li>
                        <li>For any assistance or scheduling query regarding booking <strong>{{ $appointment->booking_reference }}</strong>, call support at <strong>+91 8392059201</strong>.</li>
                    </ul>
                </div>

                <!-- Action Buttons (Download PDF, Print, Return) -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-[#D8C6A8] print:hidden">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] border border-[#D8C6A8] rounded-full text-center hover:bg-[#D8C6A8] transition-colors">
                        ← Return to Homepage
                    </a>

                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                        <a href="{{ route('consultation.receipt.pdf', ['reference' => $appointment->booking_reference]) }}" class="w-full sm:w-auto px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#C49A45] hover:bg-[#a37c30] rounded-full text-center shadow-sm flex items-center justify-center space-x-2 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Download Receipt (PDF)</span>
                        </a>

                        <button onclick="window.print()" class="w-full sm:w-auto px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-full text-center shadow-sm flex items-center justify-center space-x-2 transition-colors">
                            <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            <span>Print Receipt</span>
                        </button>
                    </div>
                </div>
            @else
                <!-- Pending or Failed Retry Action Box -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-[#D8C6A8] print:hidden">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] border border-[#D8C6A8] rounded-full text-center hover:bg-[#D8C6A8] transition-colors">
                        ← Return Home
                    </a>

                    <a href="{{ route('consultation.checkout', ['reference' => $appointment->booking_reference]) }}" class="w-full sm:w-auto px-8 py-3.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-full text-center shadow-md border border-[#C49A45] flex items-center justify-center space-x-2 transition-colors">
                        <span>Complete / Retry Payment — ₹{{ number_format($appointment->amount, 0) }}</span>
                        <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            @endif

        </div>

    </div>
</section>

<!-- Print Specific Styles -->
<style type="text/css" media="print">
    @page {
        size: A4 portrait;
        margin: 1.5cm;
    }
    nav, footer, .print\:hidden, header {
        display: none !important;
    }
    body {
        background: #ffffff !important;
        color: #000000 !important;
        font-size: 12pt;
    }
</style>

@endsection
