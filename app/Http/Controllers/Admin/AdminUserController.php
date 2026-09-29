<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', ['user' => new User()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::min(8)],
            'is_admin' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = $request->boolean('is_admin', true);
        $validated['is_active'] = $request->boolean('is_active', true);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('status', 'Admin user created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', Password::min(8)],
            'is_admin' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        // Protect against deactivating last active administrator
        if ($user->is_admin && !$request->boolean('is_admin') || $user->is_active && !$request->boolean('is_active')) {
            $activeAdminCount = User::where('is_admin', true)->where('is_active', true)->count();
            if ($activeAdminCount <= 1) {
                return redirect()->back()->withErrors(['email' => 'Cannot revoke admin rights or deactivate the last active administrator.']);
            }
        }

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $request->boolean('is_admin'),
            'is_active' => $request->boolean('is_active'),
        ];

        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('status', 'Admin user updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->withErrors(['email' => 'You cannot delete your own account.']);
        }

        $activeAdminCount = User::where('is_admin', true)->where('is_active', true)->count();
        if ($user->is_admin && $activeAdminCount <= 1) {
            return redirect()->back()->withErrors(['email' => 'Cannot delete the last active administrator.']);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully.');
    }
}
