@extends('layouts.app')

@section('title', 'Edit Profile — AstroTamal Account')

@section('content')
<section class="bg-[#F7F0E3] text-[#29211F] py-12 sm:py-16 min-h-[75vh] flex items-center">
    <div class="max-w-md mx-auto px-4 sm:px-6 w-full">
        
        <!-- Profile Card -->
        <div class="bg-[#351211] rounded-[24px] p-6 sm:p-8 border border-[#C49A45]/40 shadow-xl text-[#F7F0E3]">
            
            <div class="flex items-center justify-between mb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">MY PROFILE</span>
                    <h1 class="font-serif-luxury text-2xl font-bold text-[#F7F0E3]">Edit Personal Info</h1>
                </div>
                <a href="{{ route('account.dashboard') }}" class="text-xs text-[#D8C6A8] hover:text-[#C49A45] font-semibold">
                    ← Back to Dashboard
                </a>
            </div>

            <!-- Status Alert -->
            @if(session('status'))
                <div class="mb-4 p-3 rounded-xl bg-[#EDE3D4]/10 border border-[#C49A45]/40 text-[#C49A45] text-xs font-medium text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Error Alert -->
            @if($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-red-950/60 border border-red-500/40 text-red-200 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Profile Form -->
            <form method="POST" action="{{ route('account.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-[#D8C6A8] mb-1">
                        Full Name
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}" 
                           required 
                           class="w-full px-4 py-3 rounded-xl bg-[#F7F0E3] text-[#29211F] border border-[#D8C6A8] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#D8C6A8] mb-1">
                        Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}" 
                           required 
                           class="w-full px-4 py-3 rounded-xl bg-[#F7F0E3] text-[#29211F] border border-[#D8C6A8] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] text-sm" />
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-[#D8C6A8] mb-1">
                        Phone Number
                    </label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone', $user->phone) }}" 
                           required 
                           class="w-full px-4 py-3 rounded-xl bg-[#F7F0E3] text-[#29211F] border border-[#D8C6A8] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] text-sm" />
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-6 rounded-xl bg-[#541F1D] hover:bg-[#351211] text-[#F7F0E3] font-bold text-sm uppercase tracking-wider border border-[#C49A45]/60 transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-md mt-2">
                    Save Changes
                </button>
            </form>

        </div>

    </div>
</section>
@endsection
