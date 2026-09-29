<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    // Testimonials
    public function testimonials()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.content.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'city' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'service_tag' => 'nullable|string|max:100',
            'review' => 'required|string',
            'is_approved' => 'boolean',
        ]);

        $validated['is_approved'] = $request->has('is_approved');
        Testimonial::create($validated);

        return redirect()->back()->with('status', 'Testimonial added successfully.');
    }

    public function toggleTestimonial(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => ! $testimonial->is_approved]);
        return redirect()->back()->with('status', 'Testimonial approval status updated.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->back()->with('status', 'Testimonial deleted successfully.');
    }

    // FAQs
    public function faqs()
    {
        $faqs = Faq::orderBy('sort_order', 'asc')->get();
        return view('admin.content.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['integer'],
        ]);

        Faq::create($validated);

        return redirect()->back()->with('status', 'FAQ added successfully.');
    }

    public function destroyFaq(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->with('status', 'FAQ deleted successfully.');
    }

    // Contact Inquiries
    public function inquiries(Request $request)
    {
        $query = ContactInquiry::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $inquiries = $query->latest()->paginate(15)->withQueryString();
        return view('admin.content.inquiries', compact('inquiries'));
    }

    public function updateInquiryStatus(Request $request, ContactInquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'max:50'],
        ]);

        $inquiry->update(['status' => $validated['status']]);

        return redirect()->back()->with('status', 'Inquiry status updated.');
    }
}
