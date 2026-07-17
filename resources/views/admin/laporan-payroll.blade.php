@extends('layouts.app')

@section('title', 'sigaji_admin_laporan_payroll')

@section('styles')
<style>

      
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
      .glass-panel {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        border: 1px solid #E2E8F0;
      }
      .chart-container {
        position: relative;
        overflow: hidden;
      }
      .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
      }
      .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #bdcac1;
        border-radius: 10px;
      }
    
</style>
@endsection

@section('content')

@include('layouts.partials.admin-sidebar', ['active' => 'laporan'])
<!-- TopAppBar -->
<header class="flex justify-between items-center ml-64 px-container-margin h-16 w-[calc(100%-16rem)] bg-surface-container-lowest dark:bg-surface-container docked full-width top-0 sticky border-b border-border-muted z-40">
<div class="flex items-center gap-6">
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-full text-body-sm font-body-sm w-80 focus:ring-2 focus:ring-secondary focus:bg-white transition-all" placeholder="Cari laporan atau data..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<button class="relative p-2 text-on-surface-variant hover:text-primary transition-colors opacity-80 active:opacity-100">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border border-white"></span>
</button>
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors opacity-80 active:opacity-100">
<span class="material-symbols-outlined" data-icon="help">help</span>
</button>
<div class="h-8 w-px bg-border-muted"></div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="font-label-md text-label-md text-primary leading-none">Admin SiGaji</p>
<p class="text-[10px] text-on-surface-variant uppercase tracking-wider mt-1">HR Administrator</p>
</div>
<img class="w-10 h-10 rounded-full border-2 border-secondary-fixed object-cover" data-alt="A professional close-up headshot of a female HR administrator in a clean modern office. The background is a soft-focus corporate environment with plants and natural lighting. The color palette features whites and deep forest greens, reflecting the SiGaji brand identity for a reliable and professional persona." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFDLOkSZkXUGIykOwtA0PpiUuE77HCNSC0eFAbb_Qkiwc8T0T6LTRBX2o2C1f6WY9ZEVEXxgAUgElZAx41NJ0mHtGaWYW5Co1znFErgzo_ISBFMJauu5MGTQbi-39Vm-Y01xLJzzKINezZAeyCv3kHXkm9N1nKeXTIsapwcMP74IcRZfahuvC07P15SQ6mfSzmNSE_omaMkRoUpn6DehgLgDEf8q8DVRX4XCpzXHOb4Wln2b8WIn_R5l_n4dHIkX0U9y0J8vmgFPI"/>
</div>
</div>
</header>
<!-- Main Content -->
<main class="ml-64 p-stack-lg min-h-screen">
<div class="max-w-[1280px] mx-auto space-y-8">
<!-- Page Header -->
<div class="flex items-end justify-between">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary">Laporan Payroll</h2>
<p class="text-on-surface-variant font-body-md mt-1">Visualisasi data dan ringkasan pengeluaran gaji perusahaan.</p>
</div>
<div class="flex gap-3">
<button class="px-5 py-2.5 rounded border border-border-muted bg-white font-label-md text-label-md text-primary flex items-center gap-2 hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        {{ date('M Y') }}
                    </button>
<button class="px-5 py-2.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md flex items-center gap-2 hover:brightness-95 transition-all shadow-sm">
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">print</span>
                        Cetak Rekapitulasi
                    </button>
</div>
</div>
<!-- Flash Message -->
@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 animate-pulse">
    <span class="material-symbols-outlined text-green-600">check_circle</span>
    <span class="font-label-md">{{ session('success') }}</span>
</div>
@endif
<!-- Summary Cards (Bento Style) -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-gutter">
<div class="bg-white p-6 rounded-xl border border-border-muted shadow-sm group hover:border-secondary transition-colors">
<div class="flex items-center justify-between mb-4">
<div class="p-2 bg-primary-fixed rounded text-on-primary-fixed">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">payments</span>
</div>
<span class="font-label-md text-label-md text-status-success flex items-center">
                            +4.2% <span class="material-symbols-outlined text-sm">trending_up</span>
</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Total Payroll</p>
<h3 class="font-headline-md text-headline-md text-primary mt-2">Rp {{ number_format($payrolls->sum('gaji_bersih'), 0, ',', '.') }}</h3>
</div>
<div class="bg-white p-6 rounded-xl border border-border-muted shadow-sm group hover:border-secondary transition-colors">
<div class="flex items-center justify-between mb-4">
<div class="p-2 bg-secondary-fixed rounded text-primary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">query_stats</span>
</div>
<span class="font-label-md text-label-md text-status-warning flex items-center">
                            Total Item
                        </span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Jumlah Record</p>
<h3 class="font-headline-md text-headline-md text-primary mt-2">{{ count($payrolls) }} Data</h3>
</div>
<div class="bg-white p-6 rounded-xl border border-border-muted shadow-sm group hover:border-secondary transition-colors">
<div class="flex items-center justify-between mb-4">
<div class="p-2 bg-surface-container-high rounded text-primary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person_pin</span>
</div>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Avg. Gaji / Payroll</p>
<h3 class="font-headline-md text-headline-md text-primary mt-2">Rp {{ count($payrolls) > 0 ? number_format($payrolls->sum('gaji_bersih') / count($payrolls), 0, ',', '.') : 0 }}</h3>
</div>
<div class="bg-white p-6 rounded-xl border border-border-muted shadow-sm group hover:border-secondary transition-colors">
<div class="flex items-center justify-between mb-4">
<div class="p-2 bg-tertiary-fixed rounded text-primary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">groups</span>
</div>
<span class="text-on-surface-variant text-xs">Aktif Karyawan</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Total Karyawan</p>
<h3 class="font-headline-md text-headline-md text-primary mt-2">{{ \App\Models\Employee::count() }} Orang</h3>
</div>
</div>
<div class="grid grid-cols-12 gap-gutter">
<!-- Main Chart Section -->
<div class="col-span-12 lg:col-span-8 space-y-gutter">
<div class="bg-white p-6 rounded-xl border border-border-muted shadow-sm">
<div class="flex items-center justify-between mb-8">
<div>
<h4 class="font-headline-md text-headline-md text-primary">Payroll Cost Trends</h4>
<p class="text-on-surface-variant text-body-sm">Analisis pengeluaran gaji 6 bulan terakhir</p>
</div>
<div class="flex items-center gap-2">
<span class="flex items-center gap-1 text-xs text-on-surface-variant">
<span class="w-3 h-3 rounded-full bg-primary-container"></span> Gaji Pokok
                                </span>
<span class="flex items-center gap-1 text-xs text-on-surface-variant">
<span class="w-3 h-3 rounded-full bg-secondary-fixed"></span> Tunjangan
                                </span>
</div>
</div>
<!-- Dynamic Chart (Simulasi jika data kosong, riil jika ada) -->
@php
    $months = $payrolls->count() > 0 ? $payrolls->pluck('periode_bulan')->unique()->take(6)->values()->reverse() : collect(['Des', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei']);
@endphp
<!-- Simulated Chart -->
<div class="h-64 flex items-end justify-between px-4 pb-2 relative">
<div class="absolute inset-0 flex flex-col justify-between pointer-events-none px-4">
<div class="border-b border-slate-100 w-full h-px"></div>
<div class="border-b border-slate-100 w-full h-px"></div>
<div class="border-b border-slate-100 w-full h-px"></div>
<div class="border-b border-slate-100 w-full h-px"></div>
</div>
<div class="relative w-full h-full flex items-end justify-around">
<!-- Chart Bars -->
@foreach($months as $idx => $m)
@php
    $height = 60 + ($idx * 5); // Just a simple staggered height simulation for now
    $tunjanganHeight = 20 + ($idx * 2);
@endphp
<div class="flex flex-col items-center gap-2 w-12">
<div class="w-full bg-slate-100 rounded-t-sm h-[{{ $height }}%] relative group">
<div class="absolute bottom-0 w-full bg-primary-container h-[{{ $height - 5 }}%] rounded-t-sm transition-all group-hover:brightness-110"></div>
<div class="absolute bottom-0 w-full bg-secondary-fixed h-[{{ $tunjanganHeight }}%] rounded-t-sm opacity-80"></div>
</div>
<span class="text-xs font-label-md {{ $loop->last ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">{{ substr($m, 0, 3) }}</span>
</div>
@endforeach
</div>
</div>
</div>
<!-- Table Section -->
<div class="bg-white rounded-xl border border-border-muted shadow-sm overflow-hidden">
<div class="p-6 border-b border-border-muted flex items-center justify-between">
<h4 class="font-headline-md text-headline-md text-primary">Daftar Laporan Terkini</h4>
<button class="text-secondary font-label-md text-label-md flex items-center gap-1 hover:underline">
                                Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-bg border-b border-border-muted">
<tr>
<th class="px-table-cell-px py-table-cell-py text-label-md font-label-md text-primary uppercase">Periode</th>
<th class="px-table-cell-px py-table-cell-py text-label-md font-label-md text-primary uppercase">Tgl Diproses</th>
<th class="px-table-cell-px py-table-cell-py text-label-md font-label-md text-primary uppercase">Total Biaya</th>
<th class="px-table-cell-px py-table-cell-py text-label-md font-label-md text-primary uppercase">Status</th>
<th class="px-table-cell-px py-table-cell-py text-label-md font-label-md text-primary uppercase text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-border-muted">
@forelse($payrolls as $payroll)
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="px-table-cell-px py-table-cell-py font-bold text-primary">{{ $payroll->periode_bulan }} / {{ $payroll->periode_tahun }} <br><span class="text-xs font-normal text-on-surface-variant">{{ $payroll->employee->nama }}</span></td>
<td class="px-table-cell-px py-table-cell-py text-body-sm">{{ \Carbon\Carbon::parse($payroll->generated_at)->format('d M Y') }}</td>
<td class="px-table-cell-px py-table-cell-py font-mono-data">Rp {{ number_format($payroll->gaji_bersih, 0, ',', '.') }}</td>
<td class="px-table-cell-px py-table-cell-py">
<span class="px-2 py-1 bg-tertiary-fixed text-status-success text-[10px] font-bold rounded uppercase">{{ $payroll->status }}</span>
</td>
<td class="px-table-cell-px py-table-cell-py text-right">
<button class="p-2 hover:bg-white rounded border border-transparent hover:border-border-muted transition-all text-secondary">
<span class="material-symbols-outlined">visibility</span>
</button>
</td>
</tr>
@empty
<tr>
<td colspan="5" class="px-table-cell-px py-table-cell-py text-center text-on-surface-variant">Belum ada data payroll</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div>
<!-- Sidebar Content -->
<div class="col-span-12 lg:col-span-4 space-y-gutter">
<!-- Pie Chart / Budget Distribution -->
<div class="bg-white p-6 rounded-xl border border-border-muted shadow-sm">
<h4 class="font-headline-md text-headline-md text-primary mb-6">Gaji per Departemen</h4>
<div class="flex items-center justify-center relative py-6">
<!-- Simulated Doughnut Chart -->
<div class="w-48 h-48 rounded-full border-[20px] border-primary-container relative flex items-center justify-center">
<div class="absolute inset-[-20px] rounded-full border-[20px] border-secondary-fixed" style="clip-path: polygon(50% 50%, 50% 0, 100% 0, 100% 50%)"></div>
<div class="absolute inset-[-20px] rounded-full border-[20px] border-on-secondary-container" style="clip-path: polygon(50% 50%, 100% 50%, 100% 100%, 75% 100%)"></div>
<div class="text-center">
<p class="text-xs text-on-surface-variant font-label-md uppercase tracking-tighter">Total</p>
<p class="font-bold text-primary">100%</p>
</div>
</div>
</div>
@php
    $totalGajiAll = $payrolls->sum('gaji_bersih');
    $jabatanStats = $payrolls->groupBy(function($p) { return $p->employee->jabatan; })->map(function($group) { return $group->sum('gaji_bersih'); });
    $colors = ['bg-primary-container', 'bg-secondary-fixed', 'bg-on-secondary-container', 'bg-slate-200', 'bg-error-container'];
@endphp
<div class="space-y-3 mt-6">
@forelse($jabatanStats as $jab => $total)
    <div class="flex items-center justify-between p-2 rounded hover:bg-surface-bg transition-colors">
    <div class="flex items-center gap-3">
    <span class="w-3 h-3 rounded-full {{ $colors[$loop->index % count($colors)] }}"></span>
    <span class="text-body-sm font-medium">{{ $jab }}</span>
    </div>
    <span class="font-mono-data text-primary">{{ $totalGajiAll > 0 ? round(($total / $totalGajiAll) * 100) : 0 }}%</span>
    </div>
@empty
    <div class="text-center text-on-surface-variant text-sm py-4">Belum ada data</div>
@endforelse
</div>
</div>
<!-- Quick Actions -->
<div class="bg-primary text-white p-6 rounded-xl shadow-lg relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-secondary-fixed opacity-10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
<h4 class="font-headline-md text-headline-md text-secondary-fixed mb-6 relative z-10">Quick Actions</h4>
<div class="space-y-4 relative z-10">
<button class="w-full flex items-center justify-between p-4 bg-on-primary-fixed-variant rounded-lg group hover:bg-secondary-fixed hover:text-primary transition-all duration-300">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary-fixed group-hover:text-primary">table_view</span>
<span class="font-label-md text-label-md">Export Rekap (Excel)</span>
</div>
<span class="material-symbols-outlined text-[18px]">download</span>
</button>
<button class="w-full flex items-center justify-between p-4 bg-on-primary-fixed-variant rounded-lg group hover:bg-secondary-fixed hover:text-primary transition-all duration-300">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary-fixed group-hover:text-primary">history_edu</span>
<span class="font-label-md text-label-md">Laporan Tahunan</span>
</div>
<span class="material-symbols-outlined text-[18px]">download</span>
</button>
<button class="w-full flex items-center justify-between p-4 bg-on-primary-fixed-variant rounded-lg group hover:bg-secondary-fixed hover:text-primary transition-all duration-300">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary-fixed group-hover:text-primary">settings_applications</span>
<span class="font-label-md text-label-md">Pengaturan Laporan</span>
</div>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
<!-- Promo/Notice Card -->
<div class="bg-surface-container-high p-6 rounded-xl border border-secondary-fixed/30">
<div class="flex gap-4">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">info</span>
<div>
<h5 class="font-bold text-primary">System Update</h5>
<p class="text-sm text-on-surface-variant mt-1">Laporan pajak PPh 21 kini sudah tersedia untuk periode 2024. Periksa di menu Pengaturan.</p>
<a class="text-xs font-bold text-primary mt-3 inline-block underline" href="#">Lihat Pembaruan</a>
</div>
</div>
</div>
</div>
</div>
</div>
</main>


@endsection

@section('scripts')
<script>

        // Simple interactivity for demonstration
        document.querySelectorAll('button, a').forEach(el => {
            el.addEventListener('mousedown', () => {
                el.classList.add('scale-95');
                setTimeout(() => el.classList.remove('scale-95'), 150);
            });
        });
        
        // Search bar focus effect
        const searchInput = document.querySelector('input[type="text"]');
        searchInput?.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('ring-2', 'ring-secondary/20');
        });
        searchInput?.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('ring-2', 'ring-secondary/20');
        });
    
</script>
@endsection
