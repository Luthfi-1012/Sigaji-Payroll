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
        $currentMonth = str_pad(Carbon::now()->month, 2, '0', STR_PAD_LEFT);
        $currentYear = Carbon::now()->year;

        $totalPayroll = Payroll::where('periode_bulan', $currentMonth)
            ->where('periode_tahun', $currentYear)
            ->count();
        $totalGajiDibayar = Payroll::where('periode_bulan', $currentMonth)
            ->where('periode_tahun', $currentYear)
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
