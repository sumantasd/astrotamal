@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')

@section('content')
<div class="space-y-6 max-w-5xl">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#0B3D2E]">Contact Form Inquiries</h1>
            <p class="text-xs text-[#60736B] mt-1">Review incoming leads, messages, and customer consultation requests.</p>
        </div>
        <form method="GET" action="{{ route('admin.inquiries.index') }}" class="flex items-center space-x-2">
            <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
                <option value="">All Statuses</option>
                <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name/email/phone..." class="px-3 py-1.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
            <button type="submit" class="px-3 py-1.5 bg-[#0B3D2E] text-[#FFFFFF] text-xs font-bold rounded-xl hover:bg-[#145A43]">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs">
        @if ($inquiries->isEmpty())
            <div class="py-12 text-center text-xs text-[#60736B]">No contact inquiries found matching criteria.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Contact</th>
                            <th class="pb-3 px-3">Service Interest</th>
                            <th class="pb-3 px-3">Message</th>
                            <th class="pb-3 px-3">Date</th>
                            <th class="pb-3 px-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($inquiries as $inq)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <div class="font-bold text-[#0B3D2E]">{{ $inq->name }}</div>
                                    <div class="text-[11px] text-[#60736B]">{{ $inq->email }} • {{ $inq->phone ?? 'No Phone' }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-medium whitespace-nowrap">
                                    {{ $inq->service_interest ?? 'General Inquiry' }}
                                </td>
                                <td class="py-3.5 px-3 text-[#17211D] max-w-sm">
                                    {{ $inq->message }}
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap text-[11px] text-[#60736B]">
                                    {{ $inq->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    <form method="POST" action="{{ route('admin.inquiries.status', $inq) }}">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-lg px-2 py-1 text-[11px] font-bold text-[#0B3D2E]">
                                            <option value="new" {{ $inq->status === 'new' ? 'selected' : '' }}>New</option>
                                            <option value="read" {{ $inq->status === 'read' ? 'selected' : '' }}>Read</option>
                                            <option value="replied" {{ $inq->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
