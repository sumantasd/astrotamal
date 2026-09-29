@extends('admin.layouts.app')

@section('title', 'Blog Article Management')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#541F1D]">Blog & Insights Management</h1>
            <p class="text-xs sm:text-sm text-[#81766D] mt-1">Publish astrological articles, planetary transit guides, and Vastu insights.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 transition-all shadow-md flex items-center shrink-0">
            <svg class="w-4 h-4 mr-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Write New Post
        </a>
    </div>

    <!-- Posts Table -->
    <div class="bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8] shadow-xs overflow-hidden">
        @if($posts->isEmpty())
            <div class="p-12 text-center text-[#81766D]">
                <p class="text-sm font-semibold text-[#29211F]">No blog articles found</p>
                <p class="text-xs text-[#81766D] mt-1">Click "Write New Post" to publish an astrological article.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 bg-[#EDE3D4]/30 text-[10px] font-bold tracking-wider text-[#541F1D] uppercase">
                            <th class="py-3.5 px-4">Article Title</th>
                            <th class="py-3.5 px-4">Category</th>
                            <th class="py-3.5 px-4">Author</th>
                            <th class="py-3.5 px-4">Published Date</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs">
                        @foreach($posts as $post)
                            <tr class="hover:bg-[#EDE3D4]/20 transition-colors">
                                <td class="py-3.5 px-4 font-bold text-[#541F1D] max-w-sm">
                                    <div class="truncate">{{ $post->title }}</div>
                                    <div class="text-[10px] text-[#81766D] font-normal truncate">/blog/{{ $post->slug }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-[#C49A45]/15 text-[#541F1D] border border-[#C49A45]/30">
                                        {{ $post->category }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-[#81766D]">
                                    {{ $post->author_name ?? 'Tamal Chakraborty' }}
                                </td>
                                <td class="py-3.5 px-4 text-[#81766D] text-[11px]">
                                    {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Draft' }}
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-2">
                                    <a href="{{ route('admin.blogs.edit', $post->id) }}" class="inline-block px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#EDE3D4] text-[#541F1D] hover:bg-[#541F1D] hover:text-[#F7F0E3] transition-all">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.blogs.destroy', $post->id) }}" class="inline-block" onsubmit="return confirm('Delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-red-100 text-red-700 hover:bg-red-700 hover:text-white transition-all">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-[#D8C6A8]/40">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
