@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title . ' — Ganesha Astro Consultancy')
@section('meta_description', $page->meta_description ?: 'Read the official ' . $page->title . ' for Ganesha Astro Consultancy.')

@section('content')
<section class="py-12 md:py-16 bg-[#F3F8F5] text-[#17211D]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Breadcrumb & Header -->
        <div class="text-center space-y-3 mb-10">
            <span class="px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-[#0B3D2E] bg-[#E8F1EC] rounded-full inline-block border border-[#C8D8CF]">
                Legal Information
            </span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-serif-luxury text-[#0B3D2E]">
                {{ $page->title }}
            </h1>
            <p class="text-xs text-[#60736B]">
                Last updated: {{ $page->updated_at ? $page->updated_at->format('F d, Y') : date('F d, Y') }}
            </p>
        </div>

        <!-- Page Content Card -->
        <div class="bg-white border border-[#C8D8CF] rounded-3xl p-6 sm:p-10 shadow-xs prose max-w-none text-sm leading-relaxed text-[#17211D] space-y-4">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection
