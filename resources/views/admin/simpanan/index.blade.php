@extends('layouts.admin')

@section('title', 'Simpanan')
@section('subtitle', 'Kelola simpanan anggota koperasi')

@section('content')
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Simpanan Pokok</h2>
            <p class="mt-2 text-sm text-slate-500">Halaman ini disiapkan untuk transaksi simpanan pokok.</p>
        </div>
        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Simpanan Wajib & Manasuka</h2>
            <p class="mt-2 text-sm text-slate-500">Kelola simpanan wajib, manasuka, serta mutasi saldo.</p>
        </div>
    </div>
@endsection
