<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TestimonialController;

// Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/kundli', [PageController::class, 'kundli'])->name('kundli');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
// Consultation Booking
Route::get('/book-consultation', [PageController::class, 'showBookingPage'])->name('consultation.book');
Route::post('/book-consultation', [PageController::class, 'submitConsultation'])->name('consultation.submit');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Horoscope & Zodiac
Route::get('/horoscope', [HoroscopeController::class, 'index'])->name('horoscope.index');
Route::get('/horoscope/{slug}/{period?}', [HoroscopeController::class, 'show'])->name('horoscope.show');

// Blog & Insights
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

// Calculators & Media (More Dropdown)
Route::get('/numerology-calculator', [PageController::class, 'numerologyCalculator'])->name('numerology.calculator');
Route::get('/mobile-number-calculator', [PageController::class, 'mobileCalculator'])->name('mobile.calculator');
Route::get('/kundali-calculator', [PageController::class, 'kundaliCalculator'])->name('kundali.calculator');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/videos', [PageController::class, 'videos'])->name('videos');

