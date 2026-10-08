@extends('admin.layouts.app')

@section('title', $user->exists ? 'Edit Admin User' : 'Create Admin User')
@section('header_title', $user->exists ? 'Edit Admin User' : 'Add New Admin User')
@section('header_subtitle', 'Configure administrator credentials and access permissions')

@section('content')
<div class="max-w-3xl space-y-6">

    <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-[#0B3D2E] hover:underline flex items-center">
        ← Back to Users List
    </a>

    <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-8 shadow-xs">
        <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="space-y-5">
            @csrf
            @if ($user->exists)
                @method('PUT')
            @endif

            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                       class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#17211D]">
            </div>

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                       class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#17211D]">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#17211D] mb-1.5">
                    Password {{ $user->exists ? '(Leave blank to keep current)' : '' }}
                </label>
                <input type="password" name="password" id="password" {{ $user->exists ? '' : 'required' }} 
                       class="w-full bg-[#FFFFFF] border border-[#C8D8CF] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#17211D]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', $user->exists ? $user->is_admin : true) ? 'checked' : '' }} 
                           class="accent-[#0B3D2E] w-4 h-4 rounded border-[#C8D8CF]">
                    <label for="is_admin" class="text-xs font-bold text-[#17211D] cursor-pointer">Administrator Privileges</label>
                </div>

                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $user->exists ? $user->is_active : true) ? 'checked' : '' }} 
                           class="accent-[#0B3D2E] w-4 h-4 rounded border-[#C8D8CF]">
                    <label for="is_active" class="text-xs font-bold text-[#17211D] cursor-pointer">Account Active</label>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-full shadow-md">
                    {{ $user->exists ? 'Update Admin User' : 'Create Admin User' }}
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
