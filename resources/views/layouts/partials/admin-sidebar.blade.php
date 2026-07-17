{{-- Admin Sidebar Partial --}}
{{-- Usage: @include('layouts.partials.admin-sidebar', ['active' => 'dashboard']) --}}
{{-- Available active values: dashboard, karyawan, payroll, laporan, kelola-admin, ubah-password --}}

<aside class="w-64 h-full fixed left-0 top-0 bg-primary-container flex flex-col py-stack-lg z-50">
    <div class="px-container-margin mb-stack-lg">
        <div class="flex items-center gap-stack-sm mb-base">
            <img alt="SiGaji Logo" class="w-10 h-10 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgAWtxK_77ytt2urrayReAKWpp-_bUrWIP85-OnY3sE2RViTEaPWLutVpKP_y2iq-GgzOtM_osNR0rh_wDkaIKwjPFGsZEbFdKuJPiWpPS3gOqmp9BiFxdIUQn_Lus5rWebCZ6ULvJu6_i4A51HFEeEsDT6Qg0rTvoKWOER2jF252X6rv_aIFvYZFyw2Kh25RZM_fxqnRJr7B2PPsW_Vxyl5fQnIuU8Y8nArRSQTfEyH_XhAJM2xVGCUBn5sM3lOArn5mGV0tRskM"/>
            <div>
                <h1 class="font-headline-md text-headline-md text-secondary-fixed font-bold leading-tight">SiGaji</h1>
                <p class="font-label-md text-label-md text-primary-fixed-dim uppercase tracking-wider opacity-70">Admin Panel</p>
            </div>
        </div>
    </div>
    <nav class="flex-1 space-y-base px-base">
        <a class="flex items-center gap-stack-md px-container-margin py-stack-sm transition-colors duration-200 {{ ($active ?? '') === 'dashboard' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:bg-on-primary-fixed-variant hover:text-secondary-fixed-dim' }}" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>
        <a class="flex items-center gap-stack-md px-container-margin py-stack-sm transition-colors duration-200 {{ ($active ?? '') === 'karyawan' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:bg-on-primary-fixed-variant hover:text-secondary-fixed-dim' }}" href="{{ route('admin.karyawan') }}">
            <span class="material-symbols-outlined">badge</span>
            <span class="font-label-md text-label-md">Karyawan</span>
        </a>
        <a class="flex items-center gap-stack-md px-container-margin py-stack-sm transition-colors duration-200 {{ ($active ?? '') === 'payroll' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:bg-on-primary-fixed-variant hover:text-secondary-fixed-dim' }}" href="{{ route('admin.payroll') }}">
            <span class="material-symbols-outlined">payments</span>
            <span class="font-label-md text-label-md">Payroll</span>
        </a>
        <a class="flex items-center gap-stack-md px-container-margin py-stack-sm transition-colors duration-200 {{ ($active ?? '') === 'laporan' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:bg-on-primary-fixed-variant hover:text-secondary-fixed-dim' }}" href="{{ route('admin.laporan') }}">
            <span class="material-symbols-outlined">assessment</span>
            <span class="font-label-md text-label-md">Laporan</span>
        </a>
        <a class="flex items-center gap-stack-md px-container-margin py-stack-sm transition-colors duration-200 {{ ($active ?? '') === 'kelola-admin' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:bg-on-primary-fixed-variant hover:text-secondary-fixed-dim' }}" href="{{ route('admin.register') }}">
            <span class="material-symbols-outlined">person_add</span>
            <span class="font-label-md text-label-md">Kelola Admin</span>
        </a>
        <a class="flex items-center gap-stack-md px-container-margin py-stack-sm transition-colors duration-200 {{ ($active ?? '') === 'ubah-password' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:bg-on-primary-fixed-variant hover:text-secondary-fixed-dim' }}" href="{{ route('password.change') }}">
            <span class="material-symbols-outlined">lock</span>
            <span class="font-label-md text-label-md">Ubah Password</span>
        </a>
    </nav>
    <div class="px-base mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-stack-md px-container-margin py-stack-sm text-tertiary-fixed-dim hover:bg-on-primary-fixed-variant hover:text-error transition-colors duration-200">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-label-md text-label-md">Keluar</span>
            </button>
        </form>
    </div>
</aside>
