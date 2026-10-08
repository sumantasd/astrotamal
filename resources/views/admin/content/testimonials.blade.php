@extends('admin.layouts.app')

@section('title', 'Testimonials Moderation & Management')

@section('content')
<div class="space-y-6 max-w-5xl" x-data="{ addModal: false }">

    <div class="flex items-center justify-between bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#0B3D2E]">Testimonials & Reviews</h1>
            <p class="text-xs text-[#60736B] mt-1">Approve client reviews or manually add new testimonials to display on the public website.</p>
        </div>
        <button @click="addModal = true" class="px-4 py-2 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] border border-[#C49A45]/40 transition-all shadow-md flex items-center shrink-0">
            <svg class="w-4 h-4 mr-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Testimonial
        </button>
    </div>

    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 shadow-xs">
        @if ($testimonials->isEmpty())
            <div class="py-12 text-center text-xs text-[#60736B]">No testimonials submitted yet.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#C8D8CF]/60 text-[11px] font-bold uppercase tracking-wider text-[#60736B]">
                            <th class="pb-3 px-3">Client</th>
                            <th class="pb-3 px-3">Rating</th>
                            <th class="pb-3 px-3">Review Text</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C8D8CF]/30 text-xs text-[#17211D]">
                        @foreach ($testimonials as $t)
                            <tr class="hover:bg-[#F3F8F5] transition-colors">
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[#0B3D2E]">{{ $t->client_name }}</div>
                                    <div class="text-[11px] text-[#60736B]">{{ $t->city ?? 'Client' }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-bold text-amber-600">
                                    ★ {{ $t->rating }}/5
                                </td>
                                <td class="py-3.5 px-3 text-[#17211D] max-w-md">
                                    {{ Str::limit($t->review, 120) }}
                                </td>
                                <td class="py-3.5 px-3">
                                    @if ($t->is_approved)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-3 text-right space-x-2">
                                    <form method="POST" action="{{ route('admin.testimonials.toggle', $t) }}" class="inline-block">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 text-xs font-bold rounded-lg {{ $t->is_approved ? 'bg-amber-100 text-amber-900 hover:bg-amber-200' : 'bg-emerald-100 text-emerald-900 hover:bg-emerald-200' }}">
                                            {{ $t->is_approved ? 'Unpublish' : 'Approve' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" class="inline-block" onsubmit="return confirm('Delete this testimonial?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 text-xs font-semibold rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $testimonials->links() }}
            </div>
        @endif
    </div>

    <!-- Add Testimonial Modal -->
    <div x-show="addModal" class="fixed inset-0 z-50 bg-black/60 flex items-center justify-center p-4" style="display: none;">
        <div class="bg-[#FFFFFF] max-w-md w-full p-6 rounded-2xl border border-[#C8D8CF] shadow-xl space-y-4" @click.away="addModal = false">
            <h2 class="text-base font-bold font-serif-luxury text-[#0B3D2E]">Add Client Testimonial</h2>

            <form method="POST" action="{{ route('admin.testimonials.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Client Name *</label>
                    <input type="text" name="client_name" required class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">City / Location</label>
                        <input type="text" name="city" placeholder="e.g. Kolkata" class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Star Rating *</label>
                        <select name="rating" required class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none">
                            <option value="5">5 Stars ★★★★★</option>
                            <option value="4">4 Stars ★★★★☆</option>
                            <option value="3">3 Stars ★★★☆☆</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Testimonial Review Text *</label>
                    <textarea name="review" rows="4" required class="w-full px-3 py-2 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none"></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 text-xs font-bold text-[#0B3D2E]">
                        <input type="checkbox" name="is_approved" value="1" checked class="rounded text-[#0B3D2E]">
                        <span>Publish immediately</span>
                    </label>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43]">
                        Save Review
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
