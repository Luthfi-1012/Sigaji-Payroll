@extends('layouts.app')

@section('title', 'Tambah Karyawan - SiGaji Admin')

@section('styles')
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
@endsection

@section('content')

@include('layouts.partials.admin-sidebar', ['active' => 'karyawan'])

<!-- Top App Bar -->
<header class="flex justify-between items-center ml-64 px-container-margin h-16 w-[calc(100%-16rem)] bg-surface-container-lowest sticky top-0 border-b border-border-muted z-20">
    <div class="flex items-center gap-4">
        <div class="relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input class="pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-full text-sm w-80 focus:ring-2 focus:ring-secondary/20" placeholder="Cari data karyawan..." type="text"/>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <button class="w-10 h-10 flex items-center justify-center text-on-surface-variant hover:text-primary transition-opacity">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <button class="w-10 h-10 flex items-center justify-center text-on-surface-variant hover:text-primary transition-opacity">
            <span class="material-symbols-outlined">help</span>
        </button>
        <div class="flex items-center gap-3 ml-4 pl-4 border-l border-border-muted">
            <div class="text-right">
                <p class="font-label-md text-label-md text-on-surface leading-none">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Administrator</p>
            </div>
            <div class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center">
                <span class="material-symbols-outlined text-on-secondary-container text-xl">person</span>
            </div>
        </div>
    </div>
</header>

<!-- Main Content (Daftar Karyawan Screen) -->
<main class="ml-64 p-container-margin min-h-[calc(100vh-4rem)] blur-[2px]">
    <div class="max-w-[1280px] mx-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-primary">Daftar Karyawan</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Kelola basis data karyawan aktif dan kontrak.</p>
            </div>
            <button class="bg-secondary text-white px-6 py-2.5 rounded-lg flex items-center gap-2 font-label-md hover:bg-secondary/90 transition-all shadow-sm">
                <span class="material-symbols-outlined">add</span> Tambah Karyawan
            </button>
        </div>

        <!-- Bento Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter mb-8">
            <div class="bg-surface-container-lowest p-stack-md border border-border-muted rounded-xl">
                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-widest mb-1">Total Karyawan</p>
                <p class="font-headline-md text-headline-md text-primary">1,248</p>
            </div>
            <div class="bg-surface-container-lowest p-stack-md border border-border-muted rounded-xl">
                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-widest mb-1">Karyawan Tetap</p>
                <p class="font-headline-md text-headline-md text-primary">892</p>
            </div>
            <div class="bg-surface-container-lowest p-stack-md border border-border-muted rounded-xl">
                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-widest mb-1">Karyawan Kontrak</p>
                <p class="font-headline-md text-headline-md text-primary">356</p>
            </div>
            <div class="bg-surface-container-lowest p-stack-md border border-border-muted rounded-xl">
                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-widest mb-1">Baru Bergabung</p>
                <p class="font-headline-md text-headline-md text-primary">4</p>
            </div>
        </div>

        <!-- Fake Data Table for background context -->
        <div class="bg-surface-container-lowest border border-border-muted rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-bg border-b border-border-muted">
                        <th class="px-table-cell-px py-table-cell-py font-label-md text-primary uppercase">NIP</th>
                        <th class="px-table-cell-px py-table-cell-py font-label-md text-primary uppercase">Nama Lengkap</th>
                        <th class="px-table-cell-px py-table-cell-py font-label-md text-primary uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-muted">
                    <tr class="hover:bg-tertiary-fixed/10">
                        <td class="px-table-cell-px py-table-cell-py">202401001</td>
                        <td class="px-table-cell-px py-table-cell-py">Ahmad Subarjo</td>
                        <td class="px-table-cell-px py-table-cell-py text-right">...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal Overlay -->
<div class="fixed inset-0 z-[50] flex items-center justify-center bg-primary/40 backdrop-blur-sm">
    <!-- Modal Content Container -->
    <div class="bg-surface-container-lowest w-full max-w-2xl rounded-2xl shadow-2xl flex flex-col max-h-[90vh]">
        
        <!-- Modal Header -->
        <div class="px-stack-lg py-5 border-b border-border-muted flex justify-between items-center bg-white rounded-t-2xl shrink-0">
            <div>
                <h3 class="font-headline-md text-headline-md text-primary">Tambah Karyawan Baru</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Lengkapi informasi dasar dan penggajian karyawan.</p>
            </div>
            <a href="{{ route('admin.karyawan') }}" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-bg text-outline transition-colors">
                <span class="material-symbols-outlined">close</span>
            </a>
        </div>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="bg-error-container text-on-error-container px-stack-lg py-3 shrink-0">
                <ul class="list-disc pl-5 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Modal Body (Form) -->
        <div class="px-stack-lg py-6 overflow-y-auto grow">
            <form action="{{ route('admin.karyawan.store') }}" method="POST" id="addEmployeeForm" class="space-y-6">
                @csrf
                
                <!-- Section: Identitas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="nip">NIP (Employee ID) *</label>
                        <input name="nip" id="nip" type="text" required value="{{ old('nip') }}" class="w-full px-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-body-sm" placeholder="Contoh: 202401010">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="nama">Nama Lengkap *</label>
                        <input name="nama" id="nama" type="text" required value="{{ old('nama') }}" class="w-full px-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-body-sm" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="jabatan">Jabatan *</label>
                        <select name="jabatan" id="jabatan" required class="w-full px-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-body-sm">
                            <option value="" disabled selected>Pilih Jabatan</option>
                            <option value="Manager" {{ old('jabatan') == 'Manager' ? 'selected' : '' }}>Manager</option>
                            <option value="Software Engineer" {{ old('jabatan') == 'Software Engineer' ? 'selected' : '' }}>Software Engineer</option>
                            <option value="HR Specialist" {{ old('jabatan') == 'HR Specialist' ? 'selected' : '' }}>HR Specialist</option>
                            <option value="Finance Officer" {{ old('jabatan') == 'Finance Officer' ? 'selected' : '' }}>Finance Officer</option>
                            <option value="Staff" {{ old('jabatan') == 'Staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="tanggal_masuk">Tanggal Masuk *</label>
                        <input name="tanggal_masuk" id="tanggal_masuk" type="date" required value="{{ old('tanggal_masuk', date('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-body-sm">
                    </div>
                </div>

                <!-- Section: Login Kredensial -->
                <div class="py-2 flex items-center gap-4">
                    <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest whitespace-nowrap">Kredensial Login Karyawan</span>
                    <div class="h-[1px] bg-border-muted w-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="email">Email Login *</label>
                        <input name="email" id="email" type="email" required value="{{ old('email') }}" class="w-full px-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-body-sm" placeholder="email@perusahaan.com">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="password">Password Default *</label>
                        <input name="password" id="password" type="password" required class="w-full px-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-body-sm" placeholder="Minimal 6 karakter">
                    </div>
                </div>

                <!-- Divider -->
                <div class="py-2 flex items-center gap-4">
                    <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest whitespace-nowrap">Detail Penggajian (Monthly)</span>
                    <div class="h-[1px] bg-border-muted w-full"></div>
                </div>

                <!-- Section: Finance -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="gaji_pokok">Gaji Pokok *</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold text-xs">Rp</span>
                            <input name="gaji_pokok" id="gaji_pokok" type="number" required value="{{ old('gaji_pokok', 0) }}" class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-mono-data">
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="potongan">Potongan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-status-error font-bold text-xs">Rp</span>
                            <input name="potongan" id="potongan" type="number" value="{{ old('potongan', 0) }}" class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-mono-data">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="tunjangan_1">Tunjangan 1 (Makan & Transport)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold text-xs">Rp</span>
                            <input name="tunjangan_1" id="tunjangan_1" type="number" value="{{ old('tunjangan_1', 0) }}" class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-mono-data">
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface-variant" for="tunjangan_2">Tunjangan 2 (Lain-lain)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold text-xs">Rp</span>
                            <input name="tunjangan_2" id="tunjangan_2" type="number" value="{{ old('tunjangan_2', 0) }}" class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-border-muted focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none font-mono-data">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="px-stack-lg py-5 border-t border-border-muted bg-surface-container-low flex justify-end items-center gap-3 rounded-b-2xl shrink-0">
            <a href="{{ route('admin.karyawan') }}" class="px-6 py-2.5 rounded-lg font-label-md text-on-surface-variant hover:bg-surface-dim transition-colors">
                Batal
            </a>
            <button type="submit" form="addEmployeeForm" class="bg-secondary text-white px-8 py-2.5 rounded-lg font-label-md hover:bg-on-secondary-fixed-variant shadow-lg shadow-secondary/20 flex items-center gap-2 active:scale-95 transition-transform">
                <span class="material-symbols-outlined text-lg">save</span> Simpan Karyawan
            </button>
        </div>
    </div>
</div>
@endsection
