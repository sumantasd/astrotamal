<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Horoscope;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ContactInquiry;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::where('is_featured', true)->orderBy('sort_order')->get();
        $horoscopes = Horoscope::all();
        $blogPosts = BlogPost::where('is_featured', true)->latest()->take(3)->get();
        $testimonials = Testimonial::where('is_approved', true)->latest()->take(6)->get();
        $faqs = Faq::orderBy('sort_order')->get();

        return view('pages.home', compact('services', 'horoscopes', 'blogPosts', 'testimonials', 'faqs'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function kundli()
    {
        return view('pages.kundli');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service_interest' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactInquiry::create($validated);

        return back()->with('success', 'Thank you for your message. Tamal Chakraborty’s office will contact you shortly.');
    }

    public function showBookingPage()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('pages.book-consultation', compact('services'));
    }

    public function submitConsultation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'birth_date' => 'nullable|date',
            'birth_time' => 'nullable|string',
            'birth_place' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        Appointment::create($validated);

        return redirect()->route('consultation.book')->with('success', 'Your consultation booking request has been submitted successfully! Tamal Chakraborty’s office will contact you within 4 hours to confirm your slot.');
    }

    public function numerologyCalculator()
    {
        return view('pages.numerology-calculator');
    }

    public function mobileCalculator()
    {
        return view('pages.mobile-number-calculator');
    }

    public function kundaliCalculator()
    {
        return view('pages.kundali-calculator');
    }

    public function gallery()
    {
        return view('pages.gallery');
    }

    public function videos()
    {
        return view('pages.videos');
    }
}
