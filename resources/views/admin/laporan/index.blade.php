@extends('layouts.admin')

@section('title', 'Laporan')
@section('subtitle', 'Ringkasan laporan koperasi')

@section('content')
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Kartu Simpanan & Pinjaman</h2>
            <p class="mt-2 text-sm text-slate-500">Akses laporan kartu simpanan anggota dan daftar pinjaman.</p>
        </div>
        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Rekapitulasi Keuangan</h2>
            <p class="mt-2 text-sm text-slate-500">Rekap kas, neraca, dan laporan SHU tahunan.</p>
        </div>
    </div>
@endsection
