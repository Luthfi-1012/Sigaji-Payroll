@extends('layouts.app')

@section('title', 'sigaji_admin_generate_payroll')

@section('styles')
<style>

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #294e41;
            border-radius: 10px;
        }
    
</style>
@endsection

@section('content')

@include('layouts.partials.admin-sidebar', ['active' => 'payroll'])
<!-- Main Content Area -->
<div class="ml-64 min-h-screen flex flex-col">
<!-- TopAppBar -->
<header class="flex justify-between items-center px-container-margin h-16 w-full sticky top-0 bg-surface-container-lowest dark:bg-surface-container border-b border-border-muted z-40">
<div class="flex items-center gap-4 flex-1">
<div class="relative w-full max-w-md">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="w-full bg-surface-bright border border-border-muted rounded-full py-2 pl-10 pr-4 text-body-sm focus:outline-none focus:ring-2 focus:ring-secondary-fixed/20 focus:border-secondary" placeholder="Cari data payroll atau karyawan..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<div class="flex items-center gap-4">
<button class="p-2 text-on-surface-variant hover:text-primary transition-opacity active:opacity-80">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-primary transition-opacity active:opacity-80">
<span class="material-symbols-outlined">help</span>
</button>
</div>
<div class="h-8 w-px bg-border-muted"></div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="font-label-md text-primary">{{ Auth::user()->name }}</p>
<p class="text-xs text-on-surface-variant">Administrator</p>
</div>
<img class="w-10 h-10 rounded-full border border-border-muted object-cover" data-alt="A professional headshot of a corporate HR administrator with a friendly expression, wearing professional attire, set against a clean, minimalist office background in high-key lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXe6g2fSWVX1ApfJOIg5bJ9cUT2YTYPYVWxgVIJjSQh8V2gMLRLzM1_q0Prp-vxAzK4mSQbzaSrWD4kJLJJTVXMqPAlAqN0_1N3hUmJV4w1Irwi3T6pdVDcSD05hp-I1gZX9OeGm2Sc6j75gsGKdV7yD8M3KPyOKZtBAQDNl00vh8-PhNYuxtOhvwGa9CUxzo5KJZrMkin7_YskBvLrbad354SOXkmQQSmqI9DhE-_KIS-2Gex5VHNnmoYk--Tlzczg33eDtICAc0"/>
</div>
</div>
</header>
<!-- Page Content -->
<main class="p-container-margin flex-1 flex flex-col gap-6 overflow-y-auto">
<!-- Breadcrumb & Header -->
<div class="flex flex-col gap-1">
<nav class="flex items-center gap-2 text-on-surface-variant font-label-md">
<span class="hover:text-primary cursor-pointer">Payroll</span>
<span class="material-symbols-outlined text-sm">chevron_right</span>
<span class="text-primary font-bold">Generate</span>
</nav>
<h2 class="font-headline-lg text-headline-lg text-primary">Proses Payroll Bulanan</h2>
<p class="text-on-surface-variant font-body-md">Hitung dan validasi gaji seluruh karyawan dalam satu siklus terpadu.</p>
</div>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-12 gap-6 items-start">
<!-- Main Configuration Card -->
<section class="col-span-12 lg:col-span-8 space-y-6">
<div class="bg-surface-container-lowest border border-border-muted rounded-xl p-8 flex flex-col gap-8">
<div class="flex items-center gap-4">
<div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center text-on-secondary-container">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">calendar_month</span>
</div>
<div>
<h3 class="font-headline-md text-primary">Konfigurasi Periode</h3>
<p class="text-body-sm text-on-surface-variant">Pilih bulan dan tahun periode payroll yang ingin diproses.</p>
</div>
</div>
<form action="{{ route('admin.payroll.generate') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-2">
    <label class="font-label-md text-primary">Bulan</label>
    <div class="relative">
    <select name="periode_bulan" class="w-full bg-surface-bright border border-border-muted rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary focus:border-secondary">
    @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
        <option value="{{ sprintf('%02d', $loop->iteration) }}" {{ $currentMonth == sprintf('%02d', $loop->iteration) ? 'selected' : '' }}>{{ $month }}</option>
    @endforeach
    </select>
    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
    </div>
    </div>
    <div class="space-y-2">
    <label class="font-label-md text-primary">Tahun</label>
    <div class="relative">
    <select name="periode_tahun" class="w-full bg-surface-bright border border-border-muted rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary focus:border-secondary">
    @for($y = $currentYear - 2; $y <= $currentYear + 2; $y++)
        <option value="{{ $y }}" {{ $currentYear == $y ? 'selected' : '' }}>{{ $y }}</option>
    @endfor
    </select>
    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
    </div>
    </div>
    </div>
    <!-- Status Alert Box -->
    <div class="bg-secondary-container/20 border border-secondary-fixed-dim/30 rounded-lg p-4 flex items-start gap-4 mt-6">
    <span class="material-symbols-outlined text-secondary">info</span>
    <div>
    <p class="font-label-md text-on-secondary-container">Status Periode: Open</p>
    <p class="text-body-sm text-on-secondary-container/80">Semua data kehadiran dan lembur telah divalidasi dan siap untuk kalkulasi final.</p>
    </div>
    </div>
    <!-- Generate Button -->
    <button type="submit" class="w-full mt-6 bg-secondary-fixed hover:bg-secondary-fixed-dim text-on-secondary-fixed font-headline-md py-4 rounded-xl shadow-lg shadow-secondary-fixed/20 transition-all flex items-center justify-center gap-3 active:scale-[0.98]">
    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">play_circle</span>
                                Generate Payroll
                            </button>
</form>
</div>
<!-- Ringkasan Karyawan -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<div class="bg-surface-container-lowest border border-border-muted rounded-xl p-6 flex flex-col gap-2">
<p class="text-on-surface-variant font-label-md">Total Karyawan</p>
<h4 class="font-headline-lg text-primary">{{ count($employees) }}</h4>
<p class="text-status-success text-xs font-label-md flex items-center gap-1">
<span class="material-symbols-outlined text-sm">check_circle</span>
                                Siap diproses
                            </p>
</div>
<div class="bg-surface-container-lowest border border-border-muted rounded-xl p-6 flex flex-col gap-2">
<p class="text-on-surface-variant font-label-md">Departemen</p>
<h4 class="font-headline-lg text-primary">{{ $employees->unique('jabatan')->count() }}</h4>
<p class="text-on-surface-variant text-xs font-label-md">Aktif bulan ini</p>
</div>
<div class="bg-surface-container-lowest border border-border-muted rounded-xl p-6 flex flex-col gap-2">
<p class="text-on-surface-variant font-label-md">Estimasi Total</p>
<h4 class="font-headline-lg text-primary text-secondary">Rp {{ number_format($employees->sum('gaji_pokok'), 0, ',', '.') }}</h4>
<p class="text-on-surface-variant text-xs font-label-md">Berdasarkan data master</p>
</div>
</div>
</section>
<!-- Sidebar Content (Activity Log) -->
<aside class="col-span-12 lg:col-span-4 space-y-6">
<div class="bg-surface-container-lowest border border-border-muted rounded-xl p-6 flex flex-col gap-6">
<div class="flex items-center justify-between">
<h3 class="font-label-md text-primary flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-lg">history</span>
                                Log Aktivitas Terakhir
                            </h3>
<button class="text-xs text-secondary font-label-md hover:underline">Lihat Semua</button>
</div>
@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 animate-pulse" id="flashMsg">
    <span class="material-symbols-outlined text-green-600">check_circle</span>
    <span class="font-label-md">{{ session('success') }}</span>
</div>
@else
<div class="flex items-center justify-center py-8 text-on-surface-variant flex-col gap-2">
    <span class="material-symbols-outlined text-4xl opacity-50">receipt_long</span>
    <p class="text-sm font-label-md">Pilih bulan dan tahun di sebelah kiri, lalu klik Generate Payroll untuk memproses gaji bulan ini.</p>
</div>
@endif
</div>
<!-- Visual Accent Card -->
<div class="relative bg-primary overflow-hidden rounded-xl p-8 group">

<div class="relative z-10 text-white space-y-4">
<h4 class="font-headline-md text-secondary-fixed">Tips Efisiensi</h4>
<p class="text-body-sm opacity-80 leading-relaxed">Pastikan semua data cuti dan izin sudah disetujui oleh manager departemen sebelum melakukan proses generate akhir.</p>
<button class="flex items-center gap-2 text-secondary-fixed font-label-md group-hover:gap-4 transition-all">
                                Pelajari Lebih Lanjut
                                <span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
</aside>
</div>
</main>
</div>
<!-- Scripts for Micro-interactions -->


@endsection

@section('scripts')
<script>

        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const generateBtn = document.querySelector('button.bg-secondary-fixed');
            
            form.addEventListener('submit', () => {
                generateBtn.innerHTML = `
                    <span class="material-symbols-outlined animate-spin">sync</span>
                    Memproses...
                `;
                // Allow the form to submit normally without preventDefault
            });
        });
    
</script>
@endsection
