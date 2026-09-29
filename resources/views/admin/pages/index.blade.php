@extends('admin.layouts.app')

@section('title', 'Page & Section Manager')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#541F1D]">Page & Section Manager</h1>
            <p class="text-xs sm:text-sm text-[#81766D] mt-1">Manage public website pages, section headings, banners, and SEO metadata.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pages as $p)
            <div class="bg-[#FDFBF7] p-5 rounded-2xl border border-[#D8C6A8] shadow-xs flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-[#541F1D] text-[#C49A45] font-bold text-xs flex items-center justify-center border border-[#C49A45]/40">
                            {{ strtoupper(substr($p->slug, 0, 1)) }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $p->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </div>

                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D] mt-3">{{ $p->title }}</h3>
                    <p class="text-xs text-[#81766D] mt-1 line-clamp-2">{{ $p->meta_description ?? 'No meta description set.' }}</p>

                    <div class="mt-3 text-[11px] text-[#C49A45] font-semibold">
                        URL: <code class="bg-[#EDE3D4] px-1.5 py-0.5 rounded text-[#541F1D]">/{{ $p->slug === 'home' ? '' : $p->slug }}</code>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#D8C6A8]/40 flex items-center justify-between">
                    <a href="{{ route('home') }}/{{ $p->slug === 'home' ? '' : $p->slug }}" target="_blank" class="text-xs text-[#81766D] hover:text-[#541F1D] font-medium flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Page
                    </a>
                    <a href="{{ route('admin.pages.edit', $p->slug) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 transition-all shadow-xs">
                        Edit Content & SEO
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
