@extends('layouts.app')

@section('title', 'sigaji_detail_slip_gaji')

@section('styles')
<style>

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        .payslip-document {
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        @media print {
            .no-print { display: none; }
            .print-area { margin: 0; padding: 0; box-shadow: none; border: none; }
        }
    
</style>
@endsection

@section('content')

@include('layouts.partials.employee-sidebar', ['active' => 'slip-gaji'])
<!-- Main Content Wrapper -->
<div class="ml-64 flex flex-col min-h-screen bg-surface-container-low">
<!-- Top App Bar -->
<header class="flex justify-between items-center px-container-margin h-16 w-full sticky top-0 bg-surface-container-lowest dark:bg-surface-container border-b border-border-muted z-40 no-print">
<div class="flex items-center gap-4 flex-1">
<div class="relative w-full max-w-md">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="w-full pl-10 pr-4 py-2 rounded-xl border border-border-muted bg-surface-bright focus:border-secondary-container focus:ring-2 focus:ring-secondary-container/20 text-body-sm transition-all outline-none" placeholder="Cari slip gaji..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-on-surface-variant hover:text-primary transition-opacity active:opacity-80">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-primary transition-opacity active:opacity-80">
<span class="material-symbols-outlined">help</span>
</button>
<div class="h-8 w-[1px] bg-border-muted mx-2"></div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="font-label-md text-label-md text-on-surface leading-none">{{ auth()->user()->employee->nama ?? auth()->user()->name }}</p>
<p class="text-[10px] text-on-surface-variant uppercase tracking-tighter">{{ auth()->user()->employee->jabatan ?? 'Karyawan' }}</p>
</div>
<img alt="Administrator Profile" class="w-10 h-10 rounded-full border-2 border-surface-container-highest" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhfwr3tJEMXxhSw10Tg2VBmUx30r4j4SHRh86je_VO3GABarY5-ehY4BK4N1Y-2VnHzHrd8YFlFEqlZ8K603Rk66RPRH4g-TRTITcGyOhPuw36pTQtNeldvuniln1YOkFZm5sVKLAwCMRPlORbGQCbVG0edzkOXZ5wBOWmhqmS7Ea4m2wqcp_aO6m7XNfNIk8kDmNQx5J40bF0IDGMC2XXjRfN1FJl8Rw7yDTCnTebw3EfyW52eDcKl2dhUgbp29ak87DIbpk5y3o"/>
</div>
</div>
</header>
<!-- Content Canvas -->
<main class="p-container-margin flex flex-col gap-stack-lg flex-grow">
<!-- Page Header Section -->
<section class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 no-print">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary">Detail Slip Gaji</h2>
<nav class="flex gap-2 text-on-surface-variant font-label-md text-[12px] mt-1">
<a class="hover:text-primary" href="{{ route('employee.dashboard') }}">Dashboard</a>
<span>/</span>
<a class="hover:text-primary" href="{{ route('employee.riwayat-slip') }}">Riwayat Gaji</a>
<span>/</span>
<span class="text-primary font-bold">{{ $payroll->employee->nip }}</span>
</nav>
</div>
<button class="flex items-center gap-2 px-6 py-3 bg-secondary-container text-on-secondary-container font-label-md text-label-md rounded-xl hover:bg-secondary-fixed-dim transition-all active:scale-95" onclick="window.print()">
<span class="material-symbols-outlined">picture_as_pdf</span>
                    Cetak PDF
                </button>
</section>
<!-- Payslip Document Container -->
<div class="flex justify-center">
<section class="payslip-document print-area w-full max-w-[850px] bg-surface-container-lowest border border-border-muted rounded-xl p-12 flex flex-col gap-8">
<!-- Document Header -->
<div class="flex justify-between items-start border-b-2 border-primary-container pb-8">
<div class="flex items-center gap-4">
<img alt="SiGaji Enterprise Logo" class="w-16 h-16 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMnLHkGhfVxdO2rGdizNmM2R_6KNAuweWmfb4jgeO1dQs0_ZrNhyX8lJrzShHzbpmfqP3ASXDFdGH69EdSMB1np6JVtuJ29mRu19S_KX5Zj3ZP-LVtkjaYsqH8xCNAGinUW7aP9xQTGaSE8swbPUsamZ2yuOFKJCXWS6UrcJydCJCcU923HuYejT8CPC1m40vhV9Flg5jTrnSHgWj8wK41suD6dBMlSQepATMM5c_nGH9TWyv4WiB7dybUEXuQFxTtQK4FNsET6us"/>
<div>
<h3 class="font-headline-md text-headline-md text-primary-container m-0">SiGaji Enterprise</h3>
<p class="text-body-sm text-on-surface-variant max-w-[240px]">Sentra Bisnis Harmoni, Lantai 4, Jakarta Pusat 10120. Telp: (021) 555-0982</p>
</div>
</div>
<div class="text-right">
<h4 class="font-headline-md text-headline-md text-primary tracking-tight">SLIP GAJI KARYAWAN</h4>
<p class="text-body-sm font-bold text-on-surface-variant">Private & Confidential</p>
</div>
</div>
<!-- Employee Information Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 py-4 px-2 bg-surface-bg rounded-lg">
<div class="flex justify-between border-b border-border-muted pb-2">
<span class="text-label-md text-on-surface-variant font-medium">NIP</span>
<span class="text-label-md text-primary font-bold">{{ $payroll->employee->nip }}</span>
</div>
<div class="flex justify-between border-b border-border-muted pb-2">
<span class="text-label-md text-on-surface-variant font-medium">Periode</span>
<span class="text-label-md text-primary font-bold">{{ $payroll->periode_bulan }} / {{ $payroll->periode_tahun }}</span>
</div>
<div class="flex justify-between border-b border-border-muted pb-2">
<span class="text-label-md text-on-surface-variant font-medium">Nama</span>
<span class="text-label-md text-primary font-bold">{{ $payroll->employee->nama }}</span>
</div>
<div class="flex justify-between border-b border-border-muted pb-2">
<span class="text-label-md text-on-surface-variant font-medium">Tanggal Transfer</span>
<span class="text-label-md text-primary font-bold">{{ \Carbon\Carbon::parse($payroll->generated_at)->format('d F Y') }}</span>
</div>
<div class="flex justify-between border-b border-border-muted pb-2">
<span class="text-label-md text-on-surface-variant font-medium">Jabatan</span>
<span class="text-label-md text-primary font-bold">{{ $payroll->employee->jabatan }}</span>
</div>
<div class="flex justify-between border-b border-border-muted pb-2">
<span class="text-label-md text-on-surface-variant font-medium">Status Pajak</span>
<span class="text-label-md text-primary font-bold">K/1 (Menikah)</span>
</div>
</div>
<!-- Financial Tables -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Earnings (Pendapatan) -->
<div class="flex flex-col gap-4">
<div class="bg-primary-container px-4 py-2 rounded-t-lg">
<h5 class="font-label-md text-label-md text-secondary-fixed uppercase">Pendapatan</h5>
</div>
<table class="w-full text-left">
<tbody class="divide-y divide-border-muted text-body-sm">
<tr>
<td class="py-3 px-2 text-on-surface">Gaji Pokok</td>
<td class="py-3 px-2 text-right font-mono-data">Rp {{ number_format($payroll->gaji_pokok, 0, ',', '.') }}</td>
</tr>
<tr>
<td class="py-3 px-2 text-on-surface">Tunjangan</td>
<td class="py-3 px-2 text-right font-mono-data">Rp {{ number_format($payroll->total_tunjangan, 0, ',', '.') }}</td>
</tr>
<tr class="bg-surface-bg font-bold">
<td class="py-3 px-2 text-primary">Total Pendapatan</td>
<td class="py-3 px-2 text-right text-primary font-mono-data">Rp {{ number_format($payroll->gaji_pokok + $payroll->total_tunjangan, 0, ',', '.') }}</td>
</tr>
</tbody>
</table>
</div>
<!-- Deductions (Potongan) -->
<div class="flex flex-col gap-4">
<div class="bg-primary-container px-4 py-2 rounded-t-lg">
<h5 class="font-label-md text-label-md text-secondary-fixed uppercase">Potongan</h5>
</div>
<table class="w-full text-left">
<tbody class="divide-y divide-border-muted text-body-sm">
<tr>
<td class="py-3 px-2 text-on-surface">Total Potongan</td>
<td class="py-3 px-2 text-right font-mono-data">Rp {{ number_format($payroll->total_potongan, 0, ',', '.') }}</td>
</tr>
<tr class="h-[89px]">
<td colspan="2"></td>
</tr>
<tr class="bg-surface-bg font-bold">
<td class="py-3 px-2 text-status-error">Total Potongan</td>
<td class="py-3 px-2 text-right text-status-error font-mono-data">Rp {{ number_format($payroll->total_potongan, 0, ',', '.') }}</td>
</tr>
</tbody>
</table>
</div>
</div>
<!-- Summary Section -->
<div class="mt-4 flex flex-col items-end gap-4 border-t-2 border-dashed border-border-muted pt-8">
<div class="flex items-center gap-8 bg-secondary-container/10 border-2 border-secondary-container px-10 py-6 rounded-2xl w-full md:w-auto">
<span class="font-headline-md text-headline-md text-primary">Total Gaji Bersih</span>
<span class="font-display-lg text-display-lg text-secondary">Rp {{ number_format($payroll->gaji_bersih, 0, ',', '.') }}</span>
</div>
<div class="flex items-center gap-3 w-full md:w-auto justify-end">
<span class="font-label-md text-label-md text-on-surface-variant">Status Pembayaran:</span>
@if($payroll->isSudahDibayar())
    <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-100 text-green-800 text-[12px] font-bold rounded-full uppercase">
        <span class="material-symbols-outlined text-[16px]">check_circle</span>
        Sudah Dibayar — {{ $payroll->dibayar_at->format('d M Y, H:i') }}
    </span>
@else
    <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-100 text-amber-800 text-[12px] font-bold rounded-full uppercase">
        <span class="material-symbols-outlined text-[16px]">schedule</span>
        Belum Dibayar
    </span>
@endif
</div>
</div>
<!-- Footer / Signature Area -->
<div class="mt-8 flex flex-col md:flex-row justify-between items-end gap-12">
<div class="text-body-sm text-on-surface-variant italic">
                            Generated on: 20 Juni 2026, 09:42 WIB<br/>
                            *Ini adalah dokumen sah yang dihasilkan secara elektronik oleh sistem SiGaji.
                        </div>
<div class="flex flex-col items-center min-w-[200px] gap-20">
<p class="text-label-md text-primary uppercase font-bold tracking-widest">HR Department</p>
<div class="text-center">
<p class="text-body-md font-bold text-on-surface underline">Indra Wijaya</p>
<p class="text-body-sm text-on-surface-variant">VP Human Capital</p>
</div>
</div>
</div>
</section>
</div>
<!-- Additional Micro-interactions / Feedback -->
<div class="flex justify-center no-print">
<div class="flex gap-4">
<button class="flex items-center gap-2 px-6 py-2 border border-border-muted text-on-surface-variant font-label-md text-label-md rounded-lg hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined">share</span>
                        Bagikan
                    </button>
<button class="flex items-center gap-2 px-6 py-2 border border-border-muted text-on-surface-variant font-label-md text-label-md rounded-lg hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined">email</span>
                        Kirim Email
                    </button>
</div>
</div>
</main>
</div>
<!-- Micro-interaction Script -->


@endsection

@section('scripts')
<script>

        // Simple ripple effect for buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function(e) {
                let ripple = document.createElement('span');
                ripple.classList.add('absolute', 'bg-white/30', 'rounded-full', 'transform', 'scale-0', 'animate-ping');
                ripple.style.left = e.offsetX + 'px';
                ripple.style.top = e.offsetY + 'px';
                ripple.style.width = '20px';
                ripple.style.height = '20px';
                this.classList.add('relative', 'overflow-hidden');
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Hover animation for document
        const payslip = document.querySelector('.payslip-document');
        if (payslip) {
            payslip.addEventListener('mouseenter', () => {
                payslip.style.transform = 'translateY(-4px)';
                payslip.style.transition = 'transform 0.3s ease-out, box-shadow 0.3s ease-out';
                payslip.style.boxShadow = '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)';
            });
            payslip.addEventListener('mouseleave', () => {
                payslip.style.transform = 'translateY(0px)';
                payslip.style.boxShadow = '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)';
            });
        }
    
</script>
@endsection
