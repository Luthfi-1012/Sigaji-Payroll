@extends('layouts.app')

@section('title', 'sigaji_admin_daftar_karyawan')

@section('styles')
<style>

        
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .active-nav { background-color: #294e41; border-right: 4px solid #aaf859; color: #aaf859; font-weight: 700; }
    
</style>
@endsection

@section('content')

@include('layouts.partials.admin-sidebar', ['active' => 'karyawan'])

<!-- Main Content Wrapper -->
<div class="ml-64 flex flex-col min-h-screen">
<!-- TopAppBar Shell -->
<header class="flex justify-between items-center px-container-margin h-16 w-full sticky top-0 bg-surface-container-lowest border-b border-border-muted z-40">
<div class="flex items-center bg-surface-container-low border border-border-muted rounded-full px-stack-md py-1.5 w-96">
<span class="material-symbols-outlined text-outline text-sm">search</span>
<input class="bg-transparent border-none focus:ring-0 text-body-sm font-body-sm w-full placeholder-on-surface-variant/50" placeholder="Cari fitur atau data..." type="text"/>
</div>
<div class="flex items-center gap-stack-md">
<button class="w-10 h-10 flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors rounded-full relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface-container-lowest"></span>
</button>
<button class="w-10 h-10 flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors rounded-full">
<span class="material-symbols-outlined">help</span>
</button>
<div class="h-8 w-[1px] bg-border-muted mx-base"></div>
<div class="flex items-center gap-stack-sm cursor-pointer hover:opacity-80 transition-opacity">
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
<!-- Success Flash Message -->
@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 animate-pulse" id="flashMsg">
    <span class="material-symbols-outlined text-green-600">check_circle</span>
    <span class="font-label-md">{{ session('success') }}</span>
    <button onclick="document.getElementById('flashMsg').remove()" class="ml-auto text-green-600 hover:text-green-800">
        <span class="material-symbols-outlined text-sm">close</span>
    </button>
</div>
@endif
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-stack-lg gap-stack-md">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">Manajemen Karyawan</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Kelola data personal, jabatan, dan struktur gaji seluruh karyawan.</p>
</div>
<a href="{{ route('admin.karyawan.tambah') }}" class="bg-secondary px-stack-md py-stack-sm rounded-lg flex items-center gap-stack-sm text-white font-label-md text-label-md hover:brightness-110 active:scale-95 transition-all shadow-sm">
<span class="material-symbols-outlined">add</span>
                    + Tambah Karyawan
                </a>
</div>
<!-- Dashboard Stats Overview (Bento Style) -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-stack-md mb-stack-lg">
<div class="bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
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
<div class="bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
<div class="flex justify-between items-start mb-stack-sm">
<div class="p-2 bg-secondary-container rounded-lg">
<span class="material-symbols-outlined text-on-secondary-container">work</span>
</div>
<span class="text-on-surface-variant font-label-md text-[12px]">Posisi</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Jabatan Aktif</p>
<p class="font-display-lg text-headline-lg text-primary mt-1">{{ $jabatanAktif }}</p>
</div>
<div class="bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
<div class="flex justify-between items-start mb-stack-sm">
<div class="p-2 bg-tertiary-fixed rounded-lg">
<span class="material-symbols-outlined text-on-tertiary-fixed">event_available</span>
</div>
<span class="text-on-surface-variant font-label-md text-[12px]">Bulan ini</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Karyawan Baru</p>
<p class="font-display-lg text-headline-lg text-primary mt-1">{{ $karyawanBaru }}</p>
</div>
<div class="bg-surface-container-lowest p-stack-md rounded-xl border border-border-muted">
<div class="flex justify-between items-start mb-stack-sm">
<div class="p-2 bg-primary/10 rounded-lg">
<span class="material-symbols-outlined text-primary">paid</span>
</div>
<span class="text-on-surface-variant font-label-md text-[12px]">Total</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Total Gaji Pokok</p>
<p class="font-display-lg text-headline-lg text-primary mt-1">Rp {{ number_format($employees->sum('gaji_pokok'), 0, ',', '.') }}</p>
</div>
</div>
<!-- Filters & Search Bar -->
<div class="bg-surface-container-lowest border border-border-muted rounded-t-xl p-stack-md flex flex-col md:flex-row gap-stack-md items-center justify-between">
<div class="flex flex-col md:flex-row gap-stack-md w-full md:w-auto">
<!-- Search -->
<div class="relative w-full md:w-80">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface border border-border-muted rounded-lg focus:border-secondary focus:ring-1 focus:ring-secondary/20 text-body-sm transition-all outline-none" placeholder="Cari nama atau NIP..." type="text"/>
</div>
<!-- Dropdown Jabatan -->
<div class="relative w-full md:w-48">
<select class="w-full appearance-none pl-3 pr-10 py-2 bg-surface border border-border-muted rounded-lg focus:border-secondary focus:ring-1 focus:ring-secondary/20 text-body-sm transition-all outline-none">
<option value="">Semua Jabatan</option>
<option value="manager">Manager</option>
<option value="developer">Lead Developer</option>
<option value="hr">HR Specialist</option>
<option value="finance">Finance Officer</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
</div>
</div>
<div class="flex items-center gap-stack-sm">
<button class="p-2 border border-border-muted rounded-lg hover:bg-surface transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">filter_list</span>
</button>
<button class="p-2 border border-border-muted rounded-lg hover:bg-surface transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">download</span>
</button>
</div>
</div>
<!-- Data Table Container -->
<div class="bg-surface-container-lowest border border-border-muted border-t-0 rounded-b-xl overflow-hidden shadow-sm">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-bg border-b border-border-muted">
<th class="px-table-cell-px py-stack-md font-label-md text-label-md text-primary uppercase">NIP</th>
<th class="px-table-cell-px py-stack-md font-label-md text-label-md text-primary uppercase">Nama</th>
<th class="px-table-cell-px py-stack-md font-label-md text-label-md text-primary uppercase">Jabatan</th>
<th class="px-table-cell-px py-stack-md font-label-md text-label-md text-primary uppercase text-center">Tanggal Masuk</th>
<th class="px-table-cell-px py-stack-md font-label-md text-label-md text-primary uppercase text-right">Gaji Pokok</th>
<th class="px-table-cell-px py-stack-md font-label-md text-label-md text-primary uppercase text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-border-muted">
@forelse($employees as $employee)
<tr class="hover:bg-tertiary-fixed/30 transition-colors group">
<td class="px-table-cell-px py-table-cell-py font-mono-data text-body-sm text-on-surface-variant">{{ $employee->nip }}</td>
<td class="px-table-cell-px py-table-cell-py">
<div class="flex items-center gap-stack-sm">
<div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant font-bold text-xs">{{ substr($employee->nama, 0, 2) }}</div>
<div>
<p class="font-label-md text-label-md text-on-surface">{{ $employee->nama }}</p>
<p class="text-[11px] text-on-surface-variant">{{ $employee->user->email }}</p>
</div>
</div>
</td>
<td class="px-table-cell-px py-table-cell-py">
<span class="px-2 py-0.5 bg-blue-50 text-blue-600 rounded text-[11px] font-bold uppercase tracking-tighter">{{ $employee->jabatan }}</span>
</td>
<td class="px-table-cell-px py-table-cell-py text-center font-body-sm text-on-surface-variant">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') }}</td>
<td class="px-table-cell-px py-table-cell-py text-right font-mono-data text-body-sm text-on-surface">Rp {{ number_format($employee->gaji_pokok, 0, ',', '.') }}</td>
<td class="px-table-cell-px py-table-cell-py text-right">
<div class="flex items-center justify-end gap-base opacity-0 group-hover:opacity-100 transition-opacity">
<button onclick="toggleDetail({{ $employee->id }})" class="p-1.5 hover:bg-surface-container rounded-lg text-primary transition-colors" title="Lihat Detail"><span class="material-symbols-outlined text-[20px]">visibility</span></button>
<button onclick="toggleEdit({{ $employee->id }})" class="p-1.5 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors" title="Edit"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button onclick="toggleResetPassword({{ $employee->id }})" class="p-1.5 hover:bg-surface-container rounded-lg text-status-warning transition-colors" title="Reset Password"><span class="material-symbols-outlined text-[20px]">key</span></button>
<form action="{{ route('admin.karyawan.destroy', $employee->id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Yakin ingin menghapus karyawan {{ $employee->nama }}?')" class="p-1.5 hover:bg-error-container/50 rounded-lg text-error transition-colors" title="Hapus"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</form>
</div>
</td>
</tr>
<!-- Detail Row (hidden by default) -->
<tr id="detail-{{ $employee->id }}" class="hidden bg-primary-fixed/10">
<td colspan="6" class="px-table-cell-px py-4">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
        <div><span class="text-on-surface-variant">Email:</span><br><strong>{{ $employee->user->email }}</strong></div>
        <div><span class="text-on-surface-variant">Tunjangan 1:</span><br><strong>Rp {{ number_format($employee->tunjangan_1, 0, ',', '.') }}</strong></div>
        <div><span class="text-on-surface-variant">Tunjangan 2:</span><br><strong>Rp {{ number_format($employee->tunjangan_2, 0, ',', '.') }}</strong></div>
        <div><span class="text-on-surface-variant">Potongan:</span><br><strong class="text-error">Rp {{ number_format($employee->potongan, 0, ',', '.') }}</strong></div>
    </div>
</td>
</tr>
<!-- Edit Row (hidden by default) -->
<tr id="edit-{{ $employee->id }}" class="hidden bg-secondary/5">
<td colspan="6" class="px-table-cell-px py-4">
    <form action="{{ route('admin.karyawan.update', $employee->id) }}" method="POST" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 text-sm">
        @csrf
        @method('PUT')
        <div class="col-span-2 md:col-span-1"><label class="text-on-surface-variant">Nama</label><input name="nama" value="{{ $employee->nama }}" class="w-full mt-1 px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none"></div>
        <div class="col-span-2 md:col-span-1"><label class="text-on-surface-variant">Jabatan</label><input name="jabatan" value="{{ $employee->jabatan }}" class="w-full mt-1 px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none"></div>
        <div class="col-span-2 md:col-span-1"><label class="text-on-surface-variant">Gaji Pokok</label><input name="gaji_pokok" type="number" value="{{ $employee->gaji_pokok }}" class="w-full mt-1 px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none"></div>
        <div class="col-span-2 md:col-span-1"><label class="text-on-surface-variant">Tunjangan 1</label><input name="tunjangan_1" type="number" value="{{ $employee->tunjangan_1 }}" class="w-full mt-1 px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none"></div>
        <div class="col-span-2 md:col-span-1"><label class="text-on-surface-variant">Tunjangan 2</label><input name="tunjangan_2" type="number" value="{{ $employee->tunjangan_2 }}" class="w-full mt-1 px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none"></div>
        <div class="col-span-2 md:col-span-1"><label class="text-on-surface-variant">Potongan</label><input name="potongan" type="number" value="{{ $employee->potongan }}" class="w-full mt-1 px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none"></div>
        <div class="col-span-2 md:col-span-1 flex items-end"><button type="submit" class="w-full bg-secondary text-white px-4 py-1.5 rounded-lg font-label-md hover:brightness-110 active:scale-95 transition-all text-sm h-[34px]">Simpan</button></div>
    </form>
</td>
</tr>
<!-- Reset Password Row (hidden by default) -->
<tr id="reset-{{ $employee->id }}" class="hidden bg-status-warning/5">
<td colspan="6" class="px-table-cell-px py-4">
    <form action="{{ route('admin.reset-password', $employee->user_id) }}" method="POST" onsubmit="return confirm('Yakin ingin mereset password akun ini?')" class="flex items-end gap-4">
        @csrf
        <div class="flex-1 max-w-xs">
            <label class="text-on-surface-variant text-sm block mb-1">Kata Sandi Baru</label>
            <input type="password" name="new_password" required minlength="8" class="w-full px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-status-warning/20 focus:border-status-warning outline-none" placeholder="Minimal 8 karakter">
        </div>
        <button type="submit" class="bg-status-warning text-white px-4 py-1.5 rounded-lg font-label-md hover:brightness-110 active:scale-95 transition-all text-sm h-[34px]">
            Reset Password
        </button>
    </form>
</td>
</tr>
@empty
<tr>
<td colspan="6" class="px-table-cell-px py-table-cell-py text-center text-on-surface-variant">Belum ada data karyawan</td>
</tr>
@endforelse
</tbody>
</table>
<!-- Pagination -->
<div class="px-table-cell-px py-stack-md bg-surface-bg flex flex-col md:flex-row items-center justify-between border-t border-border-muted gap-stack-sm">
<p class="font-body-sm text-body-sm text-on-surface-variant">Menampilkan {{ $employees->firstItem() ?? 0 }}-{{ $employees->lastItem() ?? 0 }} dari <span class="font-bold text-on-surface">{{ $employees->total() }}</span> karyawan</p>
<div class="flex items-center gap-base">
{{ $employees->links('vendor.pagination.tailwind') }}
</div>
</div>
</div>
</main>
<!-- Minimalist Footer -->
<footer class="mt-auto px-container-margin py-stack-md border-t border-border-muted flex justify-between items-center bg-white/50 backdrop-blur-sm">
<p class="text-[12px] text-on-surface-variant">© 2024 SiGaji Enterprise. All Rights Reserved.</p>
<div class="flex gap-stack-md">
<a class="text-[12px] text-on-surface-variant hover:text-secondary transition-colors" href="#">Privacy Policy</a>
<a class="text-[12px] text-on-surface-variant hover:text-secondary transition-colors" href="#">Terms of Service</a>
<a class="text-[12px] text-on-surface-variant hover:text-secondary transition-colors" href="#">Support</a>
</div>
</footer>
</div>
<!-- Micro-interaction Scripts -->


@endsection

@section('scripts')
<script>
    function toggleDetail(id) {
        const detailRow = document.getElementById('detail-' + id);
        const editRow = document.getElementById('edit-' + id);
        const resetRow = document.getElementById('reset-' + id);
        if (editRow) editRow.classList.add('hidden');
        if (resetRow) resetRow.classList.add('hidden');
        if (detailRow) detailRow.classList.toggle('hidden');
    }

    function toggleEdit(id) {
        const editRow = document.getElementById('edit-' + id);
        const detailRow = document.getElementById('detail-' + id);
        const resetRow = document.getElementById('reset-' + id);
        if (detailRow) detailRow.classList.add('hidden');
        if (resetRow) resetRow.classList.add('hidden');
        if (editRow) editRow.classList.toggle('hidden');
    }

    function toggleResetPassword(id) {
        const resetRow = document.getElementById('reset-' + id);
        const editRow = document.getElementById('edit-' + id);
        const detailRow = document.getElementById('detail-' + id);
        if (detailRow) detailRow.classList.add('hidden');
        if (editRow) editRow.classList.add('hidden');
        if (resetRow) resetRow.classList.toggle('hidden');
    }

    // Auto-dismiss flash message after 5 seconds
    setTimeout(() => {
        const flash = document.getElementById('flashMsg');
        if (flash) flash.remove();
    }, 5000);
</script>
@endsection
