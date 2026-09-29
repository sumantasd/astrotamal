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

// Consultation Booking & Verified Payment Workflow
Route::get('/book-consultation', [PageController::class, 'showBookingPage'])->name('consultation.book');
Route::post('/book-consultation', [PageController::class, 'submitConsultation'])->name('consultation.submit');
Route::get('/consultation/checkout/{reference}', [PageController::class, 'showCheckout'])->name('consultation.checkout');
Route::post('/consultation/payment/verify', [PageController::class, 'verifyPayment'])->name('consultation.payment.verify');
Route::get('/consultation/confirmation/{reference}', [PageController::class, 'showConfirmation'])->name('consultation.confirmation');
Route::get('/consultation/receipt/{reference}/pdf', [PageController::class, 'downloadReceiptPdf'])->name('consultation.receipt.pdf');

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

// Custom Admin Routes
use App\Http\Controllers\Admin\AuthController as CustomAdminAuthController;
use App\Http\Controllers\Admin\DashboardController as CustomAdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as CustomAdminProfileController;
use App\Http\Controllers\Admin\AppointmentController as CustomAdminAppointmentController;
use App\Http\Controllers\Admin\PaymentController as CustomAdminPaymentController;
use App\Http\Controllers\Admin\BlockedSlotController as CustomAdminBlockedSlotController;
use App\Http\Controllers\Admin\ServiceController as CustomAdminServiceController;
use App\Http\Controllers\Admin\AdminUserController as CustomAdminUserController;
use App\Http\Controllers\Admin\ContentController as CustomAdminContentController;
use App\Http\Controllers\Admin\HoroscopeController as CustomAdminHoroscopeController;
use App\Http\Controllers\Admin\CmsPageController as CustomAdminCmsPageController;
use App\Http\Controllers\Admin\SettingsController as CustomAdminSettingsController;
use App\Http\Controllers\Admin\MediaController as CustomAdminMediaController;
use App\Http\Controllers\Admin\BlogController as CustomAdminBlogController;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::prefix('custom-admin')->name('admin.')->group(function () {
    Route::get('/login', [CustomAdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomAdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [CustomAdminAuthController::class, 'logout'])->name('logout');

    Route::middleware([EnsureUserIsAdmin::class])->group(function () {
        Route::get('/dashboard', [CustomAdminDashboardController::class, 'index'])->name('dashboard');

        // Profile & Security
        Route::get('/profile', [CustomAdminProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [CustomAdminProfileController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/password', [CustomAdminProfileController::class, 'updatePassword'])->name('profile.password');

        // Appointments / Bookings
        Route::get('/appointments', [CustomAdminAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/{appointment}', [CustomAdminAppointmentController::class, 'show'])->name('appointments.show');
        Route::put('/appointments/{appointment}', [CustomAdminAppointmentController::class, 'update'])->name('appointments.update');

        // Payments
        Route::get('/payments', [CustomAdminPaymentController::class, 'transactions'])->name('payments.transactions');
        Route::get('/payment-settings', [CustomAdminPaymentController::class, 'settings'])->name('payments.settings');
        Route::post('/payment-settings', [CustomAdminPaymentController::class, 'updateSettings'])->name('payments.settings.update');

        // Blocked Slots
        Route::get('/blocked-slots', [CustomAdminBlockedSlotController::class, 'index'])->name('blocked-slots.index');
        Route::post('/blocked-slots', [CustomAdminBlockedSlotController::class, 'store'])->name('blocked-slots.store');
        Route::delete('/blocked-slots/{blockedSlot}', [CustomAdminBlockedSlotController::class, 'destroy'])->name('blocked-slots.destroy');

        // Services
        Route::resource('services', CustomAdminServiceController::class)->except(['show']);

        // Horoscope Management
        Route::get('/horoscopes/signs', [CustomAdminHoroscopeController::class, 'zodiacSigns'])->name('horoscopes.signs');
        Route::post('/horoscopes/signs/{horoscope}', [CustomAdminHoroscopeController::class, 'updateZodiacSign'])->name('horoscopes.signs.update');
        Route::resource('horoscopes', CustomAdminHoroscopeController::class);

        // Page & Section Manager
        Route::get('/pages', [CustomAdminCmsPageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{slug}/edit', [CustomAdminCmsPageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{slug}', [CustomAdminCmsPageController::class, 'update'])->name('pages.update');

        // Website Configuration Settings
        Route::get('/settings', [CustomAdminSettingsController::class, 'index'])->name('settings.index');
        Route::get('/settings/general', [CustomAdminSettingsController::class, 'general'])->name('settings.general');
        Route::get('/settings/header', [CustomAdminSettingsController::class, 'header'])->name('settings.header');
        Route::get('/settings/footer', [CustomAdminSettingsController::class, 'footer'])->name('settings.footer');
        Route::get('/settings/seo', [CustomAdminSettingsController::class, 'seo'])->name('settings.seo');
        Route::post('/settings', [CustomAdminSettingsController::class, 'update'])->name('settings.update');

        // Media Manager (Gallery & Videos)
        Route::resource('media', CustomAdminMediaController::class)->except(['create', 'show', 'edit']);

        // Blog Management
        Route::resource('blogs', CustomAdminBlogController::class);

        // Users
        Route::resource('users', CustomAdminUserController::class)->except(['show']);

        // Testimonials, FAQs, Inquiries
        Route::get('/testimonials', [CustomAdminContentController::class, 'testimonials'])->name('testimonials.index');
        Route::post('/testimonials', [CustomAdminContentController::class, 'storeTestimonial'])->name('testimonials.store');
        Route::post('/testimonials/{testimonial}/toggle', [CustomAdminContentController::class, 'toggleTestimonial'])->name('testimonials.toggle');
        Route::delete('/testimonials/{testimonial}', [CustomAdminContentController::class, 'destroyTestimonial'])->name('testimonials.destroy');
        Route::get('/faqs', [CustomAdminContentController::class, 'faqs'])->name('faqs.index');
        Route::post('/faqs', [CustomAdminContentController::class, 'storeFaq'])->name('faqs.store');
        Route::delete('/faqs/{faq}', [CustomAdminContentController::class, 'destroyFaq'])->name('faqs.destroy');
        Route::get('/contact-inquiries', [CustomAdminContentController::class, 'inquiries'])->name('inquiries.index');
        Route::post('/contact-inquiries/{inquiry}/status', [CustomAdminContentController::class, 'updateInquiryStatus'])->name('inquiries.status');
    });
});

// Redirect legacy /admin URLs to Custom Admin
Route::redirect('/admin', '/custom-admin/login');
Route::redirect('/admin/login', '/custom-admin/login');
