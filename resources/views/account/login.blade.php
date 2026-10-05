@extends('layouts.app')

@section('title', 'Customer Account Login — AstroTamal')

@section('content')
<section class="bg-[#F7F0E3] text-[#29211F] py-12 sm:py-16 lg:py-20 min-h-[75vh] flex items-center">
    <div class="max-w-md mx-auto px-4 sm:px-6 w-full">
        
        <!-- Login Card -->
        <div class="bg-[#351211] rounded-[24px] p-6 sm:p-8 border border-[#C49A45]/40 shadow-xl text-[#F7F0E3]">
            
            <div class="text-center space-y-2 mb-6">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">CUSTOMER PORTAL</span>
                <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3]">Welcome Back</h1>
                <p class="text-xs sm:text-sm text-[#D8C6A8]">Sign in to view your consultations & manage your profile</p>
            </div>

            <!-- Status & Error Alerts -->
            @if(session('status'))
                <div class="mb-4 p-3 rounded-xl bg-[#EDE3D4]/10 border border-[#C49A45]/40 text-[#C49A45] text-xs font-medium text-center">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-4 p-3 rounded-xl bg-[#EDE3D4]/10 border border-[#C49A45]/40 text-[#D8C6A8] text-xs font-medium text-center">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-red-950/60 border border-red-500/40 text-red-200 text-xs font-medium space-y-1">
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
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#D8C6A8] mb-1">
                        Email Address or Phone Number
                    </label>
                    <input type="text" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           placeholder="your.email@example.com or Phone" 
                           class="w-full px-4 py-3 rounded-xl bg-[#F7F0E3] text-[#29211F] placeholder-[#81766D] border border-[#D8C6A8] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-[#D8C6A8] mb-1">
                        Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="••••••••" 
                           class="w-full px-4 py-3 rounded-xl bg-[#F7F0E3] text-[#29211F] placeholder-[#81766D] border border-[#D8C6A8] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs text-[#D8C6A8]">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-[#D8C6A8] text-[#541F1D] focus:ring-[#C49A45]" />
                        <span>Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-6 rounded-xl bg-[#541F1D] hover:bg-[#351211] text-[#F7F0E3] font-bold text-sm uppercase tracking-wider border border-[#C49A45]/60 transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-md">
                    Sign In
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 border-t border-[#C49A45]/20 text-center text-xs text-[#D8C6A8]">
                <span class="bg-[#351211] px-3 relative -top-2.5">New to AstroTamal?</span>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <a href="{{ route('account.register') }}" 
                   class="inline-block py-2.5 px-6 rounded-xl bg-[#F7F0E3] hover:bg-[#EDE3D4] text-[#541F1D] font-semibold text-xs uppercase tracking-wider transition-colors w-full">
                    Create a New Account
                </a>
            </div>

        </div>

    </div>
</section>
@endsection
