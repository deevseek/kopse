@extends('layouts.admin')

@section('title', 'Tambah Pengguna')
@section('subtitle', 'Buat akun pengguna baru')

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

        <form method="POST" action="{{ route('admin.master.pengguna.store') }}"
            class="space-y-6 rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label class="text-sm font-semibold text-slate-700" for="name">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}"
                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-200"
                    required>
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-200"
                    required>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="password">Password</label>
                    <input id="password" name="password" type="password"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-200"
                        required>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-200"
                        required>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="role">Role</label>
                    <select id="role" name="role"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-200"
                        required>
                        <option value="" disabled selected>Pilih role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role') === $role->name)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="status">Status</label>
                    <select id="status" name="status"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-200"
                        required>
                        <option value="AKTIF" @selected(old('status') === 'AKTIF')>Aktif</option>
                        <option value="NONAKTIF" @selected(old('status') === 'NONAKTIF')>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.master.pengguna.index') }}"
                    class="rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:border-slate-300 hover:text-slate-800">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
