@extends('layouts.admin')

@section('title', 'Edit Hak Akses')
@section('subtitle', 'Sesuaikan izin role')

@section('content')
    <div class="space-y-6">
        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.master.role.update', $role) }}"
            class="space-y-6 rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <p class="text-sm text-slate-500">Role</p>
                <h2 class="text-lg font-semibold text-slate-900">{{ $role->name }}</h2>
                <p class="mt-1 text-sm text-slate-500">Nama role tidak dapat diubah.</p>
            </div>

            @php
                $permissionLabels = [
                    'master.view' => 'Master Data - Lihat',
                    'master.manage' => 'Master Data - Kelola',
                    'simpanan.view' => 'Simpanan - Lihat',
                    'simpanan.manage' => 'Simpanan - Kelola',
                    'pinjaman.view' => 'Pinjaman - Lihat',
                    'pinjaman.manage' => 'Pinjaman - Kelola',
                    'kas.view' => 'Kas - Lihat',
                    'kas.manage' => 'Kas - Kelola',
                    'shu.view' => 'SHU - Lihat',
                    'shu.manage' => 'SHU - Kelola',
                    'laporan.view' => 'Laporan - Lihat',
                    'user.manage' => 'Pengguna - Kelola',
                    'role.manage' => 'Role - Kelola',
                ];
            @endphp

            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($groupedPermissions as $group => $permissions)
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ $group }}</p>
                        <div class="mt-4 space-y-3">
                            @forelse ($permissions as $permission)
                                <label class="flex items-center gap-3 text-sm text-slate-700">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                                        @checked(in_array($permission->name, old('permissions', $role->permissions->pluck('name')->all()), true))>
                                    <span>{{ $permissionLabels[$permission->name] ?? $permission->name }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-slate-400">Belum ada izin pada kategori ini.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.master.role.index') }}"
                    class="rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:border-slate-300 hover:text-slate-800">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
