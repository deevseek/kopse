@extends('layouts.admin')

@section('title', 'Simpanan')
@section('subtitle', 'Kelola simpanan anggota koperasi')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col gap-2 rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-lg font-semibold text-slate-900">Daftar Anggota Simpanan</h2>
                @hasanyrole('Admin|Petugas')
                    <a href="{{ route('admin.simpanan.create') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        Tambah Simpanan
                    </a>
                @endhasanyrole
            </div>
            <p class="text-sm text-slate-500">Ringkasan saldo simpanan pokok, wajib, dan manasuka setiap anggota.</p>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Simpanan Pokok</th>
                            <th class="px-6 py-4">Simpanan Wajib</th>
                            <th class="px-6 py-4">Simpanan Manasuka</th>
                            <th class="px-6 py-4">Total Simpanan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse ($members as $member)
                            @php
                                $pokokType = $savingTypes->get('POKOK');
                                $wajibType = $savingTypes->get('WAJIB');
                                $manasukaType = $savingTypes->get('MANASUKA');

                                $pokokAccount = $pokokType ? $member->savingsAccounts->firstWhere('saving_type_id', $pokokType->id) : null;
                                $wajibAccount = $wajibType ? $member->savingsAccounts->firstWhere('saving_type_id', $wajibType->id) : null;
                                $manasukaAccount = $manasukaType ? $member->savingsAccounts->firstWhere('saving_type_id', $manasukaType->id) : null;

                                $pokokBalance = $pokokAccount?->balance ?? 0;
                                $wajibBalance = $wajibAccount?->balance ?? 0;
                                $manasukaBalance = $manasukaAccount?->balance ?? 0;
                                $totalBalance = $pokokBalance + $wajibBalance + $manasukaBalance;
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $member->name }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($pokokBalance, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($wajibBalance, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($manasukaBalance, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-900">Rp {{ number_format($totalBalance, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.simpanan.show', $member) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 transition hover:border-slate-300 hover:text-slate-900">
                                        Detail Simpanan
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center">
                                    <div class="mx-auto flex max-w-md flex-col items-center gap-2 text-slate-500">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-700">Belum ada anggota.</p>
                                        <p class="text-xs text-slate-400">Tambahkan anggota terlebih dahulu sebelum mencatat simpanan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
