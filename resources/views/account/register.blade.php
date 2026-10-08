@extends('layouts.app')

@section('title', 'Customer Registration — AstroTamal')

@section('content')
<section class="bg-[#F3F8F5] text-[#17211D] py-12 sm:py-16 lg:py-20 min-h-[75vh] flex items-center">
    <div class="max-w-md mx-auto px-4 sm:px-6 w-full">
        
        <!-- Registration Card -->
        <div class="bg-[#06281F] rounded-[24px] p-6 sm:p-8 border border-[#C49A45]/40 shadow-xl text-[#F7F0E3]">
            
            <div class="text-center space-y-2 mb-6">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">JOIN ASTROTAMAL</span>
                <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FFFFFF]">Create Customer Account</h1>
                <p class="text-xs sm:text-sm text-[#D8E5DE]">Register to easily manage your bookings & consultation records</p>
            </div>

            <!-- Error Alerts -->
            @if($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-red-950/60 border border-red-500/40 text-red-200 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('account.register.submit') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                        Full Name
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           placeholder="Your Name" 
                           class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] placeholder-[#60736B] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] focus:ring-1 focus:ring-[#0B3D2E] text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                        Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           placeholder="name@example.com" 
                           class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] placeholder-[#60736B] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] focus:ring-1 focus:ring-[#0B3D2E] text-sm" />
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                        Phone Number
                    </label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}" 
                           required 
                           placeholder="10-digit mobile number" 
                           class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] placeholder-[#60736B] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] focus:ring-1 focus:ring-[#0B3D2E] text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                        Password (Min 8 Characters)
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="••••••••" 
                           class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] placeholder-[#60736B] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] focus:ring-1 focus:ring-[#0B3D2E] text-sm" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                        Confirm Password
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required 
                           placeholder="••••••••" 
                           class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] placeholder-[#60736B] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] focus:ring-1 focus:ring-[#0B3D2E] text-sm" />
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-6 rounded-xl bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] font-bold text-sm uppercase tracking-wider border border-[#C49A45]/60 transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-md mt-2">
                    Register Account
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 border-t border-[#C49A45]/20 text-center text-xs text-[#D8E5DE]">
                <span class="bg-[#06281F] px-3 relative -top-2.5">Already registered?</span>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <a href="{{ route('account.login') }}" 
                   class="inline-block py-2.5 px-6 rounded-xl bg-[#E8F1EC] hover:bg-[#F3F8F5] text-[#0B3D2E] font-semibold text-xs uppercase tracking-wider transition-colors w-full border border-[#C8D8CF]">
                    Log In to Existing Account
                </a>
            </div>

        </div>

    </div>
</section>
@endsection
