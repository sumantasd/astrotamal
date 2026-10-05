@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title . ' — Ganesha Astro Consultancy')
@section('meta_description', $page->meta_description ?: 'Read the official ' . $page->title . ' for Ganesha Astro Consultancy.')

@section('content')
<section class="py-12 md:py-16 bg-[#FDFBF7] text-[#29211F]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Breadcrumb & Header -->
        <div class="text-center space-y-3 mb-10">
            <span class="px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] rounded-full inline-block border border-[#D8C6A8]">
                Legal Information
            </span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-serif-luxury text-[#541F1D]">
                {{ $page->title }}
            </h1>
            <p class="text-xs text-[#81766D]">
                Last updated: {{ $page->updated_at ? $page->updated_at->format('F d, Y') : date('F d, Y') }}
            </p>
        </div>

        <!-- Page Content Card -->
        <div class="bg-white border border-[#D8C6A8]/60 rounded-3xl p-6 sm:p-10 shadow-xs prose max-w-none text-sm leading-relaxed text-[#29211F] space-y-4">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection
