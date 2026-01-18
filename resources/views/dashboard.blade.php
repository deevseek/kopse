@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan koperasi')

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <x-dashboard.stat-card title="Jumlah Anggota" value="328">
            <x-slot:icon>
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM5 20a7 7 0 0 1 14 0" />
                </svg>
            </x-slot:icon>
            <x-slot:trend>+4% bulan ini</x-slot:trend>
            <x-slot:description>Anggota aktif terdata</x-slot:description>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card title="Total Simpanan" value="Rp 487.250.000">
            <x-slot:icon>
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
            </x-slot:icon>
            <x-slot:trend>+8,2% tahun berjalan</x-slot:trend>
            <x-slot:description>Akumulasi simpanan anggota</x-slot:description>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card title="Pinjaman Aktif" value="Rp 165.900.000">
            <x-slot:icon>
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M5 7v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7M9 11h6" />
                </svg>
            </x-slot:icon>
            <x-slot:trend>12 pengajuan berjalan</x-slot:trend>
            <x-slot:description>Status pinjaman aktif</x-slot:description>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card title="Saldo Kas" value="Rp 78.450.000">
            <x-slot:icon>
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16v10H4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 11h.01M12 11h.01M16 11h.01" />
                </svg>
            </x-slot:icon>
            <x-slot:trend>Update hari ini</x-slot:trend>
            <x-slot:description>Saldo kas harian</x-slot:description>
        </x-dashboard.stat-card>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm lg:col-span-2">
            <h2 class="text-lg font-semibold text-slate-900">Aktivitas Koperasi</h2>
            <p class="mt-1 text-sm text-slate-500">Ringkasan transaksi terbaru (dummy).</p>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-800">Simpanan Wajib</p>
                    <p class="mt-2 text-sm text-slate-500">48 transaksi terkini</p>
                </div>
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-800">Angsuran Pinjaman</p>
                    <p class="mt-2 text-sm text-slate-500">32 angsuran berjalan</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Pengingat</h2>
            <ul class="mt-4 space-y-4 text-sm text-slate-600">
                <li class="rounded-xl bg-slate-50 px-4 py-3">Rekap kas harian ditutup pukul 16.00</li>
                <li class="rounded-xl bg-slate-50 px-4 py-3">Pengajuan pinjaman baru menunggu verifikasi</li>
                <li class="rounded-xl bg-slate-50 px-4 py-3">Persiapan perhitungan SHU tahunan</li>
            </ul>
        </div>
    </div>
@endsection
