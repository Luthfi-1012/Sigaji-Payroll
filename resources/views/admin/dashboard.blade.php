@extends('layouts.app')

@section('title', 'Dashboard Admin - SiGaji')

@section('styles')
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
</style>
@endsection

@section('content')
@include('layouts.partials.admin-sidebar', ['active' => 'dashboard'])

<!-- Main Content Wrapper -->
<div class="ml-64 flex flex-col min-h-screen">
    <!-- TopAppBar -->
    <header class="flex justify-between items-center px-container-margin h-16 w-full sticky top-0 bg-surface-container-lowest border-b border-border-muted z-40">
        <div class="flex items-center bg-surface-container-low border border-border-muted rounded-full px-stack-md py-1.5 w-96">
            <span class="material-symbols-outlined text-outline text-sm">search</span>
            <input class="bg-transparent border-none focus:ring-0 text-body-sm font-body-sm w-full placeholder-on-surface-variant/50" placeholder="Cari fitur atau data..." type="text"/>
        </div>
        <div class="flex items-center gap-stack-md">
            <button class="w-10 h-10 flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors rounded-full relative">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button class="w-10 h-10 flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors rounded-full">
                <span class="material-symbols-outlined">help</span>
            </button>
            <div class="h-8 w-[1px] bg-border-muted mx-base"></div>
            <div class="flex items-center gap-stack-sm">
                <div class="text-right hidden sm:block">
                    <p class="font-label-md text-label-md text-on-surface">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-tighter">Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Canvas -->
    <main class="p-container-margin flex-1">
        <!-- Page Header -->
        <div class="mb-stack-lg">
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">Dashboard</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Selamat datang kembali, {{ Auth::user()->name }}. Berikut ringkasan sistem payroll Anda.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-stack-md mb-stack-lg">
            <!-- Total Karyawan -->
            <div class="stat-card bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
                <div class="flex justify-between items-start mb-stack-sm">
                    <div class="p-2 bg-primary-fixed rounded-lg">
                        <span class="material-symbols-outlined text-primary-container">groups</span>
                    </div>
                    <span class="text-status-success font-label-md text-[12px] flex items-center gap-0.5">
                        <span class="material-symbols-outlined text-sm">trending_up</span> Aktif
                    </span>
                </div>
                <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Total Karyawan</p>
                <p class="font-display-lg text-headline-lg text-primary mt-1">{{ $totalKaryawan }}</p>
            </div>

            <!-- Total Admin -->
            <div class="stat-card bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
                <div class="flex justify-between items-start mb-stack-sm">
                    <div class="p-2 bg-secondary-container rounded-lg">
                        <span class="material-symbols-outlined text-on-secondary-container">admin_panel_settings</span>
                    </div>
                </div>
                <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Total Admin</p>
                <p class="font-display-lg text-headline-lg text-primary mt-1">{{ $totalAdmin }}</p>
            </div>

            <!-- Jabatan Aktif -->
            <div class="stat-card bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
                <div class="flex justify-between items-start mb-stack-sm">
                    <div class="p-2 bg-tertiary-fixed rounded-lg">
                        <span class="material-symbols-outlined text-on-tertiary-fixed">work</span>
                    </div>
                    <span class="text-on-surface-variant font-label-md text-[12px]">Posisi</span>
                </div>
                <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Jabatan Aktif</p>
                <p class="font-display-lg text-headline-lg text-primary mt-1">{{ $jabatanAktif }}</p>
            </div>

            <!-- Karyawan Baru -->
            <div class="stat-card bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
                <div class="flex justify-between items-start mb-stack-sm">
                    <div class="p-2 bg-secondary/10 rounded-lg">
                        <span class="material-symbols-outlined text-secondary">person_add</span>
                    </div>
                    <span class="text-on-surface-variant font-label-md text-[12px]">Bulan ini</span>
                </div>
                <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Karyawan Baru</p>
                <p class="font-display-lg text-headline-lg text-primary mt-1">{{ $karyawanBaru }}</p>
            </div>
        </div>

        <!-- Quick Actions & Recent -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
            <!-- Quick Actions -->
            <div class="lg:col-span-1">
                <div class="bg-surface-container-lowest border border-border-muted rounded-xl p-stack-lg">
                    <h3 class="font-headline-md text-headline-md text-primary mb-stack-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">bolt</span>
                        Aksi Cepat
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.karyawan.tambah') }}" class="flex items-center gap-3 p-3 rounded-lg bg-surface-bg hover:bg-primary-fixed/30 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                                <span class="material-symbols-outlined text-primary">person_add</span>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Tambah Karyawan</p>
                                <p class="text-xs text-on-surface-variant">Daftarkan karyawan baru</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.payroll') }}" class="flex items-center gap-3 p-3 rounded-lg bg-surface-bg hover:bg-secondary/10 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-secondary/10 flex items-center justify-center group-hover:bg-secondary/20 transition-colors">
                                <span class="material-symbols-outlined text-secondary">payments</span>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Generate Payroll</p>
                                <p class="text-xs text-on-surface-variant">Proses gaji bulan ini</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 p-3 rounded-lg bg-surface-bg hover:bg-tertiary-fixed/30 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-tertiary-fixed flex items-center justify-center group-hover:opacity-80 transition-opacity">
                                <span class="material-symbols-outlined text-on-tertiary-fixed">assessment</span>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Lihat Laporan</p>
                                <p class="text-xs text-on-surface-variant">Laporan payroll bulan ini</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.register') }}" class="flex items-center gap-3 p-3 rounded-lg bg-surface-bg hover:bg-primary-fixed/30 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center group-hover:opacity-80 transition-opacity">
                                <span class="material-symbols-outlined text-primary-container">shield_person</span>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Kelola Admin</p>
                                <p class="text-xs text-on-surface-variant">Tambah atau lihat admin</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Employees -->
            <div class="lg:col-span-2">
                <div class="bg-surface-container-lowest border border-border-muted rounded-xl p-stack-lg">
                    <div class="flex items-center justify-between mb-stack-md">
                        <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">group</span>
                            Karyawan Terbaru
                        </h3>
                        <a href="{{ route('admin.karyawan') }}" class="text-secondary font-label-md text-label-md hover:underline flex items-center gap-1">
                            Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>

                    @if($recentEmployees->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentEmployees as $employee)
                                <div class="flex items-center justify-between p-3 rounded-lg bg-surface-bg hover:bg-primary-fixed/20 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($employee->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-label-md text-label-md text-on-surface">{{ $employee->nama }}</p>
                                            <p class="text-xs text-on-surface-variant">{{ $employee->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-2 py-0.5 bg-blue-50 text-blue-600 rounded text-[11px] font-bold uppercase tracking-tighter">{{ $employee->jabatan }}</span>
                                        <p class="text-xs text-on-surface-variant mt-1">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 text-on-surface-variant">
                            <span class="material-symbols-outlined text-[48px] opacity-30">person_off</span>
                            <p class="mt-2 font-label-md">Belum ada karyawan terdaftar</p>
                            <a href="{{ route('admin.karyawan.tambah') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-secondary text-white rounded-lg font-label-md hover:brightness-110 transition-all">
                                <span class="material-symbols-outlined text-sm">add</span>
                                Tambah Karyawan Pertama
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Payroll Summary -->
                <div class="bg-primary-container text-on-primary-fixed p-6 rounded-xl relative overflow-hidden mt-gutter">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-secondary-fixed">payments</span>
                            <h4 class="font-headline-md text-headline-md text-secondary-fixed">Ringkasan Payroll Bulan Ini</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <p class="text-xs text-primary-fixed-dim uppercase tracking-wider">Payroll Diproses</p>
                                <p class="font-headline-lg text-headline-lg text-white mt-1">{{ $totalPayroll }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-primary-fixed-dim uppercase tracking-wider">Total Gaji Dibayar</p>
                                <p class="font-headline-lg text-headline-lg text-secondary-fixed mt-1">Rp {{ number_format($totalGajiDibayar, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-auto px-container-margin py-stack-md border-t border-border-muted flex justify-between items-center bg-white/50 backdrop-blur-sm">
        <p class="text-[12px] text-on-surface-variant">© 2024 SiGaji Enterprise. All Rights Reserved.</p>
        <div class="flex gap-stack-md">
            <a class="text-[12px] text-on-surface-variant hover:text-secondary transition-colors" href="#">Privacy Policy</a>
            <a class="text-[12px] text-on-surface-variant hover:text-secondary transition-colors" href="#">Terms of Service</a>
        </div>
    </footer>
</div>
@endsection
