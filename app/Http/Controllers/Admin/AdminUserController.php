<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Show register admin form.
     */
    public function showRegisterAdmin()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.register-admin', compact('admins'));
    }

    /**
     * Register a new admin account.
     */
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.register')->with('success', 'Admin baru berhasil didaftarkan.');
    }

    /**
     * Reset employee password (admin action).
     */
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:8',
        ], [
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', "Kata sandi untuk {$user->name} berhasil direset.");
    }
}
