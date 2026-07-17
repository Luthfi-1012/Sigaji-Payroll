<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->orderBy('created_at', 'desc')->paginate(10);
        $totalKaryawan = Employee::count();
        $jabatanAktif = Employee::distinct('jabatan')->count('jabatan');
        $karyawanBaru = Employee::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return view('admin.daftar-karyawan', compact('employees', 'totalKaryawan', 'jabatanAktif', 'karyawanBaru'));
    }

    public function create()
    {
        return view('admin.tambah-karyawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:employees',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jabatan' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'gaji_pokok' => 'required|numeric',
            'tunjangan_1' => 'nullable|numeric',
            'tunjangan_2' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'karyawan'
            ]);

            Employee::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'gaji_pokok' => $request->gaji_pokok,
                'tunjangan_1' => $request->tunjangan_1 ?? 0,
                'tunjangan_2' => $request->tunjangan_2 ?? 0,
                'potongan' => $request->potongan ?? 0,
            ]);
        });

        return redirect()->route('admin.karyawan')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'tunjangan_1' => 'nullable|numeric',
            'tunjangan_2' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        $employee->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_1' => $request->tunjangan_1 ?? 0,
            'tunjangan_2' => $request->tunjangan_2 ?? 0,
            'potongan' => $request->potongan ?? 0,
        ]);

        $employee->user->update(['name' => $request->nama]);

        return redirect()->route('admin.karyawan')->with('success', 'Data karyawan diperbarui');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->user->delete(); // This will cascade delete employee due to foreign key setup

        return redirect()->route('admin.karyawan')->with('success', 'Karyawan dihapus');
    }
}
