<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use Illuminate\Validation\Rule;



class UserController extends Controller
{
    // lihat daftar user (ADMIN)
    public function index(Request $request)
    {
        $user = $request->user();

        if (! $user || ! $user->isAdmin()) {
            abort(403);
        }

        $users = User::where('tenant_id', $user->tenant_id)->get();

        return view('users.index', compact('users'));
    }

    public function update_profile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        // If email changed, reset verification
        if ($validated['email'] !== $user->email) {
            $validated['email_verified_at'] = null;
        }

        $user->update($validated);

        return back()->with('status', 'profile-updated');
    }

    // form tambah user baru (ADMIN)

    public function create(Request $request)
    {
        $user = $request->user();

        if (! $user || ! $user->isAdmin()) {
            abort(403);
        }

        return view('users.invite');
    }

    public function updateRole(Request $request, User $user)
    {
        $admin = $request->user();

        abort_unless($admin && $admin->isAdmin(), 403);
        abort_unless($user->tenant_id === $admin->tenant_id, 403);

        if ($admin->id === $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'role' => ['required', Rule::enum(UserRole::class)],
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'User role updated');
    }


    // simpan user baru (ADMIN) 
    public function store(Request $request)
    {
        $admin = $request->user();

        if (! $admin || ! $admin->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role'     => ['required', Rule::enum(UserRole::class)],
        ]);

        User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            // 'tenant_id' => $admin->tenant_id,   // tenant isolation
            'tenant_id' => 1,   // tenant isolation
            'role'      => $validated['role'],  // enum-safe
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }
}
