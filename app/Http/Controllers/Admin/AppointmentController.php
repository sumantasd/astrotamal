<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['service'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $appointments = $query->paginate(15)->withQueryString();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['service']);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
            'payment_status' => ['required', 'string'],
            'preferred_date' => ['nullable', 'date'],
            'preferred_time' => ['nullable', 'string'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $previousDate = $appointment->preferred_date ? $appointment->preferred_date->format('Y-m-d') : '';
        $previousTime = $appointment->preferred_time ?? '';

        $newDate = !empty($validated['preferred_date']) ? $validated['preferred_date'] : $previousDate;
        $newTime = !empty($validated['preferred_time']) ? $validated['preferred_time'] : $previousTime;

        $isRescheduled = ($newDate !== $previousDate || $newTime !== $previousTime);
        $oldStatus = strtolower($appointment->status);
        $newStatus = strtolower($validated['status']);

        $updateData = [
            'status' => ucfirst($validated['status']),
            'payment_status' => ucfirst($validated['payment_status']),
            'preferred_date' => $newDate,
            'preferred_time' => $newTime,
            'admin_notes' => $request->input('admin_notes', $appointment->admin_notes),
        ];

        if ($newStatus === 'completed' && ! $appointment->completed_at) {
            $updateData['completed_at'] = now();
        }

        if ($newStatus === 'cancelled' && ! $appointment->cancelled_at) {
            $updateData['cancelled_at'] = now();
            $updateData['slot_reserved_until'] = null; // Release slot lock
        }

        $appointment->update($updateData);

        // Send Email Notifications
        try {
            if ($appointment->email && filter_var($appointment->email, FILTER_VALIDATE_EMAIL)) {
                if ($isRescheduled) {
                    \Illuminate\Support\Facades\Mail::to($appointment->email)
                        ->send(new \App\Mail\BookingRescheduledMail($appointment, $previousDate, $previousTime));
                } elseif ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                    \Illuminate\Support\Facades\Mail::to($appointment->email)
                        ->send(new \App\Mail\BookingCancelledMail($appointment));
                }
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Admin update mail send error: ' . $e->getMessage());
        }

        return redirect()->back()->with('status', 'Appointment updated successfully.');
    }

    /**
     * Delete an appointment booking.
     */
    public function destroy(Appointment $appointment)
    {
        $ref = $appointment->booking_reference ?? ('ASTRO-' . $appointment->id);
        
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('status', "Booking {$ref} deleted successfully.");
    }
}
