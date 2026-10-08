@extends('layouts.app')

@section('title', 'Edit Profile — AstroTamal Account')

@section('content')
<section class="bg-[#F3F8F5] text-[#17211D] py-12 sm:py-16 min-h-[75vh] flex items-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 w-full">
        
        <!-- Profile Card -->
        <div class="bg-[#06281F] rounded-[24px] p-6 sm:p-10 border border-[#C49A45]/40 shadow-xl text-[#F7F0E3]">
            
            <div class="flex items-center justify-between mb-6 border-b border-[#C49A45]/30 pb-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">MY PROFILE</span>
                    <h1 class="font-serif-luxury text-2xl font-bold text-[#FFFFFF]">Edit Personal Info</h1>
                </div>
                <a href="{{ route('account.dashboard') }}" class="text-xs text-[#D8E5DE] hover:text-[#C49A45] font-semibold">
                    ← Back to Dashboard
                </a>
            </div>

            <!-- Status Alert -->
            @if(session('status'))
                <div class="mb-6 p-4 rounded-xl bg-[#0B3D2E] border border-[#C49A45]/40 text-[#C49A45] text-xs font-medium text-center shadow-xs">
                    ✨ {{ session('status') }}
                </div>
            @endif

            <!-- Error Alert -->
            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-950/60 border border-red-500/40 text-red-200 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Profile Form -->
            <form method="POST" action="{{ route('account.profile.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Full Name *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               required 
                               class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Email Address *
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required 
                               class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Phone Number *
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $user->phone) }}" 
                               required 
                               class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm" />
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label for="whatsapp" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            WhatsApp Number
                        </label>
                        <input type="text" 
                               id="whatsapp" 
                               name="whatsapp" 
                               value="{{ old('whatsapp', $user->whatsapp) }}" 
                               placeholder="e.g. 96476 80707"
                               class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm" />
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="birth_date" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Date of Birth
                        </label>
                        <input type="date" 
                               id="birth_date" 
                               name="birth_date" 
                               value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}" 
                               class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm" />
                    </div>

                    <!-- Time of Birth (Time Picker) -->
                    <div>
                        <label for="birth_time" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Time of Birth
                        </label>
                        <input type="time" 
                               id="birth_time" 
                               name="birth_time" 
                               value="{{ old('birth_time', $user->birth_time ? (strtotime($user->birth_time) ? date('H:i', strtotime($user->birth_time)) : $user->birth_time) : '') }}" 
                               class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm" />
                    </div>

                    <!-- Place of Birth -->
                    <div>
                        <label for="birth_place" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Place of Birth
                        </label>
                        <input type="text" 
                               id="birth_place" 
                               name="birth_place" 
                               value="{{ old('birth_place', $user->birth_place) }}" 
                               placeholder="e.g. Kolkata, West Bengal"
                               class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm" />
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Gender
                        </label>
                        <select id="gender" 
                                name="gender" 
                                class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $user->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $user->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $user->gender) === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-xs font-semibold uppercase tracking-wider text-[#D8E5DE] mb-1">
                            Address
                        </label>
                        <textarea id="address" 
                                  name="address" 
                                  rows="2"
                                  placeholder="Enter your address"
                                  class="w-full px-4 py-3 rounded-xl bg-[#FFFFFF] text-[#17211D] border border-[#C8D8CF] focus:outline-none focus:border-[#0B3D2E] text-sm">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3.5 px-6 rounded-xl bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] font-bold text-sm uppercase tracking-wider border border-[#C49A45]/60 transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-md">
                        Save Profile Details
                    </button>
                </div>
            </form>

        </div>

    </div>
</section>
@endsection
