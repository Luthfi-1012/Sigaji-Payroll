@extends('layouts.app')

@section('title', 'sigaji_dashboard_karyawan')

@section('styles')
<style>

        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-tab {
            color: #aaf859 !important;
            font-weight: 700 !important;
            border-right: 4px solid #aaf859;
            background-color: #294e41;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    
</style>
@endsection

@section('content')

@include('layouts.partials.employee-sidebar', ['active' => 'dashboard'])
<!-- TopAppBar -->
<header class="flex justify-between items-center ml-64 px-container-margin h-16 w-[calc(100%-16rem)] sticky top-0 bg-surface-container-lowest border-b border-border-muted z-40">
<div class="flex items-center gap-4">
<h2 class="font-headline-md text-headline-md font-bold text-primary">Employee Panel</h2>
</div>
<div class="flex items-center gap-6">
<button class="text-on-surface-variant hover:text-primary transition-opacity active:opacity-80">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="text-on-surface-variant hover:text-primary transition-opacity active:opacity-80">
<span class="material-symbols-outlined">help</span>
</button>
<div class="flex items-center gap-3 pl-4 border-l border-border-muted">
<div class="text-right hidden sm:block">
<p class="font-label-md text-label-md text-primary">{{ auth()->user()->employee->nama ?? auth()->user()->name }}</p>
<p class="text-[11px] text-on-surface-variant leading-none uppercase">{{ auth()->user()->employee->jabatan ?? 'Karyawan' }}</p>
</div>
<div class="w-10 h-10 rounded-full overflow-hidden border-2 border-secondary-container">
<img class="w-full h-full object-cover" data-alt="A professional headshot of a middle-aged Indonesian businessman wearing a modern batik shirt, smiling confidently. The lighting is soft and natural, against a minimalist corporate office background with deep green and neutral grey tones. The high-quality photograph reflects a sense of trust and established authority within a corporate setting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpp-_rUgg8_6tKVCI6HG6j8XH8lqe582Ik5M6pPzrZgzTAw1ZMs4-zHihtWtClmAyGv-ZF1uEfoSJssg2UiPhBZtQb1U6UNJkcTGlsDiYartTYZkqfHS6iENj3VDhe8rEfZhMLpquhPiBcAhpGEl5KU5FRUuBbrNqRegvsDe1Osp9dn099QsSkhOe2kGLvyLIO4j-aRyId0iVHfeOE8stwnPa1RABMwxqSYvfGlwSvNpu6wiqga2ox5JpPoTSanCfgi-9hxR_3O7o"/>
</div>
</div>
</div>
</header>
<!-- Main Content -->
<main class="ml-64 p-container-margin min-h-[calc(100vh-64px)]">
<div class="max-w-[1280px] mx-auto space-y-stack-lg">
<!-- Welcome Banner -->
<section class="relative overflow-hidden bg-primary-container rounded-xl p-stack-lg text-white">

<div class="relative z-10">
<h3 class="font-display-lg text-display-lg text-secondary-fixed mb-2">Selamat Datang, {{ auth()->user()->employee->nama ?? auth()->user()->name }}</h3>
<p class="font-body-lg text-body-lg text-primary-fixed max-w-2xl">Ringkasan pendapatan dan status administratif Anda untuk bulan Juni 2026 sudah tersedia di bawah ini.</p>
</div>
</section>
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Last Salary -->
<div class="bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted shadow-sm group hover:border-secondary transition-colors duration-300">
<div class="flex justify-between items-start mb-stack-sm">
<span class="material-symbols-outlined text-primary bg-primary-fixed p-2 rounded-lg">payments</span>
<span class="text-status-success font-label-md text-label-md">Selesai</span>
</div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Gaji Terakhir</p>
<p class="font-headline-lg text-headline-lg text-primary mt-1">Rp {{ number_format(auth()->user()->employee->payrolls()->latest()->first()->gaji_bersih ?? 0, 0, ',', '.') }}</p>
</div>
<!-- Annual Total -->
<div class="bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted shadow-sm group hover:border-secondary transition-colors duration-300">
<div class="flex justify-between items-start mb-stack-sm">
<span class="material-symbols-outlined text-primary bg-primary-fixed p-2 rounded-lg">analytics</span>
<span class="text-on-surface-variant font-mono-data text-body-sm">YTD {{ date('Y') }}</span>
</div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total Gaji Tahun Ini</p>
<p class="font-headline-lg text-headline-lg text-primary mt-1">Rp {{ number_format(auth()->user()->employee->payrolls()->where('periode_tahun', date('Y'))->sum('gaji_bersih'), 0, ',', '.') }}</p>
</div>
<!-- Leave Balance -->
<div class="bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted shadow-sm group hover:border-secondary transition-colors duration-300">
<div class="flex justify-between items-start mb-stack-sm">
<span class="material-symbols-outlined text-primary bg-primary-fixed p-2 rounded-lg">event_available</span>
<span class="text-status-warning font-label-md text-label-md">Digunakan: 4</span>
</div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Sisa Cuti Tahunan</p>
<div class="flex items-baseline gap-2">
<p class="font-headline-lg text-headline-lg text-primary mt-1">8</p>
<span class="text-on-surface-variant font-body-sm">Hari Tersisa</span>
</div>
</div>
</div>
<!-- Dashboard Body: Bento Layout -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
<!-- Recent Payslips (2/3 width) -->
<div class="lg:col-span-2 bg-surface-container-lowest rounded-xl border border-border-muted overflow-hidden flex flex-col shadow-sm">
<div class="p-stack-md border-b border-border-muted flex justify-between items-center bg-surface-bg/50">
<h4 class="font-headline-md text-headline-md text-primary">Slip Gaji Terakhir</h4>
<button class="text-primary hover:text-secondary font-label-md text-label-md flex items-center gap-1">
                            Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-bg">
<tr>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Periode</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Gaji Bersih</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase text-center">Status</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-border-muted">
@forelse(auth()->user()->employee->payrolls()->latest()->take(5)->get() as $payroll)
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="px-table-cell-px py-table-cell-py font-body-md">{{ $payroll->periode_bulan }} / {{ $payroll->periode_tahun }}</td>
<td class="px-table-cell-px py-table-cell-py font-mono-data">Rp {{ number_format($payroll->gaji_bersih, 0, ',', '.') }}</td>
<td class="px-table-cell-px py-table-cell-py text-center">
<span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant text-[11px] font-bold rounded-full uppercase">{{ $payroll->status }}</span>
</td>
<td class="px-table-cell-px py-table-cell-py text-right">
<a href="{{ route('employee.detail-slip', $payroll->id) }}" class="p-2 text-primary hover:bg-secondary-container rounded-lg transition-colors inline-block" title="Lihat">
<span class="material-symbols-outlined">visibility</span>
</a>
</td>
</tr>
@empty
<tr>
<td colspan="4" class="px-table-cell-px py-table-cell-py text-center text-on-surface-variant">Belum ada slip gaji</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
<!-- Profile & Info Sidebar -->
<div class="space-y-gutter">
<!-- Profile Card -->
<div class="bg-surface-container-lowest rounded-xl border border-border-muted p-stack-md shadow-sm relative overflow-hidden">
<div class="absolute -right-8 -top-8 w-32 h-32 bg-secondary-container/20 rounded-full blur-2xl"></div>
<h4 class="font-label-md text-label-md text-primary uppercase tracking-widest mb-4 border-b border-border-muted pb-2">Profil Karyawan</h4>
<div class="space-y-4">
<div>
<p class="text-[11px] text-on-surface-variant font-bold uppercase tracking-tight">NIP</p>
<p class="font-mono-data text-body-md text-primary">{{ auth()->user()->employee->nip ?? '-' }}</p>
</div>
<div>
<p class="text-[11px] text-on-surface-variant font-bold uppercase tracking-tight">Jabatan</p>
<p class="font-body-md text-primary">{{ auth()->user()->employee->jabatan ?? '-' }}</p>
</div>
<div>
<p class="text-[11px] text-on-surface-variant font-bold uppercase tracking-tight">Gaji Pokok</p>
<p class="font-body-md text-primary">Rp {{ number_format(auth()->user()->employee->gaji_pokok ?? 0, 0, ',', '.') }}</p>
</div>
<div>
<p class="text-[11px] text-on-surface-variant font-bold uppercase tracking-tight">Join Date</p>
<p class="font-body-md text-primary">{{ auth()->user()->employee ? \Carbon\Carbon::parse(auth()->user()->employee->tanggal_masuk)->format('d F Y') : '-' }}</p>
</div>
<button class="w-full mt-4 bg-primary text-secondary-fixed py-2 rounded-lg font-label-md hover:bg-on-primary-fixed-variant transition-colors flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm">edit</span>
                                Perbarui Profil
                            </button>
</div>
</div>
<!-- Tax Info Card -->
<div class="bg-surface-container-low rounded-xl border border-border-muted p-stack-md">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-primary">verified_user</span>
<p class="font-label-md text-label-md text-primary">Verifikasi Pajak</p>
</div>
<p class="text-body-sm text-on-surface-variant">NPWP Anda telah terverifikasi untuk pelaporan SPT tahunan 2025.</p>
<a class="mt-3 inline-block text-primary underline font-label-md text-[12px]" href="#">Lihat Detail Pajak</a>
</div>
</div>
</div>
<!-- Quick Actions Section -->
<section class="mt-stack-lg">
<h4 class="font-headline-md text-headline-md text-primary mb-4">Aksi Cepat</h4>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-gutter">
<button class="flex flex-col items-center justify-center p-stack-md bg-surface-container-lowest border border-border-muted rounded-xl hover:bg-secondary-container/10 hover:border-secondary transition-all">
<span class="material-symbols-outlined text-3xl text-primary mb-2">description</span>
<span class="font-label-md text-[12px] text-center">Ajukan Cuti</span>
</button>
<button class="flex flex-col items-center justify-center p-stack-md bg-surface-container-lowest border border-border-muted rounded-xl hover:bg-secondary-container/10 hover:border-secondary transition-all">
<span class="material-symbols-outlined text-3xl text-primary mb-2">request_quote</span>
<span class="font-label-md text-[12px] text-center">Klaim Reimburse</span>
</button>
<button class="flex flex-col items-center justify-center p-stack-md bg-surface-container-lowest border border-border-muted rounded-xl hover:bg-secondary-container/10 hover:border-secondary transition-all">
<span class="material-symbols-outlined text-3xl text-primary mb-2">contact_support</span>
<span class="font-label-md text-[12px] text-center">Lapor HR</span>
</button>
<button class="flex flex-col items-center justify-center p-stack-md bg-surface-container-lowest border border-border-muted rounded-xl hover:bg-secondary-container/10 hover:border-secondary transition-all">
<span class="material-symbols-outlined text-3xl text-primary mb-2">history</span>
<span class="font-label-md text-[12px] text-center">Riwayat Absensi</span>
</button>
</div>
</section>
</div>
</main>
<!-- Interactive Layer for Hover Effects -->


@endsection

@section('scripts')
<script>

        document.querySelectorAll('button, a').forEach(el => {
            el.addEventListener('mousedown', () => {
                el.classList.add('scale-95');
                el.style.transition = 'transform 0.1s';
            });
            el.addEventListener('mouseup', () => {
                el.classList.remove('scale-95');
            });
            el.addEventListener('mouseleave', () => {
                el.classList.remove('scale-95');
            });
        });
    
</script>
@endsection
