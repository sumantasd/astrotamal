@extends('admin.layouts.app')

@section('title', 'Payment Transactions')
@section('header_title', 'Payments & Transactions')
@section('header_subtitle', 'Audit verified payment logs, Razorpay order IDs, and transactions')

@section('content')
<div class="space-y-6 max-w-6xl">

    <!-- Search & Filter Controls -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-5 shadow-xs">
        <form method="GET" action="{{ route('admin.payments.transactions') }}" class="flex flex-col sm:flex-row items-center gap-4">
            <div class="w-full sm:w-80">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Order ID, Payment ID, Ref or Customer..." 
                       class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-2 text-xs text-[#17211D]">
            </div>

            <div class="w-full sm:w-48">
                <select name="status" class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-3 py-2 text-xs text-[#17211D]">
                    <option value="">All Statuses</option>
                    <option value="Success" {{ request('status') === 'Success' ? 'selected' : '' }}>Success</option>
                    <option value="Failed" {{ request('status') === 'Failed' ? 'selected' : '' }}>Failed</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="px-5 py-2 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.payments.transactions') }}" class="px-4 py-2 text-xs font-bold text-[#60736B] hover:text-[#0B3D2E]">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Payment Transactions Table -->
    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs">
        @if ($transactions->isEmpty())
            <div class="py-12 text-center text-xs text-[#60736B]">No payment transactions logged.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Order ID</th>
                            <th class="pb-3 px-3">Payment ID</th>
                            <th class="pb-3 px-3">Booking Ref</th>
                            <th class="pb-3 px-3">Customer</th>
                            <th class="pb-3 px-3">Amount</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3">Date</th>
                            <th class="pb-3 px-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($transactions as $tx)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3.5 px-3 font-mono font-bold text-[#0B3D2E]">
                                    {{ $tx->order_id ?? 'N/A' }}
                                </td>
                                <td class="py-3.5 px-3 font-mono text-xs">
                                    {{ $tx->payment_id ?? ($tx->appointment->payment_reference ?? 'Pending') }}
                                </td>
                                <td class="py-3.5 px-3 font-mono font-semibold">
                                    {{ $tx->booking_reference ?? ($tx->appointment->booking_reference ?? 'N/A') }}
                                </td>
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[#0B3D2E]">{{ $tx->appointment->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-[#60736B]">{{ $tx->appointment->phone ?? '' }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-bold">
                                    ₹{{ number_format($tx->amount, 2) }}
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ in_array(strtolower($tx->status), ['success', 'paid', 'captured']) ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ strtoupper($tx->status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap text-[11px] text-[#60736B]">
                                    {{ $tx->created_at ? $tx->created_at->format('d M Y, h:i A') : '' }}
                                </td>
                                <td class="py-3.5 px-3 text-right">
                                    <a href="{{ route('admin.payments.show', $tx) }}" class="px-3 py-1.5 text-xs font-bold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] rounded-xl border border-[#C8D8CF]">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
