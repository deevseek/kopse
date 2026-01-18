@extends('layouts.admin')

@section('title', 'Master Data Anggota')
@section('subtitle', 'Kelola data anggota koperasi sekolah')

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
                <h2 class="text-lg font-semibold text-slate-900">Daftar Anggota</h2>
                <p class="mt-1 text-sm text-slate-500">Data terbaru anggota koperasi sekolah.</p>
            </div>
            @hasanyrole('Admin|Petugas')
                <a href="{{ route('admin.master-data.anggota.create') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    Tambah Anggota
                </a>
            @endhasanyrole
        </div>

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <form method="GET" class="grid gap-4 md:grid-cols-4">
                <div class="md:col-span-2">
                    <label class="text-sm font-medium text-slate-600" for="search">Cari</label>
                    <input id="search" name="search" type="text" value="{{ request('search') }}" placeholder="Nama atau nomor anggota" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0" />
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-600" for="status">Status</label>
                    <select id="status" name="status" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0">
                        <option value="">Semua Status</option>
                        @foreach (['AKTIF' => 'Aktif', 'KELUAR' => 'Keluar', 'LULUS' => 'Lulus'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-600" for="member_type">Tipe</label>
                    <select id="member_type" name="member_type" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0">
                        <option value="">Semua Tipe</option>
                        @foreach (['SISWA' => 'Siswa', 'GURU' => 'Guru', 'KARYAWAN' => 'Karyawan'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('member_type') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-4 flex flex-wrap gap-3">
                    <button type="submit" class="rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        Terapkan
                    </button>
                    <a href="{{ route('admin.master-data.anggota.index') }}" class="rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nomor Anggota</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4">Kelas</th>
                            <th class="px-6 py-4">Gender</th>
                            <th class="px-6 py-4">Tgl Bergabung</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse ($members as $member)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}</td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $member->member_no }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $member->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $member->phone ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">{{ ucfirst(strtolower($member->member_type)) }}</td>
                                <td class="px-6 py-4">{{ $member->class_name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $member->gender === 'L' ? 'Laki-laki' : ($member->gender === 'P' ? 'Perempuan' : '-') }}</td>
                                <td class="px-6 py-4">{{ $member->join_date->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $member->status === 'AKTIF' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ ucfirst(strtolower($member->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.master-data.anggota.show', $member) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition hover:border-slate-300 hover:text-slate-700" title="Detail">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M1.5 12s4-7.5 10.5-7.5S22.5 12 22.5 12 18.5 19.5 12 19.5 1.5 12 1.5 12Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>
                                        @hasanyrole('Admin|Petugas')
                                            <a href="{{ route('admin.master-data.anggota.edit', $member) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition hover:border-slate-300 hover:text-slate-700" title="Edit">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 0 1 2.97 2.97L7.5 19.79 3 21l1.21-4.5 12.652-12.013Z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.master-data.anggota.destroy', $member) }}" onsubmit="return confirm('Hapus data anggota ini?');">
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
                                        @endhasanyrole
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-10 text-center">
                                    <div class="mx-auto flex max-w-md flex-col items-center gap-2 text-slate-500">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-700">Belum ada anggota.</p>
                                        <p class="text-xs text-slate-400">Gunakan tombol tambah untuk memasukkan data anggota baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $members->links() }}
            </div>
        </div>
    </div>
@endsection
