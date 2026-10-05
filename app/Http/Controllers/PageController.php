<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Horoscope;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ContactInquiry;
use App\Models\Appointment;
use App\Models\PaymentSetting;
use App\Services\BookingService;
use App\Services\RazorpaySettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::where('is_featured', true)->orderBy('sort_order')->get();
        $horoscopes = Horoscope::all();
        $blogPosts = BlogPost::where('is_featured', true)->latest()->take(3)->get();
        $testimonials = Testimonial::where('is_approved', true)->latest()->take(6)->get();
        $faqs = Faq::orderBy('sort_order')->get();
        
        $homeFeatures = \App\Models\HomeFeature::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();

        $latestVideos = \App\Models\MediaItem::where('is_published', true)
            ->where('show_on_home', true)
            ->whereIn('type', ['youtube', 'video'])
            ->orderBy('sort_order', 'asc')
            ->latest('id')
            ->take(6)
            ->get();

        return view('pages.home', compact('services', 'horoscopes', 'blogPosts', 'testimonials', 'faqs', 'homeFeatures', 'latestVideos'));
    }

    public function about()
    {
        $cmsPage = \App\Models\CmsPage::where('slug', 'about')->first();
        $guidanceItems = \App\Models\AboutGuidanceItem::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();

        return view('pages.about', compact('cmsPage', 'guidanceItems'));
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

    public function getAvailableSlots(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));
        $data = BookingService::getAvailableSlotsForDate($date);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function submitConsultation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'birth_date' => 'required|date',
            'birth_time' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (!empty($value) && strtotime(trim($value)) === false) {
                        $fail('The birth time format is invalid. Please enter a valid time (e.g., 08:30 AM or 23:18).');
                    }
                },
            ],
            'birth_place' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
            'consultation_type' => 'required|string|in:urgent,normal,Urgent,Normal',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|string',
            'notes' => 'nullable|string|max:1000',
            'create_account' => 'nullable|boolean',
            'password' => 'required_if:create_account,1|nullable|string|min:8|confirmed',
            'terms_consent' => 'accepted',
        ]);

        // Optional customer account creation during booking
        if (!auth()->check() && $request->boolean('create_account')) {
            if (empty($validated['email'])) {
                return back()->withInput()->withErrors([
                    'email' => 'An email address is required to create a customer account.',
                ]);
            }

            $existingUser = \App\Models\User::where('email', $validated['email'])->first();
            if ($existingUser) {
                return back()->withInput()->withErrors([
                    'email' => 'An account with this email address already exists. Please log in first or uncheck account creation.',
                ]);
            }

            $user = \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'is_admin' => false,
                'is_active' => true,
            ]);

            BookingService::sendWelcomeEmail($user);

            // Link any past bookings with matching email to this new user account
            Appointment::where('email', $user->email)->whereNull('user_id')->update(['user_id' => $user->id]);

            auth()->login($user);
            $request->session()->regenerate();
        }

        $type = strtolower($validated['consultation_type']);
        $slot = $validated['preferred_time'];
        $date = $validated['preferred_date'];

        $tz = 'Asia/Kolkata';
        $today = \Carbon\Carbon::now($tz)->format('Y-m-d');
        $tomorrow = \Carbon\Carbon::now($tz)->addDays(1)->format('Y-m-d');

        if ($date < $today) {
            return back()->withInput()->withErrors([
                'preferred_date' => 'Cannot select a past date for consultation.',
            ]);
        }

        if ($type === 'urgent') {
            if ($date > $tomorrow) {
                return back()->withInput()->withErrors([
                    'preferred_date' => 'Urgent consultations must be scheduled within 24 hours (today or tomorrow).',
                ]);
            }
            if (str_contains($slot, '02:00 PM') || str_contains($slot, '05:00 PM')) {
                return back()->withInput()->withErrors([
                    'preferred_time' => 'Urgent consultations are available for morning time slots only.',
                ]);
            }
        } elseif ($type === 'normal') {
            if ($date === $today) {
                return back()->withInput()->withErrors([
                    'preferred_date' => 'Normal consultations must be booked at least 24 hours in advance. Please select tomorrow or a later date.',
                ]);
            }
            $maxNormalDate = \Carbon\Carbon::now($tz)->addDays(30)->format('Y-m-d');
            if ($date > $maxNormalDate) {
                return back()->withInput()->withErrors([
                    'preferred_date' => 'Normal consultations can only be scheduled up to 30 days in advance.',
                ]);
            }
            if (str_contains($slot, '10:00 AM') || str_contains($slot, '01:00 PM')) {
                return back()->withInput()->withErrors([
                    'preferred_time' => 'Normal consultations are available for afternoon time slots only.',
                ]);
            }
        }

        // Validate slot availability server-side
        $isAvailable = BookingService::isSlotAvailable($validated['preferred_date'], $validated['preferred_time']);
        if (!$isAvailable) {
            return back()->withInput()->withErrors([
                'preferred_time' => 'The selected date and time slot is no longer available. Please select another slot.',
            ]);
        }

        // Create Pending Booking with 15-min slot reservation
        $appointment = BookingService::createPendingBooking($validated);

        // Redirect to Checkout page
        return redirect()->route('consultation.checkout', ['reference' => $appointment->booking_reference]);
    }

    public function showCheckout($reference)
    {
        $appointment = Appointment::where('booking_reference', $reference)->firstOrFail();

        // Check if already paid
        if ($appointment->payment_status === 'Paid') {
            return redirect()->route('consultation.confirmation', ['reference' => $appointment->booking_reference]);
        }

        // Check if slot reservation expired
        $isExpired = false;
        if ($appointment->status === 'Expired' || ($appointment->slot_reserved_until && now()->gt($appointment->slot_reserved_until))) {
            $isExpired = true;
            BookingService::markPaymentExpired($appointment);
        }

        $razorpayKey = RazorpaySettingsService::getKeyId();
        $testMode = RazorpaySettingsService::isTestMode();

        return view('pages.checkout', compact('appointment', 'isExpired', 'razorpayKey', 'testMode'));
    }

    public function createRazorpayOrder(Request $request)
    {
        $request->validate([
            'booking_reference' => 'required|string|exists:appointments,booking_reference',
        ]);

        $appointment = Appointment::where('booking_reference', $request->booking_reference)->firstOrFail();

        // Check if already confirmed/paid
        if ($appointment->payment_status === 'Paid' || $appointment->status === 'Confirmed') {
            return response()->json([
                'success' => false,
                'message' => 'This consultation booking is already confirmed and paid.',
            ], 400);
        }

        // Check slot reservation expiry
        if ($appointment->status === 'Expired' || ($appointment->slot_reserved_until && now()->gt($appointment->slot_reserved_until))) {
            BookingService::markPaymentExpired($appointment);
            return response()->json([
                'success' => false,
                'message' => 'Your 15-minute slot reservation has expired. Please select a new date and time.',
            ], 422);
        }

        // Recheck slot availability
        $isAvailable = BookingService::isSlotAvailable(
            $appointment->preferred_date->format('Y-m-d'),
            $appointment->preferred_time,
            $appointment->id
        );

        if (!$isAvailable) {
            return response()->json([
                'success' => false,
                'message' => 'The selected consultation slot is no longer available.',
            ], 422);
        }

        // Recalculate trusted server-side amount (never trust client)
        $amount = BookingService::getConsultationPrice($appointment->consultation_type);
        $amountInPaise = (int) round($amount * 100);

        $razorpayKey = RazorpaySettingsService::getKeyId();
        $razorpaySecret = RazorpaySettingsService::getKeySecret();

        $orderId = null;

        if (!empty($razorpayKey) && !empty($razorpaySecret)) {
            try {
                $response = Http::withBasicAuth($razorpayKey, $razorpaySecret)
                    ->timeout(10)
                    ->post('https://api.razorpay.com/v1/orders', [
                        'amount' => $amountInPaise,
                        'currency' => 'INR',
                        'receipt' => $appointment->booking_reference,
                        'notes' => [
                            'booking_reference' => $appointment->booking_reference,
                            'consultation_type' => $appointment->consultation_type,
                            'client_name' => $appointment->name,
                        ],
                    ]);

                if ($response->successful()) {
                    $orderData = $response->json();
                    $orderId = $orderData['id'] ?? null;
                } else {
                    Log::warning('Razorpay Order API response error: ' . $response->body());
                }
            } catch (\Throwable $e) {
                Log::error('Razorpay Order creation exception: ' . $e->getMessage());
            }
        }

        // Fallback order ID for testing / offline / sandbox when API response is unavailable
        if (empty($orderId)) {
            $orderId = 'ord_' . strtolower(Str::random(14));
        }

        return response()->json([
            'success' => true,
            'key' => $razorpayKey,
            'order_id' => $orderId,
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'name' => 'GANESHA ASTRO CONSULTANCY',
            'description' => $appointment->consultation_type . ' Consultation with Tamal Chakraborty',
            'prefill' => [
                'name' => $appointment->name,
                'email' => $appointment->email,
                'contact' => $appointment->phone,
            ],
            'booking_reference' => $appointment->booking_reference,
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'booking_reference' => 'required|string|exists:appointments,booking_reference',
            'payment_id' => 'required|string',
            'gateway' => 'nullable|string',
            'signature' => 'nullable|string',
            'order_id' => 'nullable|string',
        ]);

        $appointment = Appointment::where('booking_reference', $request->booking_reference)->firstOrFail();
        $gateway = $request->input('gateway', 'Razorpay');
        $paymentId = $request->input('payment_id');
        $orderId = $request->input('order_id');
        $signature = $request->input('signature');

        $razorpaySecret = RazorpaySettingsService::getKeySecret();

        // Server-Side Verification
        if ($gateway === 'Razorpay' && !empty($signature) && !empty($razorpaySecret) && !empty($orderId)) {
            $expectedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $razorpaySecret);

            if (!hash_equals($expectedSignature, $signature)) {
                Log::warning('Razorpay payment signature mismatch for booking: ' . $appointment->booking_reference);
                BookingService::markPaymentFailed($appointment, 'Razorpay', $orderId, 'Invalid signature match');

                if ($request->expectsJson() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment verification failed: Invalid transaction signature.',
                    ], 422);
                }

                return redirect()->route('consultation.checkout', ['reference' => $appointment->booking_reference])
                    ->with('error', 'Payment verification failed: Invalid transaction signature.');
            }
        }

        // Confirm booking & payment atomically
        BookingService::confirmPaymentAndBooking(
            $appointment,
            $paymentId,
            $gateway,
            $orderId,
            $request->all()
        );

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('consultation.confirmation', ['reference' => $appointment->booking_reference]),
            ]);
        }

        return redirect()->route('consultation.confirmation', ['reference' => $appointment->booking_reference]);
    }

    public function showConfirmation($reference)
    {
        $appointment = Appointment::where('booking_reference', $reference)->firstOrFail();

        return view('pages.confirmation', compact('appointment'));
    }

    public function downloadReceiptPdf($reference)
    {
        $appointment = Appointment::where('booking_reference', $reference)->firstOrFail();

        if ($appointment->payment_status !== 'Paid' || $appointment->status !== 'Confirmed') {
            return redirect()->route('consultation.confirmation', ['reference' => $reference])
                ->with('error', 'Official receipts are only generated for confirmed and paid consultations.');
        }

        $transaction = \App\Models\PaymentTransaction::where('appointment_id', $appointment->id)
            ->where('status', 'Success')
            ->latest()
            ->first();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.receipt', compact('appointment', 'transaction'))
            ->setPaper('a4', 'portrait');

        $fileName = 'AstroTamal-Receipt-' . $appointment->booking_reference . '.pdf';

        return $pdf->download($fileName);
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
        $cmsPage = \App\Models\CmsPage::where('slug', 'gallery')->first();
        $mediaItems = \App\Models\MediaItem::where('is_published', true)
            ->where('publish_gallery', true)
            ->where('type', 'image')
            ->orderBy('sort_order', 'asc')
            ->latest('id')
            ->get();
        return view('pages.gallery', compact('cmsPage', 'mediaItems'));
    }

    public function videos()
    {
        $cmsPage = \App\Models\CmsPage::where('slug', 'videos')->first();
        $videos = \App\Models\MediaItem::where('is_published', true)
            ->where('publish_videos', true)
            ->whereIn('type', ['youtube', 'video'])
            ->orderBy('sort_order', 'asc')
            ->latest('id')
            ->get();
        return view('pages.videos', compact('cmsPage', 'videos'));
    }

    public function shop()
    {
        $categories = \App\Models\ShopCategory::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.shop', compact('categories'));
    }
}
