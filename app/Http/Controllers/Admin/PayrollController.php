<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        return view('admin.generate-payroll', compact('employees', 'currentMonth', 'currentYear'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'periode_bulan' => 'required|string',
            'periode_tahun' => 'required|integer',
        ]);

        $employees = Employee::all();
        $generatedCount = 0;

        foreach ($employees as $employee) {
            // Check if payroll already exists
            $exists = Payroll::where('employee_id', $employee->id)
                ->where('periode_bulan', $request->periode_bulan)
                ->where('periode_tahun', $request->periode_tahun)
                ->exists();

            if (!$exists) {
                $gaji_pokok = $employee->gaji_pokok;
                $total_tunjangan = $employee->tunjangan_1 + $employee->tunjangan_2;
                $total_potongan = $employee->potongan;
                $gaji_bersih = $gaji_pokok + $total_tunjangan - $total_potongan;

                Payroll::create([
                    'employee_id' => $employee->id,
                    'periode_bulan' => $request->periode_bulan,
                    'periode_tahun' => $request->periode_tahun,
                    'gaji_pokok' => $gaji_pokok,
                    'total_tunjangan' => $total_tunjangan,
                    'total_potongan' => $total_potongan,
                    'gaji_bersih' => $gaji_bersih,
                    'status' => 'Selesai',
                ]);
                
                $generatedCount++;
            }
        }

        return redirect()->route('admin.laporan')->with('success', "Berhasil generate $generatedCount payroll");
    }

    public function report()
    {
        $payrolls = Payroll::with('employee')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan-payroll', compact('payrolls'));
    }

    /**
     * Tandai payroll sebagai sudah dibayar.
     */
    public function tandaiDibayar($id)
    {
        $payroll = Payroll::findOrFail($id);

        if ($payroll->isSudahDibayar()) {
            return redirect()->back()->with('info', 'Payroll ini sudah berstatus "Sudah Dibayar".');
        }

        $payroll->update([
            'status_pembayaran' => 'sudah_dibayar',
            'dibayar_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
