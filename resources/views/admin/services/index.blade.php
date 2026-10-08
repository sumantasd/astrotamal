@extends('admin.layouts.app')

@section('title', 'Services Management')
@section('header_title', 'Astrology Services Management')
@section('header_subtitle', 'Manage all consultation offerings, inner page content, section order, visibility and SEO')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between bg-[#FFFFFF] p-5 rounded-2xl border border-[#C8D8CF] shadow-xs">
        <div>
            <h2 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">Astrology Services</h2>
            <p class="text-xs text-[#60736B] mt-0.5">Total Services: <span class="font-bold text-[#17211D]">{{ count($services) }}</span></p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-md transition-all">
            + Add New Service
        </a>
    </div>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-xl text-xs font-semibold shadow-xs">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs">
        @if ($services->isEmpty())
            <div class="py-12 text-center text-xs text-[#60736B]">No services created yet.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Service Name</th>
                            <th class="pb-3 px-3">Price Label</th>
                            <th class="pb-3 px-3">Duration</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3">Featured</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($services as $srv)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[#0B3D2E] text-sm">{{ $srv->title }}</div>
                                    <div class="text-[11px] text-[#60736B]">/services/{{ $srv->slug }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-bold text-[#C49A45]">
                                    {{ $srv->price ?: 'Consultation' }}
                                </td>
                                <td class="py-3.5 px-3">
                                    {{ $srv->duration ?: '45 Mins' }}
                                </td>
                                <td class="py-3.5 px-3">
                                    @if ($srv->is_active ?? true)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-600">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-3">
                                    @if ($srv->is_featured)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#C49A45]/20 text-[#0B3D2E]">
                                            ★ Featured
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-3 text-right space-x-2">
                                    <a href="{{ route('services.show', $srv->slug) }}" target="_blank" class="px-2.5 py-1 text-xs font-bold text-[#60736B] bg-[#E8F1EC] rounded-lg hover:bg-[#C3E8D2]">
                                        View
                                    </a>
                                    <a href="{{ route('admin.services.edit', $srv) }}" class="px-3 py-1 text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] rounded-lg hover:bg-[#145A43]">
                                        Edit Service
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
