<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        return view('employee.pengaturan-profil', compact('employee'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        $request->validate([
            'nama' => 'required|string|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'current_password.required_with' => 'Kata sandi saat ini wajib diisi untuk mengubah kata sandi.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        // Update name
        $user->update(['name' => $request->nama]);
        if ($employee) {
            $employee->update(['nama' => $request->nama]);
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Kata sandi saat ini tidak sesuai.',
                ]);
            }

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}

