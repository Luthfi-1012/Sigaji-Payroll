<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayslipController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        $payrolls = $employee->payrolls()->orderBy('created_at', 'desc')->get();

        return view('employee.riwayat-slip', compact('employee', 'payrolls'));
    }

    public function show($id)
    {
        $employee = Auth::user()->employee;
        $payroll = $employee->payrolls()->findOrFail($id);

        return view('employee.detail-slip', compact('employee', 'payroll'));
    }
}
