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
            'status' => ['required', 'string', 'in:pending,confirmed,completed,cancelled'],
            'payment_status' => ['required', 'string', 'in:unpaid,paid,refunded'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $updateData = [
            'status' => $validated['status'],
            'payment_status' => $validated['payment_status'],
            'admin_notes' => $validated['admin_notes'],
        ];

        if ($validated['status'] === 'completed' && ! $appointment->completed_at) {
            $updateData['completed_at'] = now();
        }

        if ($validated['status'] === 'cancelled' && ! $appointment->cancelled_at) {
            $updateData['cancelled_at'] = now();
        }

        $appointment->update($updateData);

        return redirect()->back()->with('status', 'Appointment updated successfully.');
    }
}
