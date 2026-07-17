@extends('layouts.app')

@section('title', 'sigaji_riwayat_slip_gaji_saya_employee')

@section('styles')
<style>

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .sidebar-active {
            color: #aaf859 !important;
            background-color: rgba(41, 78, 65, 0.4);
            border-right: 4px solid #aaf859;
        }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    
</style>
@endsection

@section('content')

@include('layouts.partials.employee-sidebar', ['active' => 'slip-gaji'])
<!-- Main Content Area -->
<main class="flex-1 ml-64 min-h-screen flex flex-col">
<!-- Top App Bar -->
<header class="h-16 sticky top-0 bg-surface-container-lowest border-b border-border-muted flex items-center justify-between px-container-margin z-40">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-primary">history</span>
<span class="font-headline-md text-headline-md font-bold text-primary">Riwayat Gaji</span>
</div>
<div class="flex items-center gap-6">
<div class="flex items-center gap-3 pr-6 border-r border-border-muted">
<button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">notifications</button>
<button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">help</button>
</div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="font-label-md text-label-md text-on-surface">{{ auth()->user()->employee->nama ?? auth()->user()->name }}</p>
<p class="text-[11px] text-on-surface-variant uppercase tracking-wider">{{ auth()->user()->employee->jabatan ?? 'Karyawan' }}</p>
</div>
<div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center overflow-hidden border border-border-muted">
<img class="w-full h-full object-cover" data-alt="A professional headshot of a smiling middle-aged Indonesian office worker in a clean white corporate shirt. The lighting is soft and even, suggesting a bright office environment. The style is modern corporate photography with a shallow depth of field and a neutral, professional background that aligns with a clean SaaS platform aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBr2g6apd2bAiR6x1-1gHenT4y_gqIzKFfOd79llRxLSRuS9O46kb3vXvEVoxdPwdTHl6qxEhdPQECRbZd_j_j_9hR_ai1E4mJV4aIDpGmGYs3v-CgqvFaIrqIsSi46tgu9oS3U9sWz0uMQ4vY00jSjy4D_mNGLxOpW3TqpY8lnBcH7zpUSxdHOV211SGMnlO_MXtSc-CtmEsTL5FXkwu7gawzgmDSZG6tKpj0MyMDe8MyHkocv4LMs-86_DuQe7Jy7KKjY0e_-nFo"/>
</div>
</div>
</div>
</header>
<!-- Content Canvas -->
<div class="p-container-margin space-y-stack-lg">
<!-- Page Header & Filter -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-gutter">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary">Riwayat Slip Gaji Saya</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-base max-w-2xl">
                        Akses transparan ke seluruh riwayat kompensasi Anda. Pantau pertumbuhan penghasilan dan rincian deduksi secara periodik.
                    </p>
</div>
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant">Filter Tahun</label>
<select class="bg-surface-container-lowest border border-border-muted rounded-lg px-4 py-2 font-body-sm text-on-surface focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all">
<option value="2024">2024 (Tahun Berjalan)</option>
<option value="2023">2023</option>
<option value="2022">2022</option>
</select>
</div>
</div>
<!-- Bento Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Total Earnings YTD -->
<div class="bg-surface-container-lowest p-stack-md border border-border-muted rounded-xl relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-[64px]">account_balance_wallet</span>
</div>
<p class="font-label-md text-label-md text-on-surface-variant">Penghasilan Kotor (YTD {{ date('Y') }})</p>
<h3 class="font-headline-lg text-headline-lg text-primary mt-base">Rp {{ number_format(auth()->user()->employee->payrolls()->where('periode_tahun', date('Y'))->sum('gaji_pokok') + auth()->user()->employee->payrolls()->where('periode_tahun', date('Y'))->sum('total_tunjangan'), 0, ',', '.') }}</h3>
<div class="mt-4 flex items-center gap-2 text-status-success">
<span class="material-symbols-outlined text-sm">trending_up</span>
</div>
</div>
<!-- Last Salary -->
<div class="bg-primary-container p-stack-md border border-border-muted rounded-xl relative overflow-hidden">
<div class="absolute -bottom-2 -right-2 w-24 h-24 bg-secondary opacity-20 blur-3xl"></div>
<p class="font-label-md text-label-md text-primary-fixed-dim/80">Gaji Terakhir</p>
<h3 class="font-headline-lg text-headline-lg text-secondary-fixed mt-base">Rp {{ number_format(auth()->user()->employee->payrolls()->latest()->first()->gaji_bersih ?? 0, 0, ',', '.') }}</h3>
<p class="font-body-sm text-body-sm text-primary-fixed-dim mt-4">Sudah dibayarkan</p>
</div>
<!-- Total Deductions YTD -->
<div class="bg-surface-container-lowest p-stack-md border border-border-muted rounded-xl relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-[64px]">savings</span>
</div>
<p class="font-label-md text-label-md text-on-surface-variant">Total Potongan (YTD {{ date('Y') }})</p>
<h3 class="font-headline-lg text-headline-lg text-status-error mt-base">Rp {{ number_format(auth()->user()->employee->payrolls()->where('periode_tahun', date('Y'))->sum('total_potongan'), 0, ',', '.') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-4">Termasuk PPh21, BPJS, &amp; Asuransi</p>
</div>
</div>
<!-- Main Data Table Container -->
<div class="bg-surface-container-lowest border border-border-muted rounded-xl overflow-hidden shadow-sm">
<div class="p-stack-md border-b border-border-muted flex justify-between items-center bg-surface-bg/50">
<h4 class="font-headline-md text-[18px] text-primary">Daftar Slip Gaji</h4>
<button class="bg-secondary text-primary-container hover:bg-secondary-fixed transition-all flex items-center gap-2 px-6 py-2 rounded-lg font-label-md text-label-md">
<span class="material-symbols-outlined text-sm">download_for_offline</span>
                        Unduh ZIP (2024)
                    </button>
</div>
<div class="overflow-x-auto scrollbar-hide">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-bg border-b border-border-muted">
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Periode</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Tanggal Bayar</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Gaji Pokok</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Tunjangan</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Potongan</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Gaji Bersih</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase">Status</th>
<th class="px-table-cell-px py-table-cell-py font-label-md text-label-md text-primary uppercase text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-border-muted">
@forelse($payrolls as $payroll)
<tr class="hover:bg-tertiary-fixed/30 transition-colors group">
<td class="px-table-cell-px py-table-cell-py font-body-md text-on-surface">{{ $payroll->periode_bulan }} / {{ $payroll->periode_tahun }}</td>
<td class="px-table-cell-px py-table-cell-py font-body-sm text-on-surface-variant">{{ \Carbon\Carbon::parse($payroll->generated_at)->format('d M Y') }}</td>
<td class="px-table-cell-px py-table-cell-py font-mono-data text-on-surface">Rp {{ number_format($payroll->gaji_pokok, 0, ',', '.') }}</td>
<td class="px-table-cell-px py-table-cell-py font-mono-data text-on-surface">Rp {{ number_format($payroll->total_tunjangan, 0, ',', '.') }}</td>
<td class="px-table-cell-px py-table-cell-py font-mono-data text-status-error">Rp {{ number_format($payroll->total_potongan, 0, ',', '.') }}</td>
<td class="px-table-cell-px py-table-cell-py font-headline-md text-[16px] text-primary">Rp {{ number_format($payroll->gaji_bersih, 0, ',', '.') }}</td>
<td class="px-table-cell-px py-table-cell-py">
<span class="bg-tertiary-fixed text-status-success text-[12px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter">{{ $payroll->status }}</span>
</td>
<td class="px-table-cell-px py-table-cell-py text-right">
<a class="text-secondary font-label-md hover:underline flex items-center justify-end gap-1" href="{{ route('employee.detail-slip', $payroll->id) }}">
                                        Lihat Detail
                                        <span class="material-symbols-outlined text-[16px]">open_in_new</span>
</a>
</td>
</tr>
@empty
<tr>
<td colspan="8" class="px-table-cell-px py-table-cell-py text-center text-on-surface-variant">Belum ada slip gaji</td>
</tr>
@endforelse
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-table-cell-px py-4 flex items-center justify-between bg-surface-container-low/50">
<p class="font-body-sm text-on-surface-variant">Menampilkan 5 dari 12 periode</p>
<div class="flex items-center gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-border-muted hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white font-label-md text-label-md">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container transition-colors font-label-md text-label-md text-on-surface-variant">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container transition-colors font-label-md text-label-md text-on-surface-variant">3</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-border-muted hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Contextual Help / Banner -->
<div class="bg-primary p-gutter rounded-xl flex items-start gap-gutter text-on-primary shadow-lg overflow-hidden relative">
<div class="absolute inset-0 opacity-10 pointer-events-none">

</div>
<div class="w-12 h-12 rounded-xl bg-secondary flex items-center justify-center shrink-0 z-10">
<span class="material-symbols-outlined text-primary text-[28px]" style="font-variation-settings: 'FILL' 1;">verified_user</span>
</div>
<div class="space-y-1 z-10">
<h5 class="font-headline-md text-[18px] text-secondary-fixed">Keamanan Data &amp; Transparansi</h5>
<p class="font-body-md text-primary-fixed">Data slip gaji Anda dilindungi dengan enkripsi tingkat tinggi. Seluruh perhitungan didasarkan pada kebijakan perusahaan terbaru yang dapat Anda unduh di menu Panduan. Jika ada ketidaksesuaian rincian, silakan hubungi departemen HR melalui sistem tiket.</p>
</div>
</div>
</div>
<!-- Footer Info -->
<footer class="mt-auto py-8 px-container-margin border-t border-border-muted flex flex-col md:flex-row justify-between items-center gap-4 text-on-surface-variant">
<p class="font-body-sm text-body-sm">© 2024 SiGaji Enterprise. Semua hak dilindungi.</p>
<div class="flex items-center gap-8 font-label-md text-label-md">
<a class="hover:text-primary transition-colors" href="#">Syarat &amp; Ketentuan</a>
<a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
<a class="hover:text-primary transition-colors" href="#">Hubungi HR</a>
</div>
</footer>
</main>
<!-- Micro-interaction: FAB for quick help -->
<button class="fixed bottom-8 right-8 w-14 h-14 bg-secondary-fixed text-on-secondary-fixed rounded-full shadow-xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 group">
<span class="material-symbols-outlined text-[28px]">support_agent</span>
<span class="absolute right-16 bg-primary text-white px-3 py-1 rounded-lg text-sm font-label-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">Bantuan HR</span>
</button>


@endsection

@section('scripts')
<script>

        // Simple micro-interaction for rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mousedown', () => {
                row.classList.add('scale-[0.995]', 'transition-transform');
            });
            row.addEventListener('mouseup', () => {
                row.classList.remove('scale-[0.995]');
            });
        });
    
</script>
@endsection
