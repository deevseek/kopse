<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Koperasi Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-700">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-slate-200 bg-white px-6 py-6 lg:flex">
            <div class="mb-8 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Koperasi Sekolah</p>
                    <p class="text-xs text-slate-500">Panel Administrasi</p>
                </div>
            </div>

            <nav class="flex-1 space-y-6">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Utama</p>
                    <x-admin.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="flex items-center gap-3">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5v9a1.5 1.5 0 0 1-1.5 1.5H4.5A1.5 1.5 0 0 1 3 19.5v-9Z" />
                            </svg>
                            Dashboard
                        </span>
                    </x-admin.nav-link>
                </div>

                @hasanyrole('Admin|Petugas')
                    <div>
                        <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Master Data</p>
                        <div class="space-y-1">
                            <x-admin.nav-link :href="route('admin.master-data.anggota')" :active="request()->routeIs('admin.master-data.anggota')">Anggota</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.master-data.pengguna')" :active="request()->routeIs('admin.master-data.pengguna')">Pengguna</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.master-data.roles')" :active="request()->routeIs('admin.master-data.roles')">Role &amp; Hak Akses</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.master-data.jenis-simpanan')" :active="request()->routeIs('admin.master-data.jenis-simpanan')">Jenis Simpanan</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.master-data.produk-pinjaman')" :active="request()->routeIs('admin.master-data.produk-pinjaman')">Produk Pinjaman</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.master-data.coa')" :active="request()->routeIs('admin.master-data.coa')">Akun / COA</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.master-data.periode')" :active="request()->routeIs('admin.master-data.periode')">Periode / Tahun Buku</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.master-data.pengaturan-koperasi')" :active="request()->routeIs('admin.master-data.pengaturan-koperasi')">Pengaturan Koperasi</x-admin.nav-link>
                        </div>
                    </div>
                @endhasanyrole

                @hasanyrole('Admin|Petugas')
                    <div>
                        <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Transaksi</p>
                        <div class="space-y-1">
                            <x-admin.nav-link :href="route('admin.simpanan')" :active="request()->routeIs('admin.simpanan')">Simpanan</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.pinjaman')" :active="request()->routeIs('admin.pinjaman')">Pinjaman</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.kas')" :active="request()->routeIs('admin.kas')">Kas</x-admin.nav-link>
                        </div>
                    </div>
                @endhasanyrole

                @hasanyrole('Admin|Petugas')
                    <div>
                        <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Tahunan</p>
                        <div class="space-y-1">
                            <x-admin.nav-link :href="route('admin.shu')" :active="request()->routeIs('admin.shu')">SHU</x-admin.nav-link>
                            <x-admin.nav-link :href="route('admin.dana-cadangan')" :active="request()->routeIs('admin.dana-cadangan')">Dana Cadangan</x-admin.nav-link>
                        </div>
                    </div>
                @endhasanyrole

                <div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Laporan</p>
                    <x-admin.nav-link :href="route('admin.laporan')" :active="request()->routeIs('admin.laporan')">Laporan</x-admin.nav-link>
                </div>

                @hasanyrole('Admin|Petugas')
                    <div>
                        <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Keamanan &amp; Sistem</p>
                        <x-admin.nav-link :href="route('admin.keamanan')" :active="request()->routeIs('admin.keamanan')">Keamanan &amp; Sistem</x-admin.nav-link>
                    </div>
                @endhasanyrole
            </nav>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4 shadow-sm">
                <div>
                    <p class="text-sm text-slate-400">@yield('subtitle', 'Ringkasan') </p>
                    <h1 class="text-2xl font-semibold text-slate-900">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ auth()->user()->getRoleNames()->first() ?? 'Tanpa Role' }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 px-6 py-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
