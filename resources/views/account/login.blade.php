@extends('layouts.app')

@section('title', 'Customer Account Login — AstroTamal')

@section('content')
<section class="bg-[#F3F8F5] text-[#17211D] py-12 sm:py-16 lg:py-20 min-h-[75vh] flex items-center">
    <div class="max-w-md mx-auto px-4 sm:px-6 w-full">
        
        <!-- Login Card -->
        <div class="bg-[#FFFFFF] rounded-[24px] p-6 sm:p-8 border border-[#C8D8CF] shadow-xl text-[#17211D]">
            
            <div class="text-center space-y-2 mb-6">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">CUSTOMER PORTAL</span>
                <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#0B3D2E]">Welcome Back</h1>
                <p class="text-xs sm:text-sm text-[#60736B]">Sign in to view your consultations & manage your profile</p>
            </div>

            <!-- Status & Error Alerts -->
            @if(session('status'))
                <div class="mb-4 p-3 rounded-xl bg-[#E8F1EC] border border-[#C8D8CF] text-[#0B3D2E] text-xs font-medium text-center">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-4 p-3 rounded-xl bg-[#E8F1EC] border border-[#C8D8CF] text-[#0B3D2E] text-xs font-medium text-center">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('account.login.submit') }}" class="space-y-4">
                @csrf

                <!-- Email or Phone -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#0B3D2E] mb-1">
                        Email Address or Phone Number
                    </label>
                    <input type="text" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           placeholder="your.email@example.com or Phone" 
                           class="w-full px-4 py-3 rounded-xl bg-[#F3F8F5] text-[#17211D] placeholder-[#60736B] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] focus:ring-1 focus:ring-[#0B3D2E] text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-[#0B3D2E] mb-1">
                        Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="••••••••" 
                           class="w-full px-4 py-3 rounded-xl bg-[#F3F8F5] text-[#17211D] placeholder-[#60736B] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] focus:ring-1 focus:ring-[#0B3D2E] text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs text-[#60736B]">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-[#C8D8CF] text-[#0B3D2E] focus:ring-[#C49A45]" />
                        <span>Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-6 rounded-xl bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] font-bold text-sm uppercase tracking-wider border border-[#0B3D2E] transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-md">
                    Sign In
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 border-t border-[#C8D8CF] text-center text-xs text-[#60736B]">
                <span class="bg-[#FFFFFF] px-3 relative -top-2.5">New to AstroTamal?</span>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <a href="{{ route('account.register') }}" 
                   class="inline-block py-2.5 px-6 rounded-xl bg-[#E8F1EC] hover:bg-[#F3F8F5] text-[#0B3D2E] font-semibold text-xs uppercase tracking-wider transition-colors w-full border border-[#C8D8CF]">
                    Create a New Account
                </a>
            </div>

        </div>

    </div>
</section>
@endsection
