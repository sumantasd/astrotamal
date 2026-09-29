@extends('layouts.app')

@section('title', 'Complete Payment | Astrologer Tamal Chakraborty')
@section('meta_description', 'Secure payment gateway checkout for your Vedic Astrology consultation with Tamal Chakraborty.')

@section('content')

<!-- Header Banner -->
<section class="bg-[#F7F0E3] text-[#29211F] py-8 sm:py-10 border-b border-[#D8C6A8] relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-2">
        <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-[#C49A45] uppercase">
            <span class="w-2 h-2 rounded-full bg-[#C49A45] animate-pulse"></span>
            <span>SECURE PAYMENT CHECKOUT</span>
        </div>
        <h1 class="font-serif-luxury text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-[#541F1D]">
            Complete Your Consultation Booking
        </h1>
        <p class="text-[#81766D] text-xs sm:text-sm max-w-xl mx-auto font-normal">
            Your appointment slot is reserved. Please complete the payment to receive instant booking confirmation.
        </p>
    </div>
</section>

<!-- Checkout Section -->
<section class="bg-[#F7F0E3] py-10 lg:py-14">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-900/10 border border-red-800/30 text-red-900 text-xs sm:text-sm font-medium flex items-center space-x-3">
                <svg class="w-5 h-5 text-red-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($isExpired)
            <div class="p-8 bg-[#EDE3D4] border-2 border-amber-600/40 rounded-2xl text-center space-y-4 shadow-sm">
                <div class="w-12 h-12 bg-amber-100 text-amber-800 rounded-full flex items-center justify-center mx-auto text-xl font-bold">⏱️</div>
                <h2 class="font-serif-luxury text-xl font-bold text-[#541F1D]">Slot Reservation Expired</h2>
                <p class="text-xs text-[#81766D] max-w-md mx-auto leading-relaxed">
                    The 15-minute slot reservation for booking <strong>{{ $appointment->booking_reference }}</strong> has expired. Please select a new date & time slot.
                </p>
                <a href="{{ route('consultation.book') }}" class="inline-block px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] rounded-full hover:bg-[#351211] transition-all">
                    Return to Booking Page
                </a>
            </div>
        @else

            <!-- Main Order & Summary Card -->
            <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-md">

                <!-- Countdown Bar -->
                <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl p-3.5 flex items-center justify-between text-xs text-[#541F1D]">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-[#C49A45] animate-ping"></span>
                        <span class="font-semibold">Slot Held Exclusively For You</span>
                    </div>
                    <div class="font-mono font-bold text-sm text-[#541F1D]" id="timerCountdown">
                        14:59
                    </div>
                </div>

                <!-- Booking Reference & Details -->
                <div class="border-b border-[#D8C6A8] pb-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-[#81766D] font-bold uppercase tracking-wider">BOOKING REFERENCE</span>
                        <span class="font-mono text-sm font-bold text-[#541F1D] bg-[#EDE3D4] px-3 py-1 rounded-lg border border-[#D8C6A8]">
                            {{ $appointment->booking_reference }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div class="bg-[#FDFBF7] p-4 rounded-xl border border-[#D8C6A8]">
                            <span class="block text-[10px] font-bold uppercase text-[#81766D] mb-1">CLIENT NAME</span>
                            <span class="font-bold text-[#541F1D] text-sm">{{ $appointment->name }}</span>
                            <span class="block text-[11px] text-[#81766D] mt-0.5">📞 {{ $appointment->phone }}</span>
                        </div>

                        <div class="bg-[#FDFBF7] p-4 rounded-xl border border-[#D8C6A8]">
                            <span class="block text-[10px] font-bold uppercase text-[#81766D] mb-1">APPOINTMENT SLOT</span>
                            <span class="font-bold text-[#541F1D] text-sm">📅 {{ \Carbon\Carbon::parse($appointment->preferred_date)->format('D, d M Y') }}</span>
                            <span class="block text-[11px] text-[#81766D] mt-0.5">⏰ {{ $appointment->preferred_time }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between bg-[#FDFBF7] p-4 rounded-xl border border-[#D8C6A8] text-xs">
                        <div>
                            <span class="block font-bold text-[#541F1D]">{{ $appointment->consultation_type }} Consultation</span>
                            <span class="text-[11px] text-[#81766D]">1-on-1 Audio Call with Tamal Chakraborty</span>
                        </div>
                        <span class="px-2.5 py-1 bg-[#541F1D] text-[#F7F0E3] text-[10px] font-bold rounded-md uppercase tracking-wider">
                            {{ $appointment->consultation_mode }}
                        </span>
                    </div>
                </div>

                <!-- Payable Amount Summary -->
                <div class="space-y-2 pt-2">
                    <div class="flex items-center justify-between text-xs text-[#81766D]">
                        <span>Consultation Fee</span>
                        <span>₹{{ number_format($appointment->amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-[#81766D]">
                        <span>GST & Service Charges</span>
                        <span class="text-emerald-700 font-semibold">Included</span>
                    </div>
                    <div class="border-t border-[#D8C6A8] pt-3 flex items-center justify-between">
                        <span class="font-serif-luxury text-base font-bold text-[#541F1D]">TOTAL PAYABLE</span>
                        <span class="font-serif-luxury text-3xl font-bold text-[#541F1D]">₹{{ number_format($appointment->amount, 0) }}</span>
                    </div>
                </div>

                <!-- Payment Form Action -->
                <form action="{{ route('consultation.payment.verify') }}" method="POST" id="paymentVerifyForm">
                    @csrf
                    <input type="hidden" name="booking_reference" value="{{ $appointment->booking_reference }}">
                    <input type="hidden" name="payment_id" id="payment_id" value="PAY_SIM_{{ strtoupper(\Illuminate\Support\Str::random(10)) }}">
                    <input type="hidden" name="order_id" id="order_id" value="ORD_{{ strtoupper(\Illuminate\Support\Str::random(10)) }}">
                    <input type="hidden" name="gateway" value="Razorpay">
                    <input type="hidden" name="signature" id="signature" value="">

                    <div class="space-y-4 pt-4">
                        <button type="submit" 
                                id="payButton"
                                class="w-full py-4 px-6 text-sm font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-full shadow-lg border border-[#D8C6A8] hover:border-[#C49A45] transition-all flex items-center justify-center space-x-2">
                            <span>🔒 PAY ₹{{ number_format($appointment->amount, 0) }} & CONFIRM BOOKING</span>
                        </button>

                        <p class="text-center text-[11px] text-[#81766D] flex items-center justify-center space-x-1">
                            <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Encrypted 256-bit SSL Payment Gateway</span>
                        </p>
                    </div>
                </form>

            </div>

        @endif

    </div>
</section>

@endsection

@push('scripts')
<script>
@if(!$isExpired && $appointment->slot_reserved_until)
    // Countdown Timer Logic
    const expiryTime = new Date("{{ \Carbon\Carbon::parse($appointment->slot_reserved_until)->toIso8601String() }}").getTime();
    
    const timerInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = expiryTime - now;
        
        if (distance < 0) {
            clearInterval(timerInterval);
            document.getElementById("timerCountdown").innerHTML = "EXPIRED";
            window.location.reload();
            return;
        }
        
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById("timerCountdown").innerHTML = 
            (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds);
    }, 1000);
@endif
</script>
@endpush
