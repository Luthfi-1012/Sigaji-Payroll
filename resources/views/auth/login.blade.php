@extends('layouts.app')

@section('title', 'Login - SiGaji Admin')

@section('content')
<!-- Layout Container: Split Screen on MD+ -->
<main class="w-full min-h-screen flex flex-col md:flex-row">
<!-- Left Side: Visual/Brand Messaging -->
<section class="hidden md:flex md:w-1/2 lg:w-3/5 bg-primary relative overflow-hidden items-center justify-center p-stack-lg">
<!-- Animated Background Background (Simulated via Gradient & Overlay) -->
<div class="absolute inset-0 z-0 opacity-40 mix-blend-overlay" data-alt="A professional and sleek corporate office interior at dusk with floor-to-ceiling glass windows overlooking a modern city skyline. The lighting is low and sophisticated, featuring deep forest green shadows and soft lime-green highlights reflecting off polished marble floors. In the foreground, a high-end executive desk sits neatly organized, embodying a sense of financial stability and high-tech efficiency. The overall mood is calm, trustworthy, and authoritative." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBCZe820rv2MFicztvHE3O9FUDbyOt5QzjOKe4QUpFR9KeqaGpKfSIZ5idl_t5CAIBUOdJXplrHHOT3Cmqcz3bFuyNyyojiTm3abIr2Vp4zDXIh--EtDRSPtsIcjGzx8X0ZFk4Bh0fkuBmCVRNOpN_mhaCi2wofSdG1z1yJIZ5cvFSk4Jxpvnq7HgA7bSy4tCQw01iQGmFXIFHY5XyB3vEoOMNax0QmIgqLy_2LJkBQJMxw963XwFsPvjp5fiJ5oUzucGwvbHxfh0o')">
</div>
<div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/80 to-secondary/20 z-10"></div>
<div class="relative z-20 max-w-lg text-center md:text-left space-y-6">
<div class="inline-flex items-center space-x-3 bg-on-primary-fixed-variant/30 px-4 py-2 rounded-full border border-white/10 backdrop-blur-sm">
<span class="material-symbols-outlined text-secondary-fixed">security</span>
<span class="font-label-md text-label-md text-secondary-fixed tracking-widest uppercase">Akses Terenkripsi</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-white leading-tight">
                    Efisiensi Penggajian dalam <br/><span class="text-secondary-fixed">Satu Platform Terpadu.</span>
</h1>
<p class="font-body-lg text-body-lg text-white/80 leading-relaxed">
                    Kelola data karyawan, perhitungan pajak, dan distribusi gaji dengan akurasi maksimal dan transparansi penuh.
                </p>
<div class="pt-stack-lg grid grid-cols-2 gap-stack-md">
<div class="bg-white/5 border border-white/10 p-stack-md rounded-xl backdrop-blur-md">
<p class="font-headline-md text-headline-md text-white">99.9%</p>
<p class="font-label-md text-label-md text-white/60">Akurasi Perhitungan</p>
</div>
<div class="bg-white/5 border border-white/10 p-stack-md rounded-xl backdrop-blur-md">
<p class="font-headline-md text-headline-md text-white">24/7</p>
<p class="font-label-md text-label-md text-white/60">Dukungan Sistem</p>
</div>
</div>
</div>
</section>
<!-- Right Side: Login Form Content -->
<section class="w-full md:w-1/2 lg:w-2/5 bg-surface-bg flex flex-col justify-between p-stack-lg min-h-screen">
<!-- Logo Header -->
<div class="flex justify-center md:justify-start">
<div class="flex items-center space-x-3">
<img alt="SiGaji Logo" class="h-12 w-12 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlnhf7MlquTlST3STI9UBWShPHkFBgSsP3IzDUl2GQ-0xFhflw_ekKCt03zJ3fcgcuZ1F6Y9TKDkwUbdICk6K-Rp-KMD5STuJJ1Ni81g75kireR3mqk8CD8CvastUyOwWmMQSBvlmiiZL-2m_ozHigR2oxQyRKTVk5BK43IZNKsxmlNdaTOIi37JmrF8bUECAbZOGDk9aWgA61-s-FFK-nHoKesGHAFR-JlH_rFFDNWwex7Q5of33Xk4Kq9fqpGy5cTfQnKaYJQ04"/>
<span class="font-headline-md text-headline-md font-extrabold tracking-tight text-primary">SiGaji<span class="text-secondary">Admin</span></span>
</div>
</div>
<!-- Login Form -->
<div class="max-w-md w-full mx-auto space-y-stack-lg">
<header class="space-y-stack-sm text-center md:text-left">
<h2 class="font-headline-lg text-headline-lg text-on-surface">Selamat Datang</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Silakan masuk untuk mengelola sistem payroll perusahaan.</p>
</header>
<form class="space-y-stack-md" method="POST" action="{{ route('login') }}">
@csrf
@if($errors->any())
    <div class="bg-error-container text-on-error-container p-3 rounded-lg mb-4 text-sm">
        {{ $errors->first() }}
    </div>
@endif
<div class="space-y-base">
<label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="email">
<span class="material-symbols-outlined text-[18px]">mail</span>
                            Alamat Email
                        </label>
<input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition-all outline-none" id="email" name="email" value="{{ old('email') }}" placeholder="admin@perusahaan.com" required="" type="email"/>
</div>
<div class="space-y-base">
<div class="flex justify-between items-center">
<label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="password">
<span class="material-symbols-outlined text-[18px]">lock</span>
                                Kata Sandi
                            </label>
<a class="font-label-md text-label-md text-secondary hover:text-secondary-fixed-dim transition-colors" href="{{ route('password.forgot') }}">Lupa Password?</a>
</div>
<div class="relative">
<input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition-all outline-none" id="password" name="password" placeholder="••••••••" required="" type="password"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined">visibility</span>
</button>
</div>
</div>
<div class="flex items-center space-x-2 pt-2">
<input class="w-4 h-4 rounded border-border-muted text-secondary focus:ring-secondary" id="remember" name="remember" type="checkbox"/>
<label class="font-body-sm text-body-sm text-on-surface-variant" for="remember">Ingat saya di perangkat ini</label>
</div>
<button class="w-full py-4 bg-primary text-white font-label-md text-label-md rounded-lg hover:bg-on-primary-fixed-variant active:scale-[0.98] transition-all flex items-center justify-center space-x-2 shadow-lg shadow-primary/10" type="submit">
<span>Masuk ke Dashboard</span>
<span class="material-symbols-outlined text-[20px]">login</span>
</button>
</form>
<div class="relative py-stack-md">
<div class="absolute inset-0 flex items-center">
<div class="w-full border-t border-border-muted"></div>
</div>
<div class="relative flex justify-center text-label-md">
<span class="px-4 bg-surface-bg text-on-surface-variant font-label-md">Atau Masuk Dengan</span>
</div>
</div>
<button class="w-full py-3 bg-white border border-border-muted text-on-surface-variant font-label-md text-label-md rounded-lg hover:bg-surface-container-low transition-colors flex items-center justify-center space-x-3">
<svg class="h-5 w-5" viewbox="0 0 24 24">
<path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
<path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
<path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
<path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"></path>
</svg>
<span>SSO Perusahaan</span>
</button>
</div>
<!-- Footer -->
<footer class="pt-stack-lg border-t border-border-muted flex flex-col md:flex-row justify-between items-center text-on-surface-variant font-body-sm text-body-sm">
<p>© 2024 SiGaji Payroll System. Semua hak dilindungi.</p>
<div class="flex space-x-gutter mt-2 md:mt-0">
<a class="hover:text-primary transition-colors" href="#">Syarat & Ketentuan</a>
<a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
</div>
</footer>
</section>
</main>
@endsection

@section('scripts')
<script>
    // Toggle Password Visibility
    const toggleBtn = document.querySelector('button[type="button"]');
    const passwordInput = document.getElementById('password');
    toggleBtn.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        toggleBtn.querySelector('span').textContent = isPassword ? 'visibility_off' : 'visibility';
    });
</script>
@endsection
