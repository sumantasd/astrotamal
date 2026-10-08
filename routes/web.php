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
Route::get('/api/available-slots', [PageController::class, 'getAvailableSlots'])->name('consultation.slots');
Route::post('/book-consultation', [PageController::class, 'submitConsultation'])->name('consultation.submit');
Route::get('/consultation/checkout/{reference}', [PageController::class, 'showCheckout'])->name('consultation.checkout');
Route::post('/consultation/payment/create-order', [PageController::class, 'createRazorpayOrder'])->name('consultation.payment.create-order');
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
Route::get('/shop', [PageController::class, 'shop'])->name('shop');

// Legal Pages
use App\Http\Controllers\LegalPageController;
Route::get('/privacy-policy', [LegalPageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-and-conditions', [LegalPageController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/refund-policy', [LegalPageController::class, 'refundPolicy'])->name('refund.policy');
// Customer Account Routes
use App\Http\Controllers\AccountController;
use App\Http\Middleware\EnsureCustomerUser;

Route::get('/account/login', [AccountController::class, 'showLoginForm'])->name('account.login');
Route::post('/account/login', [AccountController::class, 'login'])->name('account.login.submit');
Route::get('/account/register', [AccountController::class, 'showRegisterForm'])->name('account.register');
Route::post('/account/register', [AccountController::class, 'register'])->name('account.register.submit');
Route::post('/account/logout', [AccountController::class, 'logout'])->name('account.logout');

Route::middleware([EnsureCustomerUser::class])->group(function () {
    Route::get('/account', [AccountController::class, 'dashboard'])->name('account.dashboard');
    Route::get('/account/bookings/{reference}', [AccountController::class, 'showBookingDetails'])->name('account.booking.show');
    Route::get('/account/profile', [AccountController::class, 'editProfile'])->name('account.profile');
    Route::put('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::get('/account/password', [AccountController::class, 'editPassword'])->name('account.password');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
});

// Backward compatible alias for /account route name
Route::get('/account-redirect', function () {
    return redirect()->route('account.dashboard');
})->name('account');

// Admin Routes (/admin-tamal/login)
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

Route::prefix('admin-tamal')->name('admin.')->group(function () {
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
        Route::delete('/appointments/{appointment}', [CustomAdminAppointmentController::class, 'destroy'])->name('appointments.destroy');

        // Payments
        Route::get('/payments', [CustomAdminPaymentController::class, 'transactions'])->name('payments.transactions');
        Route::get('/payments/{transaction}', [CustomAdminPaymentController::class, 'show'])->name('payments.show');
        Route::get('/payment-settings', [CustomAdminPaymentController::class, 'settings'])->name('payments.settings');
        Route::post('/payment-settings', [CustomAdminPaymentController::class, 'updateSettings'])->name('payments.settings.update');

        // Blocked Slots
        Route::get('/blocked-slots', [CustomAdminBlockedSlotController::class, 'index'])->name('blocked-slots.index');
        Route::post('/blocked-slots', [CustomAdminBlockedSlotController::class, 'store'])->name('blocked-slots.store');
        Route::put('/blocked-slots/{blockedSlot}', [CustomAdminBlockedSlotController::class, 'update'])->name('blocked-slots.update');
        Route::delete('/blocked-slots/{blockedSlot}', [CustomAdminBlockedSlotController::class, 'destroy'])->name('blocked-slots.destroy');

        // Booking Schedule & Overrides
        Route::get('/schedule', [\App\Http\Controllers\Admin\ScheduleController::class, 'index'])->name('schedule.index');
        Route::post('/schedule', [\App\Http\Controllers\Admin\ScheduleController::class, 'updateGlobal'])->name('schedule.update');
        Route::post('/schedule/override', [\App\Http\Controllers\Admin\ScheduleController::class, 'storeOverride'])->name('schedule.override.store');
        Route::delete('/schedule/override/{override}', [\App\Http\Controllers\Admin\ScheduleController::class, 'destroyOverride'])->name('schedule.override.destroy');

        // Services
        Route::resource('services', CustomAdminServiceController::class)->except(['show']);

        // Horoscope Management
        Route::get('/horoscopes/signs', [CustomAdminHoroscopeController::class, 'zodiacSigns'])->name('horoscopes.signs');
        Route::post('/horoscopes/signs/{horoscope}', [CustomAdminHoroscopeController::class, 'updateZodiacSign'])->name('horoscopes.signs.update');
        Route::resource('horoscopes', CustomAdminHoroscopeController::class);

        // Home Page CMS Management
        Route::get('/homepage', [\App\Http\Controllers\Admin\HomePageController::class, 'edit'])->name('homepage.edit');
        Route::post('/homepage/settings', [\App\Http\Controllers\Admin\HomePageController::class, 'updateSettings'])->name('homepage.settings.update');
        Route::post('/homepage/videos', [\App\Http\Controllers\Admin\HomePageController::class, 'storeVideo'])->name('homepage.videos.store');
        Route::put('/homepage/videos/{video}', [\App\Http\Controllers\Admin\HomePageController::class, 'updateVideo'])->name('homepage.videos.update');
        Route::delete('/homepage/videos/{video}', [\App\Http\Controllers\Admin\HomePageController::class, 'destroyVideo'])->name('homepage.videos.destroy');
        Route::post('/homepage/features', [\App\Http\Controllers\Admin\HomePageController::class, 'storeFeature'])->name('homepage.features.store');
        Route::put('/homepage/features/{feature}', [\App\Http\Controllers\Admin\HomePageController::class, 'updateFeature'])->name('homepage.features.update');
        Route::delete('/homepage/features/{feature}', [\App\Http\Controllers\Admin\HomePageController::class, 'destroyFeature'])->name('homepage.features.destroy');

        // About Page CMS Management
        Route::get('/about', [\App\Http\Controllers\Admin\AboutPageController::class, 'edit'])->name('about.edit');
        Route::post('/about/settings', [\App\Http\Controllers\Admin\AboutPageController::class, 'updateSettings'])->name('about.settings.update');
        Route::post('/about/guidance', [\App\Http\Controllers\Admin\AboutPageController::class, 'storeGuidanceItem'])->name('about.guidance.store');
        Route::put('/about/guidance/{item}', [\App\Http\Controllers\Admin\AboutPageController::class, 'updateGuidanceItem'])->name('about.guidance.update');
        Route::delete('/about/guidance/{item}', [\App\Http\Controllers\Admin\AboutPageController::class, 'destroyGuidanceItem'])->name('about.guidance.destroy');

        // Services Page CMS Management
        Route::get('/services-page', [\App\Http\Controllers\Admin\ServicesPageController::class, 'edit'])->name('services-page.edit');
        Route::post('/services-page/settings', [\App\Http\Controllers\Admin\ServicesPageController::class, 'updateSettings'])->name('services-page.settings.update');

        // Shop Management
        Route::get('/shop', [\App\Http\Controllers\Admin\ShopPageController::class, 'edit'])->name('shop.edit');
        Route::post('/shop/settings', [\App\Http\Controllers\Admin\ShopPageController::class, 'updateSettings'])->name('shop.settings.update');
        Route::post('/shop/categories', [\App\Http\Controllers\Admin\ShopPageController::class, 'storeCategory'])->name('shop.categories.store');
        Route::put('/shop/categories/{category}', [\App\Http\Controllers\Admin\ShopPageController::class, 'updateCategory'])->name('shop.categories.update');
        Route::delete('/shop/categories/{category}', [\App\Http\Controllers\Admin\ShopPageController::class, 'destroyCategory'])->name('shop.categories.destroy');

        // Page & Section Manager
        Route::get('/pages', [CustomAdminCmsPageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{slug}/edit', [CustomAdminCmsPageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{slug}', [CustomAdminCmsPageController::class, 'update'])->name('pages.update');

        // Website Configuration Settings
        Route::get('/settings', [CustomAdminSettingsController::class, 'index'])->name('settings.index');
        Route::get('/settings/general', [CustomAdminSettingsController::class, 'general'])->name('settings.general');
        Route::post('/settings/general', [CustomAdminSettingsController::class, 'updateGeneral'])->name('settings.general.update');
        Route::get('/settings/header', [\App\Http\Controllers\Admin\HeaderSettingsController::class, 'index'])->name('settings.header');
        Route::post('/settings/header/general', [\App\Http\Controllers\Admin\HeaderSettingsController::class, 'updateGeneral'])->name('settings.header.update-general');
        Route::post('/settings/header/navigation', [\App\Http\Controllers\Admin\HeaderSettingsController::class, 'storeNavItem'])->name('settings.header.nav.store');
        Route::put('/settings/header/navigation/{navigationItem}', [\App\Http\Controllers\Admin\HeaderSettingsController::class, 'updateNavItem'])->name('settings.header.nav.update');
        Route::delete('/settings/header/navigation/{navigationItem}', [\App\Http\Controllers\Admin\HeaderSettingsController::class, 'destroyNavItem'])->name('settings.header.nav.destroy');
        Route::post('/settings/header/reset', [\App\Http\Controllers\Admin\HeaderSettingsController::class, 'resetToDefault'])->name('settings.header.reset');
        Route::get('/settings/footer', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'index'])->name('settings.footer');
        Route::post('/settings/footer/general', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'updateGeneral'])->name('settings.footer.update-general');
        Route::post('/settings/footer/nav', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'storeNavItem'])->name('settings.footer.nav.store');
        Route::put('/settings/footer/nav/{item}', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'updateNavItem'])->name('settings.footer.nav.update');
        Route::delete('/settings/footer/nav/{item}', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'destroyNavItem'])->name('settings.footer.nav.destroy');
        Route::post('/settings/footer/guidance', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'storeGuidanceItem'])->name('settings.footer.guidance.store');
        Route::put('/settings/footer/guidance/{item}', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'updateGuidanceItem'])->name('settings.footer.guidance.update');
        Route::delete('/settings/footer/guidance/{item}', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'destroyGuidanceItem'])->name('settings.footer.guidance.destroy');
        Route::post('/settings/footer/social', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'storeSocialLink'])->name('settings.footer.social.store');
        Route::put('/settings/footer/social/{socialLink}', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'updateSocialLink'])->name('settings.footer.social.update');
        Route::delete('/settings/footer/social/{socialLink}', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'destroySocialLink'])->name('settings.footer.social.destroy');
        Route::put('/settings/footer/legal/{page}', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'updateLegalPage'])->name('settings.footer.legal.update');
        Route::post('/settings/footer/reset', [\App\Http\Controllers\Admin\FooterSettingsController::class, 'resetToDefault'])->name('settings.footer.reset');
        Route::get('/settings/seo', [CustomAdminSettingsController::class, 'seo'])->name('settings.seo');
        Route::post('/settings/seo', [CustomAdminSettingsController::class, 'updateSeo'])->name('settings.seo.update');
        Route::get('/settings/sidebar', [\App\Http\Controllers\Admin\SidebarSettingsController::class, 'index'])->name('settings.sidebar');
        Route::post('/settings/sidebar', [\App\Http\Controllers\Admin\SidebarSettingsController::class, 'update'])->name('settings.sidebar.update');
        Route::get('/settings/backup', [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('settings.backup.index');
        Route::post('/settings/backup/create', [\App\Http\Controllers\Admin\BackupController::class, 'create'])->name('settings.backup.create');
        Route::get('/settings/backup/{backup}/download', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('settings.backup.download');
        Route::post('/settings/backup/{backup}/restore', [\App\Http\Controllers\Admin\BackupController::class, 'restore'])->name('settings.backup.restore');
        Route::post('/settings/backup/upload-restore', [\App\Http\Controllers\Admin\BackupController::class, 'uploadAndRestore'])->name('settings.backup.upload-restore');
        Route::delete('/settings/backup/{backup}', [\App\Http\Controllers\Admin\BackupController::class, 'destroy'])->name('settings.backup.destroy');
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

// Redirect legacy /admin & /custom-admin URLs to /admin-tamal/login
Route::redirect('/admin', '/admin-tamal/login');
Route::redirect('/admin/login', '/admin-tamal/login');
Route::redirect('/custom-admin', '/admin-tamal/login');
Route::redirect('/custom-admin/login', '/admin-tamal/login');
