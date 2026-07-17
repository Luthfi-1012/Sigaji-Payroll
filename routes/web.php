<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\PayslipController;
use App\Http\Controllers\Employee\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password (public)
Route::get('/lupa-password', [AuthController::class, 'showForgotPassword'])->name('password.forgot');
Route::post('/lupa-password', [AuthController::class, 'forgotPassword'])->name('password.forgot.send');

// Change Password (authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/ubah-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('/ubah-password', [AuthController::class, 'changePassword'])->name('password.update');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/karyawan', [EmployeeController::class, 'index'])->name('karyawan');
    Route::get('/karyawan/tambah', [EmployeeController::class, 'create'])->name('karyawan.tambah');
    Route::post('/karyawan', [EmployeeController::class, 'store'])->name('karyawan.store');
    Route::put('/karyawan/{id}', [EmployeeController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/{id}', [EmployeeController::class, 'destroy'])->name('karyawan.destroy');
    
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll');
    Route::post('/payroll/generate', [PayrollController::class, 'generate'])->name('payroll.generate');
    Route::get('/laporan', [PayrollController::class, 'report'])->name('laporan');

    // Admin User Management
    Route::get('/register', [AdminUserController::class, 'showRegisterAdmin'])->name('register');
    Route::post('/register', [AdminUserController::class, 'registerAdmin'])->name('register.store');
    Route::post('/reset-password/{id}', [AdminUserController::class, 'resetPassword'])->name('reset-password');
});

// Employee Routes
Route::middleware(['auth', 'role:karyawan'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/riwayat-slip', [PayslipController::class, 'index'])->name('riwayat-slip');
    Route::get('/detail-slip/{id}', [PayslipController::class, 'show'])->name('detail-slip');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::post('/profil/update', [ProfileController::class, 'update'])->name('profil.update');
});

