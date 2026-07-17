@extends('layouts.app')

@section('title', 'Lupa Password - SiGaji')

@section('styles')
<style>
    .login-bg {
        background: linear-gradient(135deg, #0f2419 0%, #1a3a2a 40%, #0d1f15 100%);
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .pulse-glow {
        animation: pulseGlow 3s ease-in-out infinite;
    }
    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 20px rgba(170, 248, 89, 0.1); }
        50% { box-shadow: 0 0 40px rgba(170, 248, 89, 0.2); }
    }
</style>
@endsection

@section('content')
<main class="w-full min-h-screen flex flex-col md:flex-row">
    <!-- Left Side: Visual/Brand Messaging -->
    <section class="hidden md:flex md:w-1/2 lg:w-3/5 bg-primary relative overflow-hidden items-center justify-center p-stack-lg">
        <div class="absolute inset-0 z-0 opacity-40 mix-blend-overlay" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBCZe820rv2MFicztvHE3O9FUDbyOt5QzjOKe4QUpFR9KeqaGpKfSIZ5idl_t5CAIBUOdJXplrHHOT3Cmqcz3bFuyNyyojiTm3abIr2Vp4zDXIh--EtDRSPtsIcjGzx8X0ZFk4Bh0fkuBmCVRNOpN_mhaCi2wofSdG1z1yJIZ5cvFSk4Jxpvnq7HgA7bSy4tCQw01iQGmFXIFHY5XyB3vEoOMNax0QmIgqLy_2LJkBQJMxw963XwFsPvjp5fiJ5oUzucGwvbHxfh0o')">
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/80 to-secondary/20 z-10"></div>
        <div class="relative z-20 max-w-lg text-center md:text-left space-y-6">
            <div class="inline-flex items-center space-x-3 bg-on-primary-fixed-variant/30 px-4 py-2 rounded-full border border-white/10 backdrop-blur-sm">
                <span class="material-symbols-outlined text-secondary-fixed">lock_reset</span>
                <span class="font-label-md text-label-md text-secondary-fixed tracking-widest uppercase">Reset Akses</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg text-white leading-tight">
                Pulihkan Akses <br/><span class="text-secondary-fixed">Akun Anda.</span>
            </h1>
            <p class="font-body-lg text-body-lg text-white/80 leading-relaxed">
                Masukkan email terdaftar Anda. Admin akan dihubungi untuk melakukan reset kata sandi akun Anda.
            </p>
            <div class="pt-stack-lg">
                <div class="glass-card p-stack-md rounded-xl pulse-glow">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed">support_agent</span>
                        <div>
                            <p class="font-label-md text-label-md text-white">Bantuan HR Support</p>
                            <p class="font-body-sm text-body-sm text-white/60">Tim HR akan memproses permintaan Anda dalam 1x24 jam kerja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Right Side: Forgot Password Form -->
    <section class="w-full md:w-1/2 lg:w-2/5 bg-surface-bg flex flex-col justify-between p-stack-lg min-h-screen">
        <!-- Logo Header -->
        <div class="flex justify-center md:justify-start">
            <div class="flex items-center space-x-3">
                <img alt="SiGaji Logo" class="h-12 w-12 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlnhf7MlquTlST3STI9UBWShPHkFBgSsP3IzDUl2GQ-0xFhflw_ekKCt03zJ3fcgcuZ1F6Y9TKDkwUbdICk6K-Rp-KMD5STuJJ1Ni81g75kireR3mqk8CD8CvastUyOwWmMQSBvlmiiZL-2m_ozHigR2oxQyRKTVk5BK43IZNKsxmlNdaTOIi37JmrF8bUECAbZOGDk9aWgA61-s-FFK-nHoKesGHAFR-JlH_rFFDNWwex7Q5of33Xk4Kq9fqpGy5cTfQnKaYJQ04"/>
                <span class="font-headline-md text-headline-md font-extrabold tracking-tight text-primary">SiGaji<span class="text-secondary">Admin</span></span>
            </div>
        </div>

        <!-- Forgot Password Form -->
        <div class="max-w-md w-full mx-auto space-y-stack-lg">
            <header class="space-y-stack-sm text-center md:text-left">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-secondary/10 mb-4">
                    <span class="material-symbols-outlined text-secondary text-[32px]">lock_reset</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Lupa Kata Sandi?</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Masukkan alamat email yang terdaftar. Admin akan menghubungi Anda untuk proses reset kata sandi.</p>
            </header>

            @if(session('success'))
                <div class="bg-secondary/10 text-secondary border border-secondary/20 p-4 rounded-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-[20px] mt-0.5">check_circle</span>
                    <div>
                        <p class="font-label-md text-label-md">Permintaan Terkirim</p>
                        <p class="text-sm opacity-80 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form class="space-y-stack-md" method="POST" action="{{ route('password.forgot.send') }}">
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
                    <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition-all outline-none" id="email" name="email" value="{{ old('email') }}" placeholder="email@perusahaan.com" required type="email"/>
                </div>

                <button class="w-full py-4 bg-primary text-white font-label-md text-label-md rounded-lg hover:bg-on-primary-fixed-variant active:scale-[0.98] transition-all flex items-center justify-center space-x-2 shadow-lg shadow-primary/10" type="submit">
                    <span class="material-symbols-outlined text-[20px]">send</span>
                    <span>Kirim Permintaan Reset</span>
                </button>
            </form>

            <div class="text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 font-label-md text-label-md text-secondary hover:text-secondary-fixed-dim transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali ke Halaman Login
                </a>
            </div>
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
