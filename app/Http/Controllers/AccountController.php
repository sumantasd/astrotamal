<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    /**
     * Show customer login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }

        return view('account.login');
    }

    /**
     * Process customer login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        // Allow login using email or phone
        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $authAttempt = Auth::attempt([
            $loginField => $credentials['email'],
            'password' => $credentials['password'],
        ], $remember);

        if (! $authAttempt) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $user = Auth::user();

        if (! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Your account has been deactivated. Please contact support.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('account.dashboard'));
    }

    /**
     * Show customer registration form.
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }

        return view('account.register');
    }

    /**
     * Process customer registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
            'is_active' => true,
        ]);

        \App\Services\BookingService::sendWelcomeEmail($user);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('account.dashboard')->with('status', 'Welcome! Your account has been created successfully.');
    }

    /**
     * Customer Account Dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $appointments = Appointment::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->when($user->phone, function ($query, $phone) {
                $query->orWhere('phone', $phone);
            })
            ->with('service')
            ->latest()
            ->get();

        return view('account.dashboard', compact('user', 'appointments'));
    }

    /**
     * Edit Profile form.
     */
    public function editProfile()
    {
        $user = Auth::user();

        return view('account.profile', compact('user'));
    }

    /**
     * Update Profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date'],
            'birth_time' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (!empty($value) && strtotime(trim($value)) === false) {
                        $fail('The birth time format is invalid.');
                    }
                },
            ],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:Male,Female,Other'],
            'address' => ['nullable', 'string', 'max:1000'],
        ]);

        if (!empty($validated['birth_time'])) {
            $timestamp = strtotime(trim($validated['birth_time']));
            if ($timestamp !== false) {
                $validated['birth_time'] = date('H:i:s', $timestamp);
            }
        }

        $user->update($validated);

        return redirect()->route('account.profile')->with('status', 'Profile details updated successfully.');
    }

    /**
     * Edit Password form.
     */
    public function editPassword()
    {
        return view('account.password');
    }

    /**
     * Update Password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('account.password')->with('status', 'Password changed successfully.');
    }

    /**
     * View specific booking details.
     */
    public function showBookingDetails($reference)
    {
        $user = Auth::user();

        $appointment = Appointment::where('booking_reference', $reference)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email)
                    ->when($user->phone, function ($q, $phone) {
                        $q->orWhere('phone', $phone);
                    });
            })
            ->firstOrFail();

        return view('account.booking-details', compact('appointment', 'user'));
    }

    /**
     * Customer logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('account.login')->with('status', 'You have been logged out.');
    }
}
