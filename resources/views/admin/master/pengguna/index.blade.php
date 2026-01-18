@extends('layouts.admin')

@section('title', 'Master Data Pengguna')
@section('subtitle', 'Manajemen akun pengguna koperasi')

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

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Daftar Pengguna</h2>
                    <p class="mt-1 text-sm text-slate-500">Kelola akun pengguna dan status aktifnya.</p>
                </div>
                @hasrole('Admin')
                    <a href="{{ route('admin.master.pengguna.create') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        Tambah Pengguna
                    </a>
                @endhasrole
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold">Email</th>
                            <th class="px-4 py-3 text-left font-semibold">Role</th>
                            <th class="px-4 py-3 text-left font-semibold">Status</th>
                            @hasrole('Admin')
                                <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                            @endhasrole
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @php
                            $roleColors = [
                                'Admin' => 'bg-rose-100 text-rose-700',
                                'Petugas' => 'bg-blue-100 text-blue-700',
                                'Pembina' => 'bg-emerald-100 text-emerald-700',
                            ];
                        @endphp
                        @forelse ($users as $user)
                            @php
                                $roleName = $user->roles->first()->name ?? 'Tanpa Role';
                                $roleClass = $roleColors[$roleName] ?? 'bg-slate-100 text-slate-600';
                                $statusClass = $user->status === 'AKTIF'
                                    ? 'bg-emerald-100 text-emerald-700'
                                    : 'bg-amber-100 text-amber-700';
                            @endphp
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $roleClass }}">
                                        {{ $roleName }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                        {{ ucfirst(strtolower($user->status)) }}
                                    </span>
                                </td>
                                @hasrole('Admin')
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.master.pengguna.edit', $user) }}"
                                                class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300 hover:text-slate-800">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.master.pengguna.destroy', $user) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-full border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 hover:border-rose-300 hover:text-rose-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endhasrole
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->hasRole('Admin') ? 5 : 4 }}" class="px-4 py-6 text-center text-slate-500">
                                    Belum ada pengguna yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
