@extends('admin.layouts.app')

@section('title', 'My Profile & Security')
@section('header_title', 'My Profile & Security')
@section('header_subtitle', 'Manage your administrator account details and password')

@section('content')
<div class="max-w-4xl space-y-8">

    <!-- Profile Details Card -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 shadow-xs">
        <h2 class="font-serif-luxury text-lg font-bold text-[#541F1D] mb-1">Account Information</h2>
        <p class="text-xs text-[#81766D] mb-6">Update your name and email address</p>

        <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]">
            </div>

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]">
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-full shadow-md transition-all">
                    Save Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Password Update Card -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 shadow-xs">
        <h2 class="font-serif-luxury text-lg font-bold text-[#541F1D] mb-1">Change Password</h2>
        <p class="text-xs text-[#81766D] mb-6">Ensure your account uses a strong, unique password</p>

        <form method="POST" action="{{ route('admin.profile.password') }}" class="space-y-5">
            @csrf

            <div>
                <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Current Password</label>
                <input type="password" name="current_password" id="current_password" required 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">New Password</label>
                <input type="password" name="password" id="password" required 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]">
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]">
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-full shadow-md transition-all">
                    Update Password
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
