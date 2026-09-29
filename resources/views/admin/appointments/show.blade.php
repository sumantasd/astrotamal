@extends('admin.layouts.app')

@section('title', 'Appointment Details')
@section('header_title', 'Appointment ' . ($appointment->booking_reference ?? 'ASTRO-' . $appointment->id))
@section('header_subtitle', 'Full consultation request details and management')

@section('content')
<div class="max-w-4xl space-y-8">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-[#541F1D] hover:underline flex items-center">
            ← Back to Appointments
        </a>
    </div>

    <!-- Client & Booking Info Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs space-y-4">
            <h3 class="font-serif-luxury font-bold text-[#541F1D] text-sm uppercase tracking-wider">Client Information</h3>
            <div class="text-xs space-y-2 text-[#29211F]">
                <div><span class="font-bold text-[#81766D]">Name:</span> {{ $appointment->name }}</div>
                <div><span class="font-bold text-[#81766D]">Email:</span> {{ $appointment->email }}</div>
                <div><span class="font-bold text-[#81766D]">Phone:</span> {{ $appointment->phone }}</div>
                <div><span class="font-bold text-[#81766D]">WhatsApp:</span> {{ $appointment->whatsapp ?? 'Not provided' }}</div>
                <div><span class="font-bold text-[#81766D]">Birth Date:</span> {{ $appointment->birth_date ?? 'Not provided' }}</div>
                <div><span class="font-bold text-[#81766D]">Birth Time:</span> {{ $appointment->birth_time ?? 'Not provided' }}</div>
                <div><span class="font-bold text-[#81766D]">Birth Place:</span> {{ $appointment->birth_place ?? 'Not provided' }}</div>
            </div>
        </div>

        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs space-y-4">
            <h3 class="font-serif-luxury font-bold text-[#541F1D] text-sm uppercase tracking-wider">Consultation Details</h3>
            <div class="text-xs space-y-2 text-[#29211F]">
                <div><span class="font-bold text-[#81766D]">Service:</span> {{ $appointment->service->title ?? 'Consultation' }}</div>
                <div><span class="font-bold text-[#81766D]">Preferred Date:</span> {{ $appointment->preferred_date }}</div>
                <div><span class="font-bold text-[#81766D]">Preferred Time:</span> {{ $appointment->preferred_time }}</div>
                <div><span class="font-bold text-[#81766D]">Type / Mode:</span> {{ $appointment->consultation_type }} ({{ $appointment->consultation_mode }})</div>
                <div><span class="font-bold text-[#81766D]">Fee Amount:</span> ₹{{ number_format($appointment->amount, 2) }}</div>
                <div><span class="font-bold text-[#81766D]">Client Notes:</span> {{ $appointment->notes ?? 'None' }}</div>
            </div>
        </div>

    </div>

    <!-- Management Form Card -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 shadow-xs">
        <h3 class="font-serif-luxury font-bold text-[#541F1D] text-base mb-4">Manage Booking Status & Notes</h3>

        <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="status" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Booking Status</label>
                    <select name="status" id="status" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                        <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div>
                    <label for="payment_status" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                        <option value="unpaid" {{ $appointment->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ $appointment->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="refunded" {{ $appointment->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="admin_notes" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Admin Internal Notes</label>
                <textarea name="admin_notes" id="admin_notes" rows="3" placeholder="Add confidential notes for this consultation..." 
                          class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F] focus:outline-none focus:border-[#C49A45]">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-full shadow-md">
                    Update Appointment
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
