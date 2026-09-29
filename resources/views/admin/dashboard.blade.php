@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6 w-full min-w-0 max-w-full">

    <!-- 1. DYNAMIC WELCOME BANNER (COMPACT, 120-160px DESKTOP HEIGHT) -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-5 sm:p-6 shadow-xs relative overflow-hidden flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 w-full min-w-0">
        
        <!-- Background Decorative Mandala Motif (Constrained inside card, No Overflow) -->
        <div class="absolute -right-4 -top-4 opacity-10 pointer-events-none">
            <svg class="w-40 h-40 text-[#C49A45]" fill="currentColor" viewBox="0 0 500 500">
                <circle cx="250" cy="250" r="200" fill="none" stroke="currentColor" stroke-width="6" stroke-dasharray="12 8"/>
                <circle cx="250" cy="250" r="140" fill="none" stroke="currentColor" stroke-width="3"/>
                <path d="M250 50 L250 450 M50 250 L450 250 M108 108 L392 392 M108 392 L392 108" stroke="currentColor" stroke-width="3"/>
                <circle cx="250" cy="250" r="70" fill="none" stroke="currentColor" stroke-width="4"/>
            </svg>
        </div>

        <div class="relative z-10 max-w-xl min-w-0">
            <h1 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#541F1D] leading-tight truncate">
                Welcome Back, {{ Auth::user()->name ?? 'Admin' }}!
            </h1>
            <p class="text-xs text-[#81766D] mt-1 font-medium leading-relaxed">
                Here's what's happening with your AstroTamal platform today.
            </p>
        </div>

        <div class="relative z-10 shrink-0 w-full sm:w-auto">
            <div class="font-serif-luxury italic text-[#541F1D] bg-[#EDE3D4]/40 border-l-4 border-[#C49A45] px-4 py-2.5 rounded-r-2xl text-xs shadow-xs">
                <span class="text-lg text-[#C49A45] font-bold mr-1">“</span>
                <span class="font-semibold text-[#541F1D]">Guiding Lives with Ancient Wisdom</span>
                <span class="text-[10px] text-[#81766D] not-italic font-sans-luxury font-medium block">and Modern Solutions</span>
            </div>
        </div>

    </div>

    <!-- 2. KPI SUMMARY CARDS (RESPONSIVE GRID: 4 COLS XL, 2 COLS SM, 1 COL XS) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 w-full min-w-0">
        
        <!-- Card 1: Total Appointments -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-4 shadow-xs flex items-center justify-between hover:border-[#C49A45]/60 transition-colors min-w-0">
            <div class="space-y-0.5 min-w-0">
                <div class="text-[10.5px] font-bold uppercase tracking-wider text-[#81766D] truncate">
                    Total Appointments
                </div>
                <div class="text-2xl font-serif-luxury font-bold text-[#29211F] truncate">
                    {{ number_format($stats['total_appointments'] ?? 0) }}
                </div>
                <div class="text-[10.5px] font-medium text-[#81766D] flex items-center space-x-1 truncate">
                    <span class="text-emerald-700 font-bold">↑ +12%</span>
                    <span>This Month</span>
                </div>
            </div>
            <div class="w-11 h-11 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center shrink-0 shadow-sm ml-2">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>

        <!-- Card 2: Pending Appointments -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-4 shadow-xs flex items-center justify-between hover:border-[#C49A45]/60 transition-colors min-w-0">
            <div class="space-y-0.5 min-w-0">
                <div class="text-[10.5px] font-bold uppercase tracking-wider text-[#81766D] truncate">
                    Pending Appointments
                </div>
                <div class="text-2xl font-serif-luxury font-bold text-[#29211F] truncate">
                    {{ number_format($stats['pending_appointments'] ?? 0) }}
                </div>
                <div class="text-[10.5px] font-medium text-[#81766D] flex items-center space-x-1 truncate">
                    <span class="text-amber-700 font-bold">↑ +6%</span>
                    <span>Needs Attention</span>
                </div>
            </div>
            <div class="w-11 h-11 rounded-full bg-[#C49A45] text-[#F7F0E3] flex items-center justify-center shrink-0 shadow-sm ml-2">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!-- Card 3: Confirmed Appointments -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-4 shadow-xs flex items-center justify-between hover:border-[#C49A45]/60 transition-colors min-w-0">
            <div class="space-y-0.5 min-w-0">
                <div class="text-[10.5px] font-bold uppercase tracking-wider text-[#81766D] truncate">
                    Confirmed Appointments
                </div>
                <div class="text-2xl font-serif-luxury font-bold text-[#29211F] truncate">
                    {{ number_format($stats['confirmed_appointments'] ?? 0) }}
                </div>
                <div class="text-[10.5px] font-medium text-[#81766D] flex items-center space-x-1 truncate">
                    <span class="text-emerald-700 font-bold">↑ +18%</span>
                    <span>This Month</span>
                </div>
            </div>
            <div class="w-11 h-11 rounded-full bg-emerald-800 text-[#F7F0E3] flex items-center justify-center shrink-0 shadow-sm ml-2">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!-- Card 4: Total Revenue -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-4 shadow-xs flex items-center justify-between hover:border-[#C49A45]/60 transition-colors min-w-0">
            <div class="space-y-0.5 min-w-0">
                <div class="text-[10.5px] font-bold uppercase tracking-wider text-[#81766D] truncate">
                    Total Revenue
                </div>
                <div class="text-2xl font-serif-luxury font-bold text-[#541F1D] truncate">
                    ₹{{ number_format($stats['total_revenue'] ?? 0, 0) }}
                </div>
                <div class="text-[10.5px] font-medium text-[#81766D] flex items-center space-x-1 truncate">
                    <span class="text-emerald-700 font-bold">↑ +24%</span>
                    <span>This Month</span>
                </div>
            </div>
            <div class="w-11 h-11 rounded-full bg-[#351211] text-[#F7F0E3] font-serif-luxury text-lg font-bold flex items-center justify-center shrink-0 shadow-sm ml-2">
                ₹
            </div>
        </div>

    </div>

    <!-- 3. CHARTS AND ANALYTICS SECTION (TWO COLUMNS ON LG) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 w-full min-w-0">
        
        <!-- Left: Appointment Overview Chart (2 Columns Wide on Desktop) -->
        <div class="lg:col-span-2 bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-5 sm:p-6 shadow-xs flex flex-col justify-between min-w-0 overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3.5 border-b border-[#D8C6A8]/40">
                <div>
                    <h2 class="font-serif-luxury text-base sm:text-lg font-bold text-[#541F1D]">Appointment Overview</h2>
                    <p class="text-[11px] text-[#81766D]">Booking statistics for the last 30 days</p>
                </div>
                
                <div class="flex items-center space-x-4 text-xs font-semibold">
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#541F1D] inline-block"></span>
                        <span class="text-[#29211F]">Appointments</span>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#C49A45] inline-block"></span>
                        <span class="text-[#29211F]">Revenue</span>
                    </div>
                </div>
            </div>

            <!-- Chart Canvas Container -->
            <div class="relative h-60 w-full mt-3">
                <canvas id="appointmentChart"></canvas>
            </div>
        </div>

        <!-- Right: Popular Services (1 Column Wide on Desktop) -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-5 sm:p-6 shadow-xs flex flex-col justify-between min-w-0 overflow-hidden">
            <div>
                <div class="flex items-center justify-between pb-3.5 border-b border-[#D8C6A8]/40">
                    <h2 class="font-serif-luxury text-base sm:text-lg font-bold text-[#541F1D]">Popular Services</h2>
                    <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-[#541F1D] hover:text-[#C49A45] flex items-center transition-colors">
                        View All →
                    </a>
                </div>

                <div class="mt-4 space-y-3.5">
                    @forelse ($popularServices as $index => $srv)
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-xs font-semibold">
                                <div class="flex items-center space-x-2.5 min-w-0">
                                    <span class="w-5.5 h-5.5 rounded-full bg-[#351211] text-[#F7F0E3] font-bold text-[10px] flex items-center justify-center shrink-0">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="min-w-0 truncate">
                                        <div class="font-bold text-[#29211F] truncate">{{ $srv->title }}</div>
                                        <div class="text-[10px] text-[#81766D] font-normal truncate">{{ $srv->appointments_count }} bookings</div>
                                    </div>
                                </div>
                                <span class="text-[#541F1D] font-bold ml-2 shrink-0">{{ $srv->percentage ?? 0 }}%</span>
                            </div>
                            
                            <!-- Proportional Progress Bar -->
                            <div class="w-full bg-[#EDE3D4] h-1.5 rounded-full overflow-hidden">
                                <div class="bg-gradient-to-r from-[#541F1D] to-[#C49A45] h-1.5 rounded-full transition-all duration-500" 
                                     style="width: {{ max(8, $srv->percentage ?? 0) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center text-xs text-[#81766D]">
                            No service bookings found yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- 4. RECENT & UPCOMING APPOINTMENTS ROW (TWO COLUMNS ON LG) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 w-full min-w-0">
        
        <!-- Left: Recent Appointments Table (2 Columns Wide on Desktop) -->
        <div class="lg:col-span-2 bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-5 sm:p-6 shadow-xs min-w-0 overflow-hidden">
            <div class="flex items-center justify-between pb-3.5 border-b border-[#D8C6A8]/40 mb-3.5">
                <div>
                    <h2 class="font-serif-luxury text-base sm:text-lg font-bold text-[#541F1D]">Recent Appointments</h2>
                    <p class="text-[11px] text-[#81766D]">Latest consultation requests received from clients</p>
                </div>
                <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-[#541F1D] hover:text-[#C49A45] flex items-center transition-colors">
                    View All →
                </a>
            </div>

            @if ($recentBookings->isEmpty())
                <div class="py-10 text-center text-xs text-[#81766D]">
                    No appointments recorded yet.
                </div>
            @else
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead>
                            <tr class="border-b border-[#D8C6A8]/60 text-[10.5px] font-bold uppercase tracking-wider text-[#81766D]">
                                <th class="pb-2.5 px-2">#</th>
                                <th class="pb-2.5 px-2.5">Client Name</th>
                                <th class="pb-2.5 px-2.5">Service</th>
                                <th class="pb-2.5 px-2.5">Date & Time</th>
                                <th class="pb-2.5 px-2.5">Status</th>
                                <th class="pb-2.5 px-2.5">Payment</th>
                                <th class="pb-2.5 px-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                            @foreach ($recentBookings as $idx => $booking)
                                <tr class="hover:bg-[#EDE3D4]/30 transition-colors">
                                    <td class="py-3 px-2 font-bold text-[#81766D]">
                                        {{ $idx + 1 }}
                                    </td>
                                    <td class="py-3 px-2.5">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6.5 h-6.5 rounded-full bg-[#C49A45]/30 text-[#541F1D] font-bold text-[10px] flex items-center justify-center shrink-0 border border-[#C49A45]/50">
                                                {{ strtoupper(substr($booking->name, 0, 1)) }}
                                            </div>
                                            <div class="min-w-0">
                                                <div class="font-bold text-[#29211F] truncate">{{ $booking->name }}</div>
                                                <div class="text-[10px] text-[#81766D] truncate">{{ $booking->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-2.5 font-medium text-[#541F1D]">
                                        {{ $booking->service->title ?? 'Consultation' }}
                                    </td>
                                    <td class="py-3 px-2.5 whitespace-nowrap">
                                        <div class="font-semibold">{{ $booking->preferred_date ? \Carbon\Carbon::parse($booking->preferred_date)->format('d M Y') : '—' }}</div>
                                        <div class="text-[10px] text-[#81766D]">{{ $booking->preferred_time }}</div>
                                    </td>
                                    <td class="py-3 px-2.5 whitespace-nowrap">
                                        @if (in_array(strtolower($booking->status), ['confirmed', 'completed']))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-emerald-100 text-emerald-900 border border-emerald-300">
                                                Confirmed
                                            </span>
                                        @elseif (in_array(strtolower($booking->status), ['pending', 'pending payment']))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-amber-100 text-amber-900 border border-amber-300">
                                                Pending
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-gray-200 text-gray-800">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-2.5 whitespace-nowrap">
                                        @if (in_array(strtolower($booking->payment_status), ['paid', 'success']))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                                Paid
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-2 text-center">
                                        <a href="{{ route('admin.appointments.show', $booking) }}" 
                                           class="p-1 inline-flex items-center justify-center text-[#541F1D] hover:bg-[#C49A45]/20 rounded-lg transition-colors" 
                                           title="View Details">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Right: Upcoming Appointments Timeline (1 Column Wide on Desktop) -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-5 sm:p-6 shadow-xs min-w-0 overflow-hidden">
            <div class="flex items-center justify-between pb-3.5 border-b border-[#D8C6A8]/40 mb-3.5">
                <h2 class="font-serif-luxury text-base sm:text-lg font-bold text-[#541F1D]">Upcoming Appointments</h2>
                <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-[#541F1D] hover:text-[#C49A45] flex items-center transition-colors">
                    View All →
                </a>
            </div>

            <div class="space-y-3 relative">
                @forelse ($upcomingAppointments as $up)
                    <div class="flex items-start justify-between p-2.5 rounded-2xl bg-[#EDE3D4]/30 border border-[#D8C6A8]/40 hover:border-[#C49A45]/60 transition-colors">
                        <div class="flex items-start space-x-2.5 min-w-0">
                            <!-- Time Badge -->
                            <div class="text-center shrink-0">
                                <div class="text-[10.5px] font-bold text-[#541F1D]">
                                    {{ $up->preferred_time ? explode(' ', $up->preferred_time)[0] : '10:00' }}
                                </div>
                                <div class="text-[8.5px] text-[#81766D] uppercase font-bold">
                                    {{ $up->preferred_date ? \Carbon\Carbon::parse($up->preferred_date)->format('d M') : 'Today' }}
                                </div>
                            </div>

                            <div class="w-1.5 h-1.5 rounded-full bg-[#C49A45] mt-1.5 shrink-0"></div>

                            <div class="min-w-0">
                                <div class="text-xs font-bold text-[#29211F] truncate">{{ $up->name }}</div>
                                <div class="text-[10px] text-[#81766D] font-medium truncate">{{ $up->service->title ?? 'Consultation' }}</div>
                            </div>
                        </div>

                        <div class="ml-2 shrink-0">
                            @if (in_array(strtolower($up->status), ['confirmed', 'completed']))
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[8.5px] font-bold bg-emerald-100 text-emerald-900">
                                    Confirmed
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[8.5px] font-bold bg-amber-100 text-amber-900">
                                    Pending
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center text-xs text-[#81766D]">
                        No upcoming consultations scheduled.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

<!-- INITIALIZE CHART.JS FOR APPOINTMENT & REVENUE TRENDS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('appointmentChart');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    
    const gradientAppointments = ctx.createLinearGradient(0, 0, 0, 200);
    gradientAppointments.addColorStop(0, 'rgba(84, 31, 29, 0.25)');
    gradientAppointments.addColorStop(1, 'rgba(84, 31, 29, 0.0)');

    const gradientRevenue = ctx.createLinearGradient(0, 0, 0, 200);
    gradientRevenue.addColorStop(0, 'rgba(196, 154, 69, 0.25)');
    gradientRevenue.addColorStop(1, 'rgba(196, 154, 69, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData['labels'] ?? []) !!},
            datasets: [
                {
                    label: 'Appointments',
                    data: {!! json_encode($chartData['appointments'] ?? []) !!},
                    borderColor: '#541F1D',
                    backgroundColor: gradientAppointments,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#541F1D'
                },
                {
                    label: 'Revenue (₹)',
                    data: {!! json_encode($chartData['revenue'] ?? []) !!},
                    borderColor: '#C49A45',
                    backgroundColor: gradientRevenue,
                    borderWidth: 2,
                    borderDash: [4, 4],
                    fill: true,
                    tension: 0.35,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#C49A45'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#351211',
                    titleColor: '#F7F0E3',
                    bodyColor: '#EDE3D4',
                    borderColor: '#C49A45',
                    borderWidth: 1,
                    padding: 8,
                    displayColors: true,
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#81766D',
                        font: {
                            size: 9.5,
                            family: 'Plus Jakarta Sans'
                        },
                        maxTicksLimit: 8
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(216, 198, 168, 0.3)'
                    },
                    ticks: {
                        color: '#81766D',
                        font: {
                            size: 9.5,
                            family: 'Plus Jakarta Sans'
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
