<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PaymentTransaction;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KPI Metrics
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::whereIn('status', ['Pending', 'Pending Payment', 'pending'])->count();
        $confirmedAppointments = Appointment::whereIn('status', ['Confirmed', 'confirmed', 'Completed', 'completed'])->count();
        
        $totalRevenue = Appointment::whereIn('payment_status', ['Paid', 'paid'])->sum('amount');
        if ($totalRevenue == 0) {
            $totalRevenue = PaymentTransaction::whereIn('status', ['Success', 'Captured', 'paid', 'successful'])->sum('amount');
        }

        $totalServices = Service::count();

        $stats = [
            'total_appointments' => $totalAppointments,
            'pending_appointments' => $pendingAppointments,
            'confirmed_appointments' => $confirmedAppointments,
            'total_revenue' => $totalRevenue,
            'total_services' => $totalServices,
        ];

        // 2. Chart Data (Last 30 Days trend)
        $startDate = now()->subDays(29)->startOfDay();
        $dailyAppointments = Appointment::where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_count'),
                DB::raw('SUM(CASE WHEN payment_status IN ("Paid", "paid") THEN amount ELSE 0 END) as total_revenue')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date');

        $chartLabels = [];
        $chartAppointments = [];
        $chartRevenue = [];

        for ($i = 29; $i >= 0; $i--) {
            $dateObj = now()->subDays($i);
            $dateStr = $dateObj->format('Y-m-d');
            $displayLabel = $dateObj->format('M d');
            
            $chartLabels[] = $displayLabel;
            $record = $dailyAppointments->get($dateStr);
            $chartAppointments[] = $record ? (int)$record->total_count : 0;
            $chartRevenue[] = $record ? (float)$record->total_revenue : 0;
        }

        $chartData = [
            'labels' => $chartLabels,
            'appointments' => $chartAppointments,
            'revenue' => $chartRevenue,
        ];

        // 3. Popular Services
        $popularServices = Service::withCount('appointments')
            ->orderBy('appointments_count', 'desc')
            ->take(5)
            ->get();

        $totalBookingsForPercentage = max(1, $popularServices->sum('appointments_count'));

        $popularServices->transform(function ($service) use ($totalBookingsForPercentage) {
            $service->percentage = round(($service->appointments_count / $totalBookingsForPercentage) * 100);
            return $service;
        });

        // 4. Recent Appointments
        $recentBookings = Appointment::with('service')
            ->latest()
            ->take(5)
            ->get();

        // 5. Upcoming Appointments
        $upcomingAppointments = Appointment::with('service')
            ->whereDate('preferred_date', '>=', now()->toDateString())
            ->orderBy('preferred_date', 'asc')
            ->orderBy('preferred_time', 'asc')
            ->take(5)
            ->get();

        if ($upcomingAppointments->isEmpty()) {
            $upcomingAppointments = Appointment::with('service')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('admin.dashboard', compact(
            'stats',
            'chartData',
            'popularServices',
            'recentBookings',
            'upcomingAppointments'
        ));
    }
}
