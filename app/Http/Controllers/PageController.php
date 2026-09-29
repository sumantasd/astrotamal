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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'preferred_time' => [
                'required',
                'string',
                \Illuminate\Validation\Rule::in([
                    '10:00 AM - 01:00 PM IST',
                    '02:00 PM - 05:00 PM IST',
                    '06:00 PM - 09:00 PM IST',
                ]),
            ],
            'notes' => 'nullable|string|max:1000',
            'terms_consent' => 'accepted',
        ]);

        $type = strtolower($validated['consultation_type']);
        $slot = $validated['preferred_time'];
        $date = $validated['preferred_date'];

        // Urgent vs Normal slot & schedule enforcement
        $urgentSlot = '10:00 AM - 01:00 PM IST';
        $normalSlots = ['02:00 PM - 05:00 PM IST', '06:00 PM - 09:00 PM IST'];

        $tz = 'Asia/Kolkata';
        $today = \Carbon\Carbon::now($tz)->format('Y-m-d');
        $tomorrow = \Carbon\Carbon::now($tz)->addDays(1)->format('Y-m-d');

        if ($date < $today) {
            return back()->withInput()->withErrors([
                'preferred_date' => 'Cannot select a past date for consultation.',
            ]);
        }

        if ($type === 'urgent') {
            if ($slot !== $urgentSlot) {
                return back()->withInput()->withErrors([
                    'preferred_time' => 'Urgent consultations are only available for the Morning slot (10:00 AM - 01:00 PM IST).',
                ]);
            }
            if ($date > $tomorrow) {
                return back()->withInput()->withErrors([
                    'preferred_date' => 'Urgent consultations must be scheduled within 24 hours (today or tomorrow).',
                ]);
            }
        } elseif ($type === 'normal') {
            if ($date < $tomorrow) {
                return back()->withInput()->withErrors([
                    'preferred_date' => 'Normal consultations must be booked at least 1 day in advance (starting from tomorrow). Today is reserved for Urgent consultations.',
                ]);
            }
            if (!in_array($slot, $normalSlots, true)) {
                return back()->withInput()->withErrors([
                    'preferred_time' => 'The selected slot is reserved for Urgent consultations. Normal consultations must select an Afternoon or Evening slot.',
                ]);
            }
            $maxNormalDate = \Carbon\Carbon::now($tz)->addDays(7)->format('Y-m-d');
            if ($date > $maxNormalDate) {
                return back()->withInput()->withErrors([
                    'preferred_date' => 'Normal consultations can only be scheduled up to 7 days in advance.',
                ]);
            }
        }

        // Validate slot availability
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
        if ($appointment->slot_reserved_until && now()->gt($appointment->slot_reserved_until)) {
            $isExpired = true;
        }

        $razorpayKey = PaymentSetting::get('razorpay_key_id', config('services.razorpay.key', ''));
        $testMode = PaymentSetting::get('razorpay_test_mode', '1') === '1';

        return view('pages.checkout', compact('appointment', 'isExpired', 'razorpayKey', 'testMode'));
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

        $razorpaySecret = PaymentSetting::get('razorpay_key_secret', config('services.razorpay.secret', ''));

        // Server-Side Verification
        if ($gateway === 'Razorpay' && !empty($signature) && !empty($razorpaySecret)) {
            $expectedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $razorpaySecret);

            if (!hash_equals($expectedSignature, $signature)) {
                Log::warning('Razorpay payment signature mismatch for booking: ' . $appointment->booking_reference);
                BookingService::markPaymentFailed($appointment, 'Razorpay', $orderId, 'Invalid signature match');

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
        $mediaItems = \App\Models\MediaItem::where('is_published', true)->where('type', 'image')->orderBy('sort_order')->latest()->get();
        return view('pages.gallery', compact('cmsPage', 'mediaItems'));
    }

    public function videos()
    {
        $cmsPage = \App\Models\CmsPage::where('slug', 'videos')->first();
        $mediaItems = \App\Models\MediaItem::where('is_published', true)->whereIn('type', ['video', 'youtube'])->orderBy('sort_order')->latest()->get();
        return view('pages.videos', compact('cmsPage', 'mediaItems'));
    }
}
