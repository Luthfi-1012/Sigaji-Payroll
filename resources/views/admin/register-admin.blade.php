@extends('layouts.app')

@section('title', 'Register Admin - SiGaji')

@section('styles')
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .active-nav { background-color: #294e41; border-right: 4px solid #aaf859; color: #aaf859; font-weight: 700; }
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        border: 1px solid #E2E8F0;
    }
    input:focus {
        outline: none !important;
        border-color: #aaf859 !important;
        box-shadow: 0 0 0 2px rgba(170, 248, 89, 0.2) !important;
    }
    .toast-enter { transform: translateY(0); opacity: 1; }
</style>
@endsection

@section('content')
@include('layouts.partials.admin-sidebar', ['active' => 'kelola-admin'])

<!-- Main Content Wrapper -->
<div class="ml-64 flex flex-col min-h-screen">
    <!-- TopAppBar -->
    <header class="flex justify-between items-center px-container-margin h-16 w-full sticky top-0 bg-surface-container-lowest border-b border-border-muted z-40">
        <div class="flex items-center gap-stack-md">
            <span class="font-headline-md text-headline-md font-bold text-primary">Kelola Admin</span>
        </div>
        <div class="flex items-center gap-stack-md">
            <button class="w-10 h-10 flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors rounded-full relative">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <div class="h-8 w-[1px] bg-border-muted mx-base"></div>
            <div class="flex items-center gap-3 pl-2">
                <div class="text-right hidden sm:block">
                    <p class="font-label-md text-primary leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-on-surface-variant">Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-container-margin flex-1">
        <div class="max-w-6xl mx-auto">
            <!-- Page Header -->
            <div class="mb-stack-lg flex flex-col gap-2">
                <h2 class="font-headline-lg text-headline-lg text-primary-container">Registrasi Admin Baru</h2>
                <p class="font-body-md text-on-surface-variant">Tambahkan akun admin baru untuk mengelola sistem payroll perusahaan.</p>
            </div>

            @if(session('success'))
                <div class="bg-secondary/10 text-secondary border border-secondary/20 p-4 rounded-lg flex items-start gap-3 mb-6">
                    <span class="material-symbols-outlined text-[20px] mt-0.5">check_circle</span>
                    <div>
                        <p class="font-label-md text-label-md">Berhasil!</p>
                        <p class="text-sm opacity-80 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-gutter">
                <!-- Register Form (Left) -->
                <div class="lg:col-span-2">
                    <section class="glass-card rounded-xl p-stack-lg shadow-sm">
                        <div class="flex items-center gap-stack-sm mb-stack-md">
                            <div class="w-10 h-10 rounded-lg bg-secondary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-secondary">person_add</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md text-primary-container">Tambah Admin</h3>
                        </div>

                        @if($errors->any())
                            <div class="bg-error-container text-on-error-container p-3 rounded-lg mb-4 text-sm">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.register.store') }}" class="space-y-stack-md">
                            @csrf

                            <div class="space-y-base">
                                <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="name">
                                    <span class="material-symbols-outlined text-[18px]">person</span>
                                    Nama Lengkap
                                </label>
                                <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant transition-all" id="name" name="name" value="{{ old('name') }}" placeholder="Nama admin baru" required type="text"/>
                            </div>

                            <div class="space-y-base">
                                <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="email">
                                    <span class="material-symbols-outlined text-[18px]">mail</span>
                                    Alamat Email
                                </label>
                                <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant transition-all" id="email" name="email" value="{{ old('email') }}" placeholder="admin@perusahaan.com" required type="email"/>
                            </div>

                            <div class="space-y-base">
                                <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="password">
                                    <span class="material-symbols-outlined text-[18px]">lock</span>
                                    Kata Sandi
                                </label>
                                <div class="relative">
                                    <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant transition-all" id="password" name="password" placeholder="Minimal 8 karakter" required type="password"/>
                                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors toggle-password" type="button" data-target="password">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-base">
                                <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="password_confirmation">
                                    <span class="material-symbols-outlined text-[18px]">verified</span>
                                    Konfirmasi Kata Sandi
                                </label>
                                <div class="relative">
                                    <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant transition-all" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required type="password"/>
                                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors toggle-password" type="button" data-target="password_confirmation">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </div>
                            </div>

                            <button class="w-full py-3 bg-primary text-white font-label-md text-label-md rounded-lg hover:bg-on-primary-fixed-variant active:scale-[0.98] transition-all flex items-center justify-center space-x-2 shadow-lg shadow-primary/10" type="submit">
                                <span class="material-symbols-outlined text-[18px]">person_add</span>
                                <span>Daftarkan Admin Baru</span>
                            </button>
                        </form>
                    </section>
                </div>

                <!-- Existing Admins List (Right) -->
                <div class="lg:col-span-3">
                    <section class="glass-card rounded-xl p-stack-lg shadow-sm">
                        <div class="flex items-center justify-between mb-stack-md">
                            <div class="flex items-center gap-stack-sm">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary">admin_panel_settings</span>
                                </div>
                                <div>
                                    <h3 class="font-headline-md text-headline-md text-primary-container">Daftar Admin</h3>
                                    <p class="text-xs text-on-surface-variant">{{ $admins->count() }} admin terdaftar</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            @forelse($admins as $admin)
                                <div class="flex items-center justify-between p-4 bg-surface-bg rounded-xl border border-border-muted hover:border-secondary/30 transition-all group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-white font-bold text-lg shadow-md">
                                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-label-md text-label-md text-on-surface font-semibold">{{ $admin->name }}</p>
                                            <p class="text-xs text-on-surface-variant">{{ $admin->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-secondary/10 text-secondary text-xs font-semibold">
                                            <span class="material-symbols-outlined text-[14px]">verified_user</span>
                                            Admin
                                        </span>
                                        @if($admin->id !== Auth::id())
                                            <button onclick="document.getElementById('reset-admin-{{$admin->id}}').classList.toggle('hidden')" class="p-1.5 hover:bg-surface-bg rounded-lg text-yellow-600 transition-colors opacity-0 group-hover:opacity-100" title="Reset Password"><span class="material-symbols-outlined text-[18px]">key</span></button>
                                            <span class="text-xs text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">
                                                Terdaftar {{ $admin->created_at->diffForHumans() }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-primary/10 text-primary text-xs">
                                                Anda
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($admin->id !== Auth::id())
                                <div id="reset-admin-{{$admin->id}}" class="hidden p-4 bg-yellow-50 rounded-b-xl border border-t-0 border-yellow-200 mb-3 -mt-3">
                                    <form action="{{ route('admin.reset-password', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin mereset kata sandi admin ini?')" class="flex items-end gap-4">
                                        @csrf
                                        <div class="flex-1 max-w-xs">
                                            <label class="text-on-surface-variant text-xs block mb-1">Kata Sandi Baru</label>
                                            <input type="password" name="new_password" required minlength="8" class="w-full px-3 py-1.5 rounded-lg border border-border-muted text-sm focus:ring-2 focus:ring-yellow-400/20 focus:border-yellow-400 outline-none" placeholder="Minimal 8 karakter">
                                        </div>
                                        <button type="submit" class="bg-yellow-500 text-white px-4 py-1.5 rounded-lg font-label-md hover:brightness-110 active:scale-95 transition-all text-sm h-[34px]">
                                            Reset Password
                                        </button>
                                    </form>
                                </div>
                                @endif
                            @empty
                                <div class="text-center py-8 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">person_off</span>
                                    <p class="mt-2 font-label-md">Belum ada admin terdaftar</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <!-- Security Notice -->
                    <div class="mt-gutter bg-primary-container text-on-primary-fixed p-6 rounded-xl relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-secondary-fixed">shield</span>
                                <h4 class="font-headline-md text-headline-md text-secondary-fixed">Catatan Keamanan</h4>
                            </div>
                            <p class="text-body-sm opacity-80">Akun admin memiliki akses penuh ke seluruh data payroll. Pastikan hanya mendaftarkan personil yang berwenang dan gunakan kata sandi yang kuat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    // Toggle Password Visibility
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.target);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.querySelector('span').textContent = isPassword ? 'visibility_off' : 'visibility';
        });
    });
</script>
@endsection
