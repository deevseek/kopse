@extends('layouts.admin')

@section('title', 'Role & Hak Akses')
@section('subtitle', 'Pengaturan peran dan hak akses')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Role & Hak Akses</h2>
                <p class="mt-1 text-sm text-slate-500">Lihat daftar role dan izin akses yang terpasang.</p>
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Role</th>
                            <th class="px-4 py-3 text-left font-semibold">Hak Akses</th>
                            @hasrole('Admin')
                                <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                            @endhasrole
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($roles as $role)
                            <tr>
                                <td class="px-4 py-3 font-semibold text-slate-900">{{ $role->name }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($role->permissions as $permission)
                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                                {{ $permission->name }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-slate-400">Belum ada izin.</span>
                                        @endforelse
                                    </div>
                                </td>
                                @hasrole('Admin')
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('admin.master.role.edit', $role) }}"
                                            class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300 hover:text-slate-800">
                                            Edit
                                        </a>
                                    </td>
                                @endhasrole
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->hasRole('Admin') ? 3 : 2 }}" class="px-4 py-6 text-center text-slate-500">
                                    Belum ada role yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
