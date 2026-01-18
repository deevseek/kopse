@extends('layouts.admin')

@section('title', 'Jenis Simpanan')
@section('subtitle', 'Kelola master jenis simpanan koperasi')

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

        <div class="flex flex-col gap-4 rounded-2xl border border-slate-100 bg-white p-6 shadow-sm lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Daftar Jenis Simpanan</h2>
                <p class="mt-1 text-sm text-slate-500">Pengaturan jenis simpanan utama untuk koperasi.</p>
            </div>
            @hasrole('Admin')
                <a href="{{ route('admin.master.jenis-simpanan.create') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    Tambah Jenis
                </a>
            @endhasrole
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Kode</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Penarikan</th>
                            <th class="px-6 py-4">Periodik</th>
                            <th class="px-6 py-4">Nominal Default</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse ($savingTypes as $savingType)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $savingType->code }}</td>
                                <td class="px-6 py-4">{{ $savingType->name }}</td>
                                <td class="px-6 py-4">{{ $savingType->is_withdrawable ? 'Bisa' : 'Tidak' }}</td>
                                <td class="px-6 py-4">{{ $savingType->is_periodic ? 'Ya' : 'Tidak' }}</td>
                                <td class="px-6 py-4">{{ $savingType->default_amount ? number_format($savingType->default_amount, 2, ',', '.') : '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $savingType->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $savingType->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        @hasrole('Admin')
                                            <a href="{{ route('admin.master.jenis-simpanan.edit', $savingType) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition hover:border-slate-300 hover:text-slate-700" title="Edit">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 0 1 2.97 2.97L7.5 19.79 3 21l1.21-4.5 12.652-12.013Z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.master.jenis-simpanan.destroy', $savingType) }}" onsubmit="return confirm('Hapus jenis simpanan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-rose-500 transition hover:border-rose-300 hover:text-rose-600" title="Hapus">
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 6v12m8-12v12" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 6l1-2h12l1 2" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400">Hanya baca</span>
                                        @endhasrole
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center">
                                    <div class="mx-auto flex max-w-md flex-col items-center gap-2 text-slate-500">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-700">Belum ada jenis simpanan.</p>
                                        <p class="text-xs text-slate-400">Gunakan tombol tambah untuk memasukkan data jenis simpanan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $savingTypes->links() }}
            </div>
        </div>
    </div>
@endsection
