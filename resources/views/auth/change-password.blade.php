@extends('layouts.app')

@section('title', 'Ubah Kata Sandi - SiGaji')

@section('styles')
<style>
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
    .strength-bar { transition: width 0.3s ease, background-color 0.3s ease; }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-surface-bg flex items-center justify-center p-stack-lg">
    <div class="w-full max-w-lg">
        <!-- Header -->
        <div class="text-center mb-stack-lg">
            <div class="inline-flex items-center space-x-3 mb-6">
                <img alt="SiGaji Logo" class="h-10 w-10 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlnhf7MlquTlST3STI9UBWShPHkFBgSsP3IzDUl2GQ-0xFhflw_ekKCt03zJ3fcgcuZ1F6Y9TKDkwUbdICk6K-Rp-KMD5STuJJ1Ni81g75kireR3mqk8CD8CvastUyOwWmMQSBvlmiiZL-2m_ozHigR2oxQyRKTVk5BK43IZNKsxmlNdaTOIi37JmrF8bUECAbZOGDk9aWgA61-s-FFK-nHoKesGHAFR-JlH_rFFDNWwex7Q5of33Xk4Kq9fqpGy5cTfQnKaYJQ04"/>
                <span class="font-headline-md text-headline-md font-extrabold tracking-tight text-primary">SiGaji<span class="text-secondary">Admin</span></span>
            </div>
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-secondary/10 mb-4">
                <span class="material-symbols-outlined text-secondary text-[32px]">lock</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Ubah Kata Sandi</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">Perbarui kata sandi Anda secara berkala untuk menjaga keamanan akun.</p>
        </div>

        <!-- Form Card -->
        <div class="glass-card rounded-xl p-stack-lg shadow-sm">
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
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-stack-md">
                @csrf

                <!-- Current Password -->
                <div class="space-y-base">
                    <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="current_password">
                        <span class="material-symbols-outlined text-[18px]">lock</span>
                        Kata Sandi Saat Ini
                    </label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant transition-all" id="current_password" name="current_password" placeholder="••••••••" required type="password"/>
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors toggle-password" type="button" data-target="current_password">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                </div>

                <hr class="border-border-muted"/>

                <!-- New Password -->
                <div class="space-y-base">
                    <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="password">
                        <span class="material-symbols-outlined text-[18px]">lock_open</span>
                        Kata Sandi Baru
                    </label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant transition-all" id="password" name="password" placeholder="Minimal 8 karakter" required type="password"/>
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors toggle-password" type="button" data-target="password">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                    <!-- Password Strength Indicator -->
                    <div class="flex gap-1 mt-2">
                        <div class="h-1 flex-1 rounded-full bg-border-muted overflow-hidden">
                            <div class="strength-bar h-full w-0 rounded-full" id="strength-1"></div>
                        </div>
                        <div class="h-1 flex-1 rounded-full bg-border-muted overflow-hidden">
                            <div class="strength-bar h-full w-0 rounded-full" id="strength-2"></div>
                        </div>
                        <div class="h-1 flex-1 rounded-full bg-border-muted overflow-hidden">
                            <div class="strength-bar h-full w-0 rounded-full" id="strength-3"></div>
                        </div>
                        <div class="h-1 flex-1 rounded-full bg-border-muted overflow-hidden">
                            <div class="strength-bar h-full w-0 rounded-full" id="strength-4"></div>
                        </div>
                    </div>
                    <p class="text-xs text-on-surface-variant" id="strength-text"></p>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-base">
                    <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2" for="password_confirmation">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 bg-white border border-border-muted rounded-lg font-body-md text-on-surface placeholder:text-outline-variant transition-all" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi baru" required type="password"/>
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors toggle-password" type="button" data-target="password_confirmation">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                    <p class="text-xs text-error hidden" id="match-error">Kata sandi tidak cocok</p>
                </div>

                <!-- Security Tips -->
                <div class="p-3 bg-tertiary-fixed text-on-tertiary-fixed rounded-lg text-[11px] leading-relaxed">
                    <span class="font-bold flex items-center gap-1 mb-1">
                        <span class="material-symbols-outlined text-[14px]">info</span> Tips Keamanan
                    </span>
                    Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol. Hindari menggunakan informasi pribadi seperti tanggal lahir.
                </div>

                <!-- Actions -->
                <div class="flex gap-stack-md pt-2">
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('employee.dashboard') }}" class="flex-1 py-3 rounded-lg border border-border-muted text-primary font-label-md text-label-md text-center hover:bg-surface-container transition-colors">
                        Kembali
                    </a>
                    <button class="flex-1 py-3 bg-primary text-white font-label-md text-label-md rounded-lg hover:bg-on-primary-fixed-variant active:scale-[0.98] transition-all flex items-center justify-center space-x-2 shadow-lg shadow-primary/10" type="submit">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
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

    // Password Strength Meter
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const strengthBars = [
        document.getElementById('strength-1'),
        document.getElementById('strength-2'),
        document.getElementById('strength-3'),
        document.getElementById('strength-4'),
    ];
    const strengthText = document.getElementById('strength-text');
    const matchError = document.getElementById('match-error');

    function checkStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
        if (/\d/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;
        return score;
    }

    const strengthColors = ['#ef4444', '#f59e0b', '#3b82f6', '#22c55e'];
    const strengthLabels = ['Lemah', 'Cukup', 'Baik', 'Kuat'];

    passwordInput.addEventListener('input', () => {
        const score = checkStrength(passwordInput.value);
        strengthBars.forEach((bar, i) => {
            if (i < score) {
                bar.style.width = '100%';
                bar.style.backgroundColor = strengthColors[score - 1];
            } else {
                bar.style.width = '0';
            }
        });
        strengthText.textContent = passwordInput.value ? `Kekuatan: ${strengthLabels[score - 1] || 'Sangat Lemah'}` : '';
    });

    confirmInput.addEventListener('input', () => {
        if (confirmInput.value && confirmInput.value !== passwordInput.value) {
            matchError.classList.remove('hidden');
        } else {
            matchError.classList.add('hidden');
        }
    });
</script>
@endsection
