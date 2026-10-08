@extends('layouts.app')

@section('title', 'Booking Details — ' . $appointment->booking_reference)

@section('content')
<section class="bg-[#F3F8F5] text-[#17211D] py-10 sm:py-14 min-h-[75vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Back Link & Header -->
        <div class="flex items-center justify-between">
            <a href="{{ route('account.dashboard') }}" class="text-xs font-bold text-[#0B3D2E] hover:underline flex items-center gap-1">
                ← Back to Customer Dashboard
            </a>
            <span class="font-mono text-xs font-bold bg-[#E8F1EC] px-3 py-1 rounded-lg border border-[#C8D8CF] text-[#0B3D2E]">
                {{ $appointment->booking_reference }}
            </span>
        </div>

        <!-- Main Card -->
        <div class="bg-[#06281F] rounded-[24px] p-6 sm:p-8 border border-[#C49A45]/40 shadow-xl text-[#F7F0E3] space-y-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#C49A45]/30 pb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">BOOKING DETAILS</span>
                    <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FFFFFF] mt-1">
                        {{ $appointment->service->title ?? 'Vedic Astrology Consultation' }}
                    </h1>
                </div>
                <div>
                    @if($appointment->payment_status === 'Paid')
                        <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-900/80 border border-emerald-500/50 text-emerald-200 text-xs font-bold uppercase tracking-wider">
                            ✓ CONFIRMED & PAID
                        </span>
                    @elseif($appointment->payment_status === 'Pending')
                        <span class="inline-block px-4 py-1.5 rounded-full bg-amber-900/80 border border-amber-500/50 text-amber-200 text-xs font-bold uppercase tracking-wider">
                            ⏳ PAYMENT PENDING
                        </span>
                    @else
                        <span class="inline-block px-4 py-1.5 rounded-full bg-red-900/80 border border-red-500/50 text-red-200 text-xs font-bold uppercase tracking-wider">
                            {{ $appointment->payment_status }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Booking Timeline Indicator -->
            <div class="space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">BOOKING STATUS TIMELINE</span>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 text-center text-xs">
                    <!-- Step 1: Created -->
                    <div class="p-3 rounded-xl bg-[#0B3D2E]/80 border border-[#C49A45]/40">
                        <span class="block text-emerald-400 font-bold mb-0.5">✓</span>
                        <span class="font-semibold text-[#FFFFFF]">Created</span>
                    </div>

                    <!-- Step 2: Payment Received -->
                    <div class="p-3 rounded-xl {{ $appointment->payment_status === 'Paid' ? 'bg-[#0B3D2E]/80 border border-[#C49A45]/40' : 'bg-[#06281F]/60 border border-[#C8D8CF]/20 opacity-50' }}">
                        <span class="block {{ $appointment->payment_status === 'Paid' ? 'text-emerald-400' : 'text-[#D8E5DE]' }} font-bold mb-0.5">
                            {{ $appointment->payment_status === 'Paid' ? '✓' : '○' }}
                        </span>
                        <span class="font-semibold text-[#FFFFFF]">Payment Received</span>
                    </div>

                    <!-- Step 3: Confirmed -->
                    <div class="p-3 rounded-xl {{ $appointment->status === 'Confirmed' || $appointment->status === 'Completed' ? 'bg-[#0B3D2E]/80 border border-[#C49A45]/40' : 'bg-[#06281F]/60 border border-[#C8D8CF]/20 opacity-50' }}">
                        <span class="block {{ $appointment->status === 'Confirmed' || $appointment->status === 'Completed' ? 'text-emerald-400' : 'text-[#D8E5DE]' }} font-bold mb-0.5">
                            {{ $appointment->status === 'Confirmed' || $appointment->status === 'Completed' ? '✓' : '○' }}
                        </span>
                        <span class="font-semibold text-[#FFFFFF]">Confirmed</span>
                    </div>

                    <!-- Step 4: Scheduled -->
                    <div class="p-3 rounded-xl {{ $appointment->status === 'Confirmed' || $appointment->status === 'Completed' ? 'bg-[#0B3D2E]/80 border border-[#C49A45]/40' : 'bg-[#06281F]/60 border border-[#C8D8CF]/20 opacity-50' }}">
                        <span class="block {{ $appointment->status === 'Confirmed' || $appointment->status === 'Completed' ? 'text-emerald-400' : 'text-[#D8E5DE]' }} font-bold mb-0.5">
                            {{ $appointment->status === 'Confirmed' || $appointment->status === 'Completed' ? '✓' : '○' }}
                        </span>
                        <span class="font-semibold text-[#FFFFFF]">Scheduled</span>
                    </div>

                    <!-- Step 5: Completed -->
                    <div class="p-3 rounded-xl col-span-2 sm:col-span-1 {{ $appointment->status === 'Completed' ? 'bg-[#0B3D2E]/80 border border-[#C49A45]/40' : 'bg-[#06281F]/60 border border-[#C8D8CF]/20 opacity-50' }}">
                        <span class="block {{ $appointment->status === 'Completed' ? 'text-emerald-400' : 'text-[#D8E5DE]' }} font-bold mb-0.5">
                            {{ $appointment->status === 'Completed' ? '✓' : '○' }}
                        </span>
                        <span class="font-semibold text-[#FFFFFF]">Completed</span>
                    </div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs text-[#D8E5DE]">
                
                <div class="bg-[#0B3D2E]/80 p-5 rounded-2xl border border-[#C49A45]/30 space-y-2">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#C49A45] mb-2">APPOINTMENT SCHEDULE</span>
                    <div><strong class="text-[#FFFFFF]">Date:</strong> {{ \Carbon\Carbon::parse($appointment->preferred_date)->format('l, d F Y') }}</div>
                    <div><strong class="text-[#FFFFFF]">Slot:</strong> {{ $appointment->preferred_time }}</div>
                    <div><strong class="text-[#FFFFFF]">Type:</strong> {{ $appointment->consultation_type }} Consultation</div>
                    <div><strong class="text-[#FFFFFF]">Mode:</strong> 1-on-1 Audio Call</div>
                </div>

                <div class="bg-[#0B3D2E]/80 p-5 rounded-2xl border border-[#C49A45]/30 space-y-2">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#C49A45] mb-2">PAYMENT SUMMARY</span>
                    <div><strong class="text-[#FFFFFF]">Amount:</strong> ₹{{ number_format($appointment->amount, 2) }} INR</div>
                    <div><strong class="text-[#FFFFFF]">Status:</strong> {{ $appointment->payment_status }}</div>
                    <div><strong class="text-[#FFFFFF]">Gateway:</strong> {{ $appointment->payment_method ?? 'Razorpay' }}</div>
                    <div><strong class="text-[#FFFFFF]">Transaction Ref:</strong> {{ $appointment->payment_reference ?? 'N/A' }}</div>
                </div>

                <div class="bg-[#0B3D2E]/80 p-5 rounded-2xl border border-[#C49A45]/30 space-y-2 md:col-span-2">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[#C49A45] mb-2">CLIENT & BIRTH INFORMATION</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div><strong class="text-[#FFFFFF]">Name:</strong> {{ $appointment->name }}</div>
                        <div><strong class="text-[#FFFFFF]">Phone:</strong> {{ $appointment->phone }}</div>
                        <div><strong class="text-[#FFFFFF]">Email:</strong> {{ $appointment->email }}</div>
                        <div><strong class="text-[#FFFFFF]">Birth Date:</strong> {{ $appointment->birth_date ? \Carbon\Carbon::parse($appointment->birth_date)->format('d M Y') : 'N/A' }}</div>
                        <div><strong class="text-[#FFFFFF]">Birth Time:</strong> {{ $appointment->birth_time ? \Carbon\Carbon::parse($appointment->birth_time)->format('h:i A') : 'N/A' }}</div>
                        <div><strong class="text-[#FFFFFF]">Birth Place:</strong> {{ $appointment->birth_place ?? 'N/A' }}</div>
                    </div>
                </div>

            </div>

            <!-- Actions Footer -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-[#C49A45]/30">
                <div class="text-xs text-[#D8E5DE]">
                    Desk Support: <a href="tel:8392059201" class="text-[#C49A45] font-bold underline">8392059201</a> &bull; ganesha4astro@gmail.com
                </div>

                @if($appointment->payment_status !== 'Paid')
                    <a href="{{ route('consultation.checkout', ['reference' => $appointment->booking_reference]) }}" 
                       class="px-6 py-3 rounded-xl bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] text-xs font-bold uppercase tracking-wider transition-all">
                        Pay Now — ₹{{ number_format($appointment->amount, 0) }}
                    </a>
                @endif
            </div>

        </div>

    </div>
</section>
@endsection
