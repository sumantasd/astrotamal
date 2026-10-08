@extends('admin.layouts.app')

@section('title', 'Payment Detail #' . ($transaction->booking_reference ?? $transaction->id))
@section('header_title', 'Payment Details')
@section('header_subtitle', 'Comprehensive transaction log and associated consultation details')

@section('content')
<div class="space-y-8 max-w-4xl">

    <!-- Top Back Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.payments.transactions') }}" class="inline-flex items-center text-xs font-bold text-[#0B3D2E] hover:underline">
            ← Back to All Transactions
        </a>

        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ in_array(strtolower($transaction->status), ['success', 'paid', 'captured']) ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
            Status: {{ strtoupper($transaction->status) }}
        </span>
    </div>

    <!-- 1. Payment Summary Card -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 shadow-xs space-y-6">
        <h3 class="font-serif-luxury text-lg font-bold text-[#0B3D2E] border-b border-[#C8D8CF]/60 pb-3">Payment Summary</h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs">
            <div>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#60736B] mb-1">Transaction Amount</span>
                <span class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">₹{{ number_format($transaction->amount, 2) }}</span>
                <span class="text-[10px] text-[#60736B] block">{{ $transaction->currency }}</span>
            </div>

            <div>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#60736B] mb-1">Razorpay Order ID</span>
                <span class="font-mono text-xs font-bold text-[#17211D]">{{ $transaction->order_id ?? 'N/A' }}</span>
            </div>

            <div>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#60736B] mb-1">Razorpay Payment ID</span>
                <span class="font-mono text-xs font-bold text-[#17211D]">{{ $transaction->payment_id ?? ($transaction->appointment->payment_reference ?? 'Pending') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs pt-4 border-t border-[#C8D8CF]/40">
            <div>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#60736B] mb-1">Booking Reference</span>
                <span class="font-mono font-bold text-[#0B3D2E]">{{ $transaction->booking_reference ?? ($transaction->appointment->booking_reference ?? 'N/A') }}</span>
            </div>

            <div>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#60736B] mb-1">Payment Gateway</span>
                <span class="font-bold text-[#17211D]">{{ $transaction->gateway ?? 'Razorpay' }}</span>
            </div>

            <div>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#60736B] mb-1">Date Logged</span>
                <span class="text-[#17211D]">{{ $transaction->created_at ? $transaction->created_at->format('d M Y, h:i A') : 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!-- 2. Customer & Consultation Details -->
    @if ($transaction->appointment)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Customer Info -->
            <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs space-y-4">
                <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E] border-b border-[#C8D8CF]/60 pb-2">Customer Details</h3>
                
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-[#60736B] block">Name:</span>
                        <strong class="text-[#0B3D2E] text-sm">{{ $transaction->appointment->name }}</strong>
                    </div>

                    <div>
                        <span class="text-[#60736B] block">Email:</span>
                        <strong class="text-[#17211D]">{{ $transaction->appointment->email }}</strong>
                    </div>

                    <div>
                        <span class="text-[#60736B] block">Phone / WhatsApp:</span>
                        <strong class="text-[#17211D]">{{ $transaction->appointment->phone }}</strong> 
                        @if($transaction->appointment->whatsapp)
                            <span class="text-[10px] text-[#60736B]">(WA: {{ $transaction->appointment->whatsapp }})</span>
                        @endif
                    </div>

                    <div>
                        <span class="text-[#60736B] block">Birth Details:</span>
                        <div class="text-[#17211D] mt-0.5">
                            DOB: {{ $transaction->appointment->birth_date ? \Carbon\Carbon::parse($transaction->appointment->birth_date)->format('d M Y') : 'N/A' }}
                            @if($transaction->appointment->birth_time)
                                | Time: {{ $transaction->appointment->birth_time }}
                            @endif
                            @if($transaction->appointment->birth_place)
                                | Place: {{ $transaction->appointment->birth_place }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Info -->
            <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs space-y-4">
                <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E] border-b border-[#C8D8CF]/60 pb-2">Consultation Schedule</h3>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-[#60736B] block">Consultation Type:</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-[#E8F1EC] text-[#0B3D2E]">
                            {{ $transaction->appointment->consultation_type }} Consultation
                        </span>
                    </div>

                    <div>
                        <span class="text-[#60736B] block">Preferred Date:</span>
                        <strong class="text-[#0B3D2E] text-sm">
                            {{ $transaction->appointment->preferred_date ? \Carbon\Carbon::parse($transaction->appointment->preferred_date)->format('d M Y') : 'N/A' }}
                        </strong>
                    </div>

                    <div>
                        <span class="text-[#60736B] block">Preferred Time Slot:</span>
                        <strong class="text-[#0B3D2E] text-sm">
                            {{ $transaction->appointment->preferred_time }}
                        </strong>
                    </div>

                    <div>
                        <span class="text-[#60736B] block">Consultation Mode:</span>
                        <span class="font-bold text-[#17211D]">{{ $transaction->appointment->consultation_mode ?? 'Audio' }}</span>
                    </div>
                </div>
            </div>

        </div>
    @endif

</div>
@endsection
