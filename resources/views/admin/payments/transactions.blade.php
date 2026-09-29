@extends('admin.layouts.app')

@section('title', 'Payment Transactions')
@section('header_title', 'Payment Audit Logs')
@section('header_subtitle', 'Verified Razorpay transactions and payment history')

@section('content')
<div class="space-y-6">

    <!-- Payment Transactions Table -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs">
        @if ($transactions->isEmpty())
            <div class="py-12 text-center text-xs text-[#81766D]">No payment transactions logged.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 text-[11px] font-bold uppercase tracking-wider text-[#81766D]">
                            <th class="pb-3 px-3">Order ID</th>
                            <th class="pb-3 px-3">Payment ID</th>
                            <th class="pb-3 px-3">Booking Ref</th>
                            <th class="pb-3 px-3">Amount</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                        @foreach ($transactions as $tx)
                            <tr class="hover:bg-[#EDE3D4]/30 transition-colors">
                                <td class="py-3.5 px-3 font-mono font-bold text-[#541F1D]">
                                    {{ $tx->order_id }}
                                </td>
                                <td class="py-3.5 px-3 font-mono text-xs">
                                    {{ $tx->payment_id ?? 'N/A' }}
                                </td>
                                <td class="py-3.5 px-3 font-mono">
                                    {{ $tx->booking_reference ?? ($tx->appointment->booking_reference ?? 'N/A') }}
                                </td>
                                <td class="py-3.5 px-3 font-bold">
                                    ₹{{ number_format($tx->amount, 2) }} {{ $tx->currency }}
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ in_array($tx->status, ['captured', 'paid', 'success']) ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ strtoupper($tx->status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap text-[11px] text-[#81766D]">
                                    {{ $tx->created_at->format('M d, Y H:i') }}
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
