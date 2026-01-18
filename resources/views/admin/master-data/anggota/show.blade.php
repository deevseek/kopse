@extends('layouts.admin')

@section('title', 'Detail Anggota')
@section('subtitle', 'Informasi lengkap anggota koperasi')

@section('content')
    <div class="space-y-6">
        <a href="{{ route('admin.master-data.anggota.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-slate-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
            </svg>
            Kembali ke daftar
        </a>

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 border-b border-slate-100 pb-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm text-slate-400">Nomor Anggota</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $member->member_no }}</p>
                </div>
                @hasanyrole('Admin|Petugas')
                    <a href="{{ route('admin.master-data.anggota.edit', $member) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 0 1 2.97 2.97L7.5 19.79 3 21l1.21-4.5 12.652-12.013Z" />
                        </svg>
                        Edit Anggota
                    </a>
                @endhasanyrole
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <p class="text-sm text-slate-400">Nama Anggota</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $member->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400">Tipe Anggota</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ ucfirst(strtolower($member->member_type)) }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400">Kelas</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $member->class_name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400">Jenis Kelamin</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $member->gender === 'L' ? 'Laki-laki' : ($member->gender === 'P' ? 'Perempuan' : '-') }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400">Nomor Telepon</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $member->phone ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400">Tanggal Bergabung</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $member->join_date->format('d M Y') }}</p>
                </div>
                <div class="lg:col-span-2">
                    <p class="text-sm text-slate-400">Alamat</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $member->address ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400">Status</p>
                    <span class="mt-2 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $member->status === 'AKTIF' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ ucfirst(strtolower($member->status)) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
