<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_approved', true)->latest()->get();
        return view('testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'service_tag' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $validated['is_approved'] = false; // Requires admin approval in Filament

        Testimonial::create($validated);

        return back()->with('success', 'Thank you for sharing your experience! Your review has been submitted for verification.');
    }
}
