@extends('layouts.app')

@section('title', 'Complete Payment | Astrologer Tamal Chakraborty')
@section('meta_description', 'Secure payment gateway checkout for your Vedic Astrology consultation with Tamal Chakraborty.')

@section('content')

<!-- Header Banner (Dark Green #06281F) -->
<section class="bg-[#06281F] text-[#FFFFFF] py-8 sm:py-10 border-b border-[#145A43] relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-2">
        <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-[#C49A45] uppercase">
            <span class="w-2 h-2 rounded-full bg-[#C49A45] animate-pulse"></span>
            <span>SECURE PAYMENT CHECKOUT</span>
        </div>
        <h1 class="font-serif-luxury text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-[#FFFFFF]">
            Complete Your Consultation Booking
        </h1>
        <p class="text-[#E8F1EC]/90 text-xs sm:text-sm max-w-xl mx-auto font-normal">
            Your appointment slot is reserved. Please complete the payment to receive instant booking confirmation.
        </p>
    </div>
</section>

<!-- Checkout Section (Very Light Green #F3F8F5) -->
<section class="bg-[#F3F8F5] py-10 lg:py-14">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <div id="paymentErrorMessage" class="hidden mb-6"></div>

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-900/10 border border-red-800/30 text-red-900 text-xs sm:text-sm font-medium flex items-center space-x-3">
                <svg class="w-5 h-5 text-red-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($isExpired)
            <div class="p-8 bg-[#FFFFFF] border-2 border-amber-600/40 rounded-2xl text-center space-y-4 shadow-sm">
                <div class="w-12 h-12 bg-amber-100 text-amber-800 rounded-full flex items-center justify-center mx-auto text-xl font-bold">⏱️</div>
                <h2 class="font-serif-luxury text-xl font-bold text-[#0B3D2E]">Slot Reservation Expired</h2>
                <p class="text-xs text-[#60736B] max-w-md mx-auto leading-relaxed">
                    The 15-minute slot reservation for booking <strong>{{ $appointment->booking_reference }}</strong> has expired. Please select a new date & time slot.
                </p>
                <a href="{{ route('consultation.book') }}" class="inline-block px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] rounded-full hover:bg-[#145A43] transition-all">
                    Return to Booking Page
                </a>
            </div>
        @else

            <!-- Main Order & Summary Card -->
            <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-6 sm:p-8 space-y-6 shadow-md">

                <!-- Countdown Bar -->
                <div class="bg-[#E8F1EC] border border-[#C8D8CF] rounded-xl p-3.5 flex items-center justify-between text-xs text-[#0B3D2E]">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-[#C49A45] animate-ping"></span>
                        <span class="font-semibold">Slot Held Exclusively For You</span>
                    </div>
                    <div class="font-mono font-bold text-sm text-[#0B3D2E]" id="timerCountdown">
                        14:59
                    </div>
                </div>

                <!-- Booking Reference & Details -->
                <div class="border-b border-[#C8D8CF] pb-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-[#60736B] font-bold uppercase tracking-wider">BOOKING REFERENCE</span>
                        <span class="font-mono text-sm font-bold text-[#0B3D2E] bg-[#E8F1EC] px-3 py-1 rounded-lg border border-[#C8D8CF]">
                            {{ $appointment->booking_reference }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div class="bg-[#F3F8F5] p-4 rounded-xl border border-[#C8D8CF]">
                            <span class="block text-[10px] font-bold uppercase text-[#60736B] mb-1">CLIENT NAME</span>
                            <span class="font-bold text-[#0B3D2E] text-sm">{{ $appointment->name }}</span>
                            <span class="block text-[11px] text-[#60736B] mt-0.5">📞 {{ $appointment->phone }}</span>
                        </div>

                        <div class="bg-[#F3F8F5] p-4 rounded-xl border border-[#C8D8CF]">
                            <span class="block text-[10px] font-bold uppercase text-[#60736B] mb-1">APPOINTMENT SLOT</span>
                            <span class="font-bold text-[#0B3D2E] text-sm">📅 {{ \Carbon\Carbon::parse($appointment->preferred_date)->format('D, d M Y') }}</span>
                            <span class="block text-[11px] text-[#60736B] mt-0.5">⏰ {{ $appointment->preferred_time }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between bg-[#F3F8F5] p-4 rounded-xl border border-[#C8D8CF] text-xs">
                        <div>
                            <span class="block font-bold text-[#0B3D2E]">{{ $appointment->consultation_type }} Consultation</span>
                            <span class="text-[11px] text-[#60736B]">1-on-1 Audio Call with Tamal Chakraborty</span>
                        </div>
                        <span class="px-2.5 py-1 bg-[#0B3D2E] text-[#FFFFFF] text-[10px] font-bold rounded-md uppercase tracking-wider">
                            {{ $appointment->consultation_mode }}
                        </span>
                    </div>
                </div>

                <!-- Payable Amount Summary -->
                <div class="space-y-2 pt-2">
                    <div class="flex items-center justify-between text-xs text-[#60736B]">
                        <span>Consultation Fee</span>
                        <span>₹{{ number_format($appointment->amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-[#60736B]">
                        <span>GST & Service Charges</span>
                        <span class="text-emerald-700 font-semibold">Included</span>
                    </div>
                    <div class="border-t border-[#C8D8CF] pt-3 flex items-center justify-between">
                        <span class="font-serif-luxury text-base font-bold text-[#0B3D2E]">TOTAL PAYABLE</span>
                        <span class="font-serif-luxury text-3xl font-bold text-[#0B3D2E]">₹{{ number_format($appointment->amount, 0) }}</span>
                    </div>
                </div>

                <!-- Payment Trigger Action -->
                <div class="space-y-4 pt-4">
                    <button type="button" 
                            id="payButton"
                            onclick="initiateRazorpayPayment()"
                            class="w-full py-4 px-6 text-sm font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-full shadow-lg border border-[#0B3D2E] hover:border-[#C49A45] transition-all flex items-center justify-center space-x-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="payButtonText">🔒 PROCEED TO PAYMENT ₹{{ number_format($appointment->amount, 0) }}</span>
                        <svg id="paySpinner" class="hidden animate-spin h-4 w-4 text-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>

                    <p class="text-center text-[11px] text-[#60736B] flex items-center justify-center space-x-1">
                        <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Encrypted 256-bit SSL Razorpay Gateway</span>
                    </p>
                </div>

            </div>

        @endif

    </div>
</section>

@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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

async function initiateRazorpayPayment() {
    const payButton = document.getElementById('payButton');
    const payButtonText = document.getElementById('payButtonText');
    const paySpinner = document.getElementById('paySpinner');

    if (!payButton) return;

    payButton.disabled = true;
    if (paySpinner) paySpinner.classList.remove('hidden');
    if (payButtonText) payButtonText.innerText = 'Initializing Razorpay...';

    const hideError = () => {
        const errorBox = document.getElementById('paymentErrorMessage');
        if (errorBox) errorBox.classList.add('hidden');
    };

    const showError = (msg) => {
        const errorBox = document.getElementById('paymentErrorMessage');
        if (errorBox) {
            errorBox.innerHTML = `
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-medium flex items-center space-x-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>${msg}</span>
                </div>
            `;
            errorBox.classList.remove('hidden');
        }
    };

    hideError();

    try {
        // Step 1: Create Razorpay Order Server-Side
        const response = await fetch("{{ route('consultation.payment.create-order') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                booking_reference: '{{ $appointment->booking_reference }}'
            })
        });

        const data = await response.json();

        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Payment gateway order creation failed. Please try again.');
        }

        // Step 2: Ensure Razorpay SDK is available
        if (typeof Razorpay === 'undefined') {
            throw new Error('Razorpay Payment SDK failed to load. Please check your internet connection.');
        }

        // Step 3: Launch Razorpay Checkout Modal
        const options = {
            key: data.key,
            amount: data.amount,
            currency: data.currency,
            name: data.name,
            description: data.description,
            order_id: data.order_id,
            prefill: data.prefill,
            theme: {
                color: "#0B3D2E"
            },
            handler: async function(razorpayResponse) {
                if (payButtonText) payButtonText.innerText = 'Verifying Payment...';

                try {
                    // Step 4: Verify Payment Signature Server-Side
                    const verifyResponse = await fetch("{{ route('consultation.payment.verify') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            booking_reference: '{{ $appointment->booking_reference }}',
                            payment_id: razorpayResponse.razorpay_payment_id,
                            order_id: razorpayResponse.razorpay_order_id,
                            signature: razorpayResponse.razorpay_signature,
                            gateway: 'Razorpay'
                        })
                    });

                    const verifyData = await verifyResponse.json();

                    if (verifyResponse.ok && verifyData.success) {
                        window.location.href = verifyData.redirect_url;
                    } else {
                        throw new Error(verifyData.message || 'Payment verification failed. Your booking has not been confirmed.');
                    }
                } catch (verifyError) {
                    payButton.disabled = false;
                    if (paySpinner) paySpinner.classList.add('hidden');
                    if (payButtonText) payButtonText.innerText = '🔒 PROCEED TO PAYMENT ₹{{ number_format($appointment->amount, 0) }}';
                    showError(verifyError.message || 'Payment verification failed. Your booking has not been confirmed.');
                }
            },
            modal: {
                ondismiss: function() {
                    payButton.disabled = false;
                    if (paySpinner) paySpinner.classList.add('hidden');
                    if (payButtonText) payButtonText.innerText = '🔒 PROCEED TO PAYMENT ₹{{ number_format($appointment->amount, 0) }}';
                    showError('Payment window closed. Your slot remains reserved for 15 minutes. Click PROCEED TO PAYMENT to try again.');
                }
            }
        };

        const rzp = new Razorpay(options);

        rzp.on('payment.failed', function (resp) {
            payButton.disabled = false;
            if (paySpinner) paySpinner.classList.add('hidden');
            if (payButtonText) payButtonText.innerText = '🔒 PROCEED TO PAYMENT ₹{{ number_format($appointment->amount, 0) }}';
            showError('Payment failed: ' + (resp.error ? resp.error.description : 'Transaction was declined by bank.'));
        });

        rzp.open();

    } catch (err) {
        payButton.disabled = false;
        if (paySpinner) paySpinner.classList.add('hidden');
        if (payButtonText) payButtonText.innerText = '🔒 PROCEED TO PAYMENT ₹{{ number_format($appointment->amount, 0) }}';
        showError(err.message || 'Payment gateway could not be loaded. Please try again.');
    }
}
</script>
@endpush
