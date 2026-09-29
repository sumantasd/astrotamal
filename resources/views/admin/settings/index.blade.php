@extends('admin.layouts.app')

@section('title', 'Website Configuration')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#541F1D]">Website Configuration</h1>
            <p class="text-xs sm:text-sm text-[#81766D] mt-1">Configure global site settings, contact details, social links, headers, footers, and SEO defaults.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- General Settings Card -->
        <a href="{{ route('admin.settings.general') }}" class="bg-[#FDFBF7] p-5 rounded-2xl border border-[#D8C6A8] shadow-xs hover:border-[#C49A45] hover:shadow-md transition-all space-y-3 block group">
            <div class="w-10 h-10 rounded-xl bg-[#541F1D] text-[#C49A45] flex items-center justify-center font-bold border border-[#C49A45]/40 group-hover:scale-105 transition-transform">
                ⚙️
            </div>
            <h3 class="text-base font-bold font-serif-luxury text-[#541F1D] group-hover:text-[#C49A45] transition-colors">General Settings</h3>
            <p class="text-xs text-[#81766D]">Site name, tagline, email, phone, WhatsApp number, and office chamber address.</p>
        </a>

        <!-- Header & Nav Card -->
        <a href="{{ route('admin.settings.header') }}" class="bg-[#FDFBF7] p-5 rounded-2xl border border-[#D8C6A8] shadow-xs hover:border-[#C49A45] hover:shadow-md transition-all space-y-3 block group">
            <div class="w-10 h-10 rounded-xl bg-[#541F1D] text-[#C49A45] flex items-center justify-center font-bold border border-[#C49A45]/40 group-hover:scale-105 transition-transform">
                🧭
            </div>
            <h3 class="text-base font-bold font-serif-luxury text-[#541F1D] group-hover:text-[#C49A45] transition-colors">Header & Navigation</h3>
            <p class="text-xs text-[#81766D]">Header announcement bar, top phone display, and main navigation links.</p>
        </a>

        <!-- Footer Manager Card -->
        <a href="{{ route('admin.settings.footer') }}" class="bg-[#FDFBF7] p-5 rounded-2xl border border-[#D8C6A8] shadow-xs hover:border-[#C49A45] hover:shadow-md transition-all space-y-3 block group">
            <div class="w-10 h-10 rounded-xl bg-[#541F1D] text-[#C49A45] flex items-center justify-center font-bold border border-[#C49A45]/40 group-hover:scale-105 transition-transform">
                📜
            </div>
            <h3 class="text-base font-bold font-serif-luxury text-[#541F1D] group-hover:text-[#C49A45] transition-colors">Footer Manager</h3>
            <p class="text-xs text-[#81766D]">Footer description, quick links, copyright notice, and social media URLs.</p>
        </a>

        <!-- SEO Settings Card -->
        <a href="{{ route('admin.settings.seo') }}" class="bg-[#FDFBF7] p-5 rounded-2xl border border-[#D8C6A8] shadow-xs hover:border-[#C49A45] hover:shadow-md transition-all space-y-3 block group">
            <div class="w-10 h-10 rounded-xl bg-[#541F1D] text-[#C49A45] flex items-center justify-center font-bold border border-[#C49A45]/40 group-hover:scale-105 transition-transform">
                🔍
            </div>
            <h3 class="text-base font-bold font-serif-luxury text-[#541F1D] group-hover:text-[#C49A45] transition-colors">SEO & Meta Tags</h3>
            <p class="text-xs text-[#81766D]">Default site title, Open Graph image, meta keywords, and search engine controls.</p>
        </a>

    </div>

</div>
@endsection
