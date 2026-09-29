@extends('admin.layouts.app')

@section('title', 'Admin Users')
@section('header_title', 'Admin User Management')
@section('header_subtitle', 'Manage administrator accounts, permissions, and active statuses')

@section('content')
<div class="space-y-6 max-w-5xl">

    <div class="flex items-center justify-between">
        <span class="text-xs font-bold uppercase tracking-wider text-[#81766D]">Total Accounts: {{ $users->total() }}</span>
        <a href="{{ route('admin.users.create') }}" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-xl shadow-md">
            + Add Admin User
        </a>
    </div>

    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#D8C6A8]/60 text-[11px] font-bold uppercase tracking-wider text-[#81766D]">
                        <th class="pb-3 px-3">Name</th>
                        <th class="pb-3 px-3">Email</th>
                        <th class="pb-3 px-3">Admin Role</th>
                        <th class="pb-3 px-3">Status</th>
                        <th class="pb-3 px-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                    @foreach ($users as $usr)
                        <tr class="hover:bg-[#EDE3D4]/30 transition-colors">
                            <td class="py-3.5 px-3 font-bold text-[#541F1D]">
                                {{ $usr->name }}
                            </td>
                            <td class="py-3.5 px-3 font-mono">
                                {{ $usr->email }}
                            </td>
                            <td class="py-3.5 px-3">
                                @if ($usr->is_admin)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#C49A45]/20 text-[#541F1D]">
                                        Administrator
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-700">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3">
                                @if ($usr->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-800 border border-red-300">
                                        Disabled
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $usr) }}" class="px-3 py-1 text-xs font-bold text-[#541F1D] bg-[#C49A45]/20 rounded-lg hover:bg-[#C49A45]/40">
                                    Edit
                                </a>
                                @if ($usr->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $usr) }}" class="inline-block" onsubmit="return confirm('Delete user {{ $usr->email }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-lg hover:bg-red-200">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
