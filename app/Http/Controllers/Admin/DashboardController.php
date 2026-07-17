<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Payroll;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Employee::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $jabatanAktif = Employee::distinct('jabatan')->count('jabatan');
        $karyawanBaru = Employee::whereMonth('tanggal_masuk', Carbon::now()->month)
            ->whereYear('tanggal_masuk', Carbon::now()->year)
            ->count();
        $totalPayroll = Payroll::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $totalGajiDibayar = Payroll::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('gaji_bersih');
        $recentEmployees = Employee::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKaryawan',
            'totalAdmin',
            'jabatanAktif',
            'karyawanBaru',
            'totalPayroll',
            'totalGajiDibayar',
            'recentEmployees'
        ));
    }
}
