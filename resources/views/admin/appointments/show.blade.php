@extends('admin.layouts.app')

@section('title', 'Appointment Details')
@section('header_title', 'Appointment ' . ($appointment->booking_reference ?? 'ASTRO-' . $appointment->id))
@section('header_subtitle', 'Full consultation request details and management')

@section('content')
<div class="max-w-4xl space-y-8">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-[#0B3D2E] hover:underline flex items-center">
            ← Back to Appointments
        </a>

        <form method="POST" action="{{ route('admin.appointments.destroy', $appointment) }}" onsubmit="return confirm('Are you sure you want to delete this booking reference {{ $appointment->booking_reference ?? $appointment->id }}? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded-xl hover:bg-red-100 hover:border-red-300 transition-colors flex items-center space-x-1.5 shadow-xs">
                <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Delete Booking</span>
            </button>
        </form>
    </div>

    <!-- Client & Booking Info Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs space-y-4">
            <h3 class="font-serif-luxury font-bold text-[#0B3D2E] text-sm uppercase tracking-wider">Client Information</h3>
            <div class="text-xs space-y-2 text-[#17211D]">
                <div><span class="font-bold text-[#60736B]">Name:</span> {{ $appointment->name }}</div>
                <div><span class="font-bold text-[#60736B]">Email:</span> {{ $appointment->email }}</div>
                <div><span class="font-bold text-[#60736B]">Phone:</span> {{ $appointment->phone }}</div>
                <div><span class="font-bold text-[#60736B]">WhatsApp:</span> {{ $appointment->whatsapp ?? 'Not provided' }}</div>
                <div><span class="font-bold text-[#60736B]">Birth Date:</span> {{ $appointment->birth_date ?? 'Not provided' }}</div>
                <div><span class="font-bold text-[#60736B]">Birth Time:</span> {{ $appointment->birth_time ?? 'Not provided' }}</div>
                <div><span class="font-bold text-[#60736B]">Birth Place:</span> {{ $appointment->birth_place ?? 'Not provided' }}</div>
            </div>
        </div>

        <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs space-y-4">
            <h3 class="font-serif-luxury font-bold text-[#0B3D2E] text-sm uppercase tracking-wider">Consultation Details</h3>
            <div class="text-xs space-y-2 text-[#17211D]">
                <div><span class="font-bold text-[#60736B]">Service:</span> {{ $appointment->service->title ?? 'Consultation' }}</div>
                <div><span class="font-bold text-[#60736B]">Preferred Date:</span> {{ $appointment->preferred_date }}</div>
                <div><span class="font-bold text-[#60736B]">Preferred Time:</span> {{ $appointment->preferred_time }}</div>
                <div><span class="font-bold text-[#60736B]">Type / Mode:</span> {{ $appointment->consultation_type }} ({{ $appointment->consultation_mode }})</div>
                <div><span class="font-bold text-[#60736B]">Fee Amount:</span> ₹{{ number_format($appointment->amount, 2) }}</div>
                <div><span class="font-bold text-[#60736B]">Client Notes:</span> {{ $appointment->notes ?? 'None' }}</div>
            </div>
        </div>

    </div>

    <!-- Management Form Card -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 shadow-xs">
        <h3 class="font-serif-luxury font-bold text-[#0B3D2E] text-base mb-4">Manage Booking Status & Notes</h3>

        <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label for="status" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Booking Status</label>
                    <select name="status" id="status" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">
                        <option value="Pending Payment" {{ in_array(strtolower($appointment->status), ['pending payment', 'pending']) ? 'selected' : '' }}>Pending Payment</option>
                        <option value="Confirmed" {{ strtolower($appointment->status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Completed" {{ strtolower($appointment->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ strtolower($appointment->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div>
                    <label for="payment_status" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">
                        <option value="Pending" {{ strtolower($appointment->payment_status) === 'pending' || strtolower($appointment->payment_status) === 'unpaid' ? 'selected' : '' }}>Pending</option>
                        <option value="Paid" {{ strtolower($appointment->payment_status) === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Failed" {{ strtolower($appointment->payment_status) === 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="Refunded" {{ strtolower($appointment->payment_status) === 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <div>
                    <label for="preferred_date" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Reschedule Date</label>
                    <input type="date" 
                           name="preferred_date" 
                           id="preferred_date" 
                           value="{{ $appointment->preferred_date ? \Carbon\Carbon::parse($appointment->preferred_date)->format('Y-m-d') : '' }}" 
                           class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">
                </div>

                <div>
                    <label for="preferred_time" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Reschedule Time Slot</label>
                    <select name="preferred_time" id="preferred_time" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D]">
                        <option value="10:00 AM - 01:00 PM IST" {{ $appointment->preferred_time === '10:00 AM - 01:00 PM IST' ? 'selected' : '' }}>10:00 AM - 01:00 PM IST (Morning)</option>
                        <option value="02:00 PM - 05:00 PM IST" {{ $appointment->preferred_time === '02:00 PM - 05:00 PM IST' ? 'selected' : '' }}>02:00 PM - 05:00 PM IST (Afternoon)</option>
                        <option value="06:00 PM - 09:00 PM IST" {{ $appointment->preferred_time === '06:00 PM - 09:00 PM IST' ? 'selected' : '' }}>06:00 PM - 09:00 PM IST (Evening)</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="admin_notes" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Admin Internal Notes</label>
                <textarea name="admin_notes" id="admin_notes" rows="3" placeholder="Add confidential notes for this consultation..." 
                          class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs text-[#17211D] focus:outline-none focus:border-[#145A43]">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-full shadow-md transition-colors">
                    Update Appointment
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
