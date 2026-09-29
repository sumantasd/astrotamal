@extends('admin.layouts.app')

@section('title', 'FAQs Management')
@section('header_title', 'Frequently Asked Questions')
@section('header_subtitle', 'Add and manage client FAQ accordions')

@section('content')
<div class="space-y-8 max-w-5xl">

    <!-- Add FAQ Form -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-7 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#541F1D] mb-4">Add New FAQ</h3>

        <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="question" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1">Question</label>
                <input type="text" name="question" id="question" required 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]">
            </div>

            <div>
                <label for="answer" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1">Answer</label>
                <textarea name="answer" id="answer" rows="3" required 
                          class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-2.5 text-xs text-[#29211F]"></textarea>
            </div>

            <div class="pt-1">
                <button type="submit" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-xl">
                    Save FAQ
                </button>
            </div>
        </form>
    </div>

    <!-- FAQs List -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#541F1D] mb-4">Existing FAQs</h3>

        @if ($faqs->isEmpty())
            <div class="py-8 text-center text-xs text-[#81766D]">No FAQs created yet.</div>
        @else
            <div class="space-y-4">
                @foreach ($faqs as $faq)
                    <div class="p-4 border border-[#D8C6A8]/60 rounded-2xl bg-[#EDE3D4]/20 flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <div class="font-bold text-xs sm:text-sm text-[#541F1D]">{{ $faq->question }}</div>
                            <div class="text-xs text-[#29211F] leading-relaxed">{{ $faq->answer }}</div>
                        </div>

                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Delete this FAQ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-lg hover:bg-red-200 shrink-0">
                                Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
