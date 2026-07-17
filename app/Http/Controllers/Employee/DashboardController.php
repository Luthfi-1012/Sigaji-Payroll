<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        $latestPayroll = $employee->payrolls()->latest('created_at')->first();

        return view('employee.dashboard', compact('employee', 'latestPayroll'));
    }
}
