<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // lihat daftar user (ADMIN)
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $users = User::where('tenant_id', auth()->user()->tenant_id)->get();

        return view('users.index', compact('users'));
    }

    // form tambah user baru (ADMIN)
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('users.invite');
    }

    // simpan user baru (ADMIN) 
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tenant_id' => auth()->user()->tenant_id,
            'role' => 'user',
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }
}
