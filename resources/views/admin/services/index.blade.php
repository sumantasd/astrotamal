@extends('admin.layouts.app')

@section('title', 'Services Management')
@section('header_title', 'Consultation Services')
@section('header_subtitle', 'Manage astrology consultation offerings, durations, and pricing')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <span class="text-xs font-bold uppercase tracking-wider text-[#81766D]">Total Services: {{ count($services) }}</span>
        <a href="{{ route('admin.services.create') }}" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-xl shadow-md">
            + Add New Service
        </a>
    </div>

    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs">
        @if ($services->isEmpty())
            <div class="py-12 text-center text-xs text-[#81766D]">No services created yet.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 text-[11px] font-bold uppercase tracking-wider text-[#81766D]">
                            <th class="pb-3 px-3">Title</th>
                            <th class="pb-3 px-3">Price</th>
                            <th class="pb-3 px-3">Duration</th>
                            <th class="pb-3 px-3">Featured</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                        @foreach ($services as $srv)
                            <tr class="hover:bg-[#EDE3D4]/30 transition-colors">
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[#541F1D]">{{ $srv->title }}</div>
                                    <div class="text-[11px] text-[#81766D]">{{ $srv->slug }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-bold">
                                    {{ is_numeric($srv->price) ? '₹' . number_format((float)$srv->price, 2) : $srv->price }}
                                </td>
                                <td class="py-3.5 px-3">
                                    {{ $srv->duration }}
                                </td>
                                <td class="py-3.5 px-3">
                                    @if ($srv->is_featured)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#C49A45]/20 text-[#541F1D]">
                                            ★ Featured
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-3 text-right space-x-2">
                                    <a href="{{ route('admin.services.edit', $srv) }}" class="px-3 py-1 text-xs font-bold text-[#541F1D] bg-[#C49A45]/20 rounded-lg hover:bg-[#C49A45]/40">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.services.destroy', $srv) }}" class="inline-block" onsubmit="return confirm('Delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-lg hover:bg-red-200">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
