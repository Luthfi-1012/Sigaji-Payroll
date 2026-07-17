@extends('layouts.app')

@section('title', 'sigaji_pengaturan_profil')

@section('styles')
<style>

        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .sidebar-active {
            box-shadow: inset 4px 0 0 0 #aaf859;
        }
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
    
</style>
@endsection

@section('content')

@include('layouts.partials.employee-sidebar', ['active' => 'profil'])
<!-- TopAppBar -->
<header class="flex justify-between items-center ml-64 px-container-margin h-16 w-[calc(100%-16rem)] bg-surface-container-lowest border-b border-border-muted fixed top-0 z-40">
<div class="flex items-center gap-stack-md">
<span class="font-headline-md text-headline-md font-bold text-primary">SiGaji Admin</span>
<div class="relative ml-stack-lg hidden md:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
<input class="pl-10 pr-4 py-1.5 bg-surface-container-low rounded-full border-none text-body-sm w-64 focus:ring-1 focus:ring-secondary-fixed" placeholder="Search settings..." type="text"/>
</div>
</div>
<div class="flex items-center gap-stack-md">
<button class="p-2 hover:bg-surface-container rounded-full text-on-surface-variant transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 hover:bg-surface-container rounded-full text-on-surface-variant transition-colors">
<span class="material-symbols-outlined">help</span>
</button>
<div class="h-8 w-[1px] bg-border-muted mx-2"></div>
<div class="flex items-center gap-3 pl-2">
<div class="text-right hidden sm:block">
<p class="font-label-md text-primary leading-none">{{ Auth::user()->name }}</p>
<p class="text-[11px] text-on-surface-variant">{{ $employee->jabatan ?? 'Karyawan' }}</p>
</div>
<img class="w-10 h-10 rounded-full border-2 border-secondary-container object-cover" data-alt="A professional headshot of a corporate male administrator in a crisp white shirt, clean-shaven with a confident smile, set against a blurred modern office background. High-key lighting emphasizing a light-mode UI aesthetic with professional clarity and deep green accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDNX62n05w3TQgk7AkoCJ5NZRjUEd_xtUadwC3QXHlezTuFWUgvMr7r8rEuOlTl5SBymekjhXwtLmRQ64L55HIJ7HbaSbt1PRsqQkfd59t_nfDFKf-4Z66_GJuoDac2FR8yJJ7m5qabCztc3V48y5dBj6O0-H8ssPfqCiiSLjsod-1eA7Bn_nEIbcGmvgS3BUkGSMayHl9lddrp9GxTDP7cka3Nuq2c24vgjd5wt4QJ_VDcvIgZdNTtQ0hfdrLynD7RZqhsWIoW79w"/>
</div>
</div>
</header>
<!-- Main Content -->
<main class="ml-64 mt-16 p-container-margin min-h-screen">
<div class="max-w-5xl mx-auto">
<div class="mb-stack-lg flex flex-col gap-2">
<h2 class="font-headline-lg text-headline-lg text-primary-container">Pengaturan Profil</h2>
<p class="font-body-md text-on-surface-variant">Kelola informasi pribadi, detail pekerjaan, dan keamanan akun Anda.</p>
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

@if($errors->any())
    <div class="bg-error-container text-on-error-container p-3 rounded-lg mb-6 text-sm">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('employee.profil.update') }}">
@csrf
<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
<!-- Left Column: Personal & Job -->
<div class="lg:col-span-2 flex flex-col gap-gutter">
<!-- Section 1: Personal Information -->
<section class="glass-card rounded-xl p-stack-lg shadow-sm">
<div class="flex items-center gap-stack-sm mb-stack-md">
<span class="material-symbols-outlined text-secondary">person</span>
<h3 class="font-headline-md text-headline-md text-primary-container">Informasi Pribadi</h3>
</div>
<div class="flex flex-col md:flex-row gap-stack-lg">
<div class="flex flex-col items-center gap-stack-sm">
<div class="relative group">
<div class="w-32 h-32 rounded-full overflow-hidden border-4 border-surface-container-high bg-surface-container-low">
<img class="w-full h-full object-cover" data-alt="A clean, minimalist profile picture of a young professional man in corporate attire, focused facial expression, high-quality photography, studio lighting, representing stability and growth in a modern payroll system context." id="profile-preview" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAb05jdNqYOiH5iDYO2Wpqs3ZmYtJh0qZZbKziO9PuWSccCshniqBQ_jNsQ7W_EcCIteH2BtVKFpQB8it6TZfaBDTUkt-nnntzozeaDe8z5ls8W64WFCBKvg5OzTqzKztcR_eMBKidBrasQ1bKXAzCrRvM5fpTOQ91l-N1D4yKawwP-yFsR_YHEDXLr__SwRIArfNAN0_0iaz46D7BhpfOGfrzTS3HIajwBok9VGkJbudaFrzNkaycFiwaAFPPxYmnJ15y7yewM2EA"/>
</div>
<button class="absolute bottom-0 right-0 p-2 bg-secondary text-on-secondary rounded-full border-4 border-surface-container-lowest hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-sm">photo_camera</span>
</button>
</div>
<p class="text-[12px] text-on-surface-variant font-medium">PNG or JPG, max 2MB</p>
</div>
<div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-stack-md">
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-md text-on-surface">Nama Lengkap</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm" type="text" name="nama" value="{{ $employee->nama ?? Auth::user()->name }}"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-on-surface-variant opacity-70">Nomor Induk Pegawai (NIP)</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted bg-surface-bg font-mono-data text-on-surface-variant cursor-not-allowed" readonly="" type="text" value="{{ $employee->nip ?? '-' }}"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-on-surface">Nomor Telepon</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm" type="tel" value="+62 812 3456 7890"/>
</div>
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-md text-on-surface">Alamat Email</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm bg-surface-bg text-on-surface-variant cursor-not-allowed" type="email" value="{{ Auth::user()->email }}" readonly/>
</div>
</div>
</div>
</section>
<!-- Section 2: Job Details -->
<section class="glass-card rounded-xl p-stack-lg shadow-sm border-l-4 border-l-secondary-container">
<div class="flex items-center gap-stack-sm mb-stack-md">
<span class="material-symbols-outlined text-secondary">work</span>
<h3 class="font-headline-md text-headline-md text-primary-container">Detail Pekerjaan</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-stack-lg">
<div class="p-4 bg-surface-bg rounded-lg">
<p class="font-label-md text-on-surface-variant text-[11px] uppercase tracking-wider mb-1">Jabatan</p>
<p class="font-headline-md text-headline-md text-primary">{{ $employee->jabatan ?? '-' }}</p>
</div>
<div class="p-4 bg-surface-bg rounded-lg">
<p class="font-label-md text-on-surface-variant text-[11px] uppercase tracking-wider mb-1">Gaji Pokok</p>
<p class="font-headline-md text-headline-md text-primary">Rp {{ number_format($employee->gaji_pokok ?? 0, 0, ',', '.') }}</p>
</div>
<div class="p-4 bg-surface-bg rounded-lg">
<p class="font-label-md text-on-surface-variant text-[11px] uppercase tracking-wider mb-1">Tanggal Bergabung</p>
<p class="font-headline-md text-headline-md text-primary">{{ $employee ? \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') : '-' }}</p>
</div>
</div>
</section>
<!-- Section 4: Bank Account -->
<section class="glass-card rounded-xl p-stack-lg shadow-sm">
<div class="flex items-center gap-stack-sm mb-stack-md">
<span class="material-symbols-outlined text-secondary">account_balance</span>
<h3 class="font-headline-md text-headline-md text-primary-container">Rekening Bank</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-on-surface">Nama Bank</label>
<select class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm focus:ring-2">
<option>Bank Mandiri</option>
<option>BCA</option>
<option>BNI</option>
<option>BRI</option>
</select>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-on-surface">Nomor Rekening</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-mono-data" type="text" value="1234567890123"/>
</div>
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-md text-on-surface">Nama Pemilik Rekening</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm" type="text" value="ANDI PRATAMA"/>
</div>
</div>
</section>
</div>
<!-- Right Column: Security -->
<div class="flex flex-col gap-gutter sticky top-24">
<section class="glass-card rounded-xl p-stack-lg shadow-sm">
<div class="flex items-center gap-stack-sm mb-stack-md">
<span class="material-symbols-outlined text-secondary">shield</span>
<h3 class="font-headline-md text-headline-md text-primary-container">Keamanan</h3>
</div>
<div class="flex flex-col gap-stack-md">
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-on-surface">Kata Sandi Saat Ini</label>
<div class="relative">
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm" name="current_password" placeholder="••••••••" type="password"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant toggle-pw" type="button" data-target="current_password">
<span class="material-symbols-outlined text-sm">visibility</span>
</button>
</div>
</div>
<hr class="border-border-muted my-2"/>
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-on-surface">Kata Sandi Baru</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm" name="new_password" id="new_password" type="password" placeholder="Minimal 8 karakter"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-on-surface">Konfirmasi Kata Sandi</label>
<input class="w-full px-4 py-2.5 rounded-lg border border-border-muted font-body-sm" name="new_password_confirmation" type="password" placeholder="Ulangi kata sandi baru"/>
</div>
<div class="p-3 bg-tertiary-fixed text-on-tertiary-fixed rounded-lg text-[11px] leading-relaxed">
<span class="font-bold flex items-center gap-1 mb-1">
<span class="material-symbols-outlined text-[14px]">info</span> Keamanan Kata Sandi
                                </span>
                                Minimal 8 karakter, termasuk kombinasi huruf besar, kecil, angka, dan simbol.
                            </div>
</div>
</section>
<!-- Helpful Tip -->
<div class="bg-primary-container text-on-primary-fixed p-6 rounded-xl relative overflow-hidden group">

<div class="relative z-10">
<h4 class="font-headline-md text-headline-md text-secondary-fixed mb-2">Butuh Bantuan?</h4>
<p class="text-body-sm opacity-80 mb-4">Jika ada kesalahan data pada detail pekerjaan yang bersifat read-only, silakan hubungi tim HR Strategic.</p>
<button class="flex items-center gap-2 text-secondary-fixed font-bold text-label-md hover:underline">
                                Hubungi HR Support <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
</div>
</div>
</div>
<!-- Footer Actions -->
<div class="mt-stack-lg py-6 border-t border-border-muted flex flex-col md:flex-row justify-between items-center gap-stack-md bg-surface-container-lowest/50 backdrop-blur rounded-b-xl px-6">
<div class="flex items-center gap-2 text-on-surface-variant">
<span class="material-symbols-outlined text-secondary">info</span>
<p class="text-body-sm">Kosongkan kolom kata sandi jika tidak ingin mengubahnya</p>
</div>
<div class="flex gap-stack-md w-full md:w-auto">
<a href="{{ route('employee.dashboard') }}" class="flex-1 md:flex-none px-8 py-3 rounded-full border border-border-muted text-primary font-bold hover:bg-surface-container transition-colors text-center">
                        Batalkan
                    </a>
<button type="submit" class="flex-1 md:flex-none px-12 py-3 rounded-full bg-secondary text-on-secondary font-bold hover:bg-secondary-container hover:text-on-secondary-container shadow-lg shadow-secondary/20 transition-all active:scale-95" id="save-btn">
                        Simpan Perubahan
                    </button>
</div>
</div>
</form>
</div>
</main>
<!-- Micro-interaction Toast -->
<div class="fixed bottom-8 right-8 bg-primary-container text-secondary-fixed px-6 py-4 rounded-xl shadow-2xl translate-y-24 opacity-0 transition-all duration-500 z-[100] flex items-center gap-3" id="toast">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">task_alt</span>
<div class="flex flex-col">
<p class="font-bold text-label-md">Berhasil Disimpan!</p>
<p class="text-[12px] opacity-80">Profil Anda telah diperbarui dalam sistem.</p>
</div>
</div>


@endsection

@section('scripts')
<script>
    // Toggle Password Visibility
    document.querySelectorAll('.toggle-pw').forEach(btn => {
        btn.addEventListener('click', () => {
            const inputName = btn.dataset.target;
            const input = document.querySelector(`[name="${inputName}"]`);
            if (input) {
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                btn.querySelector('span').textContent = isPassword ? 'visibility_off' : 'visibility';
            }
        });
    });

    // Add some subtle parallax or hover effect to cards
    document.querySelectorAll('.glass-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
</script>
@endsection

