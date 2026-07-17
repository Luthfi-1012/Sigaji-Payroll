{{-- Employee Sidebar Partial --}}
{{-- Usage: @include('layouts.partials.employee-sidebar', ['active' => 'dashboard']) --}}
{{-- Available active values: dashboard, slip-gaji, profil --}}

<aside class="w-64 h-full fixed left-0 top-0 bg-primary-container flex flex-col py-stack-lg z-50">
    <div class="px-6 mb-stack-lg">
        <h1 class="font-headline-md text-headline-md text-secondary-fixed font-bold tracking-tight">SiGaji</h1>
        <p class="font-label-md text-label-md text-on-primary-container opacity-80 uppercase tracking-widest">Employee Panel</p>
    </div>
    <nav class="flex-1 flex flex-col">
        <a class="flex items-center px-6 py-4 transition-colors duration-200 {{ ($active ?? '') === 'dashboard' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:text-secondary-fixed-dim hover:bg-on-primary-fixed-variant' }}" href="{{ route('employee.dashboard') }}">
            <span class="material-symbols-outlined mr-3">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>
        <a class="flex items-center px-6 py-4 transition-colors duration-200 {{ ($active ?? '') === 'slip-gaji' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:text-secondary-fixed-dim hover:bg-on-primary-fixed-variant' }}" href="{{ route('employee.riwayat-slip') }}">
            <span class="material-symbols-outlined mr-3">receipt_long</span>
            <span class="font-label-md text-label-md">Slip Gaji Saya</span>
        </a>
        <a class="flex items-center px-6 py-4 transition-colors duration-200 {{ ($active ?? '') === 'profil' ? 'text-secondary-fixed font-bold border-r-4 border-secondary-fixed bg-on-primary-fixed-variant' : 'text-tertiary-fixed-dim hover:text-secondary-fixed-dim hover:bg-on-primary-fixed-variant' }}" href="{{ route('employee.profil') }}">
            <span class="material-symbols-outlined mr-3">person</span>
            <span class="font-label-md text-label-md">Profil</span>
        </a>
        <div class="mt-auto pt-6 border-t border-primary/20">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-6 py-4 text-tertiary-fixed-dim hover:text-secondary-fixed-dim hover:bg-on-primary-fixed-variant transition-colors duration-200">
                    <span class="material-symbols-outlined mr-3">logout</span>
                    <span class="font-label-md text-label-md">Keluar</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
