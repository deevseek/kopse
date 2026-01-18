@extends('layouts.admin')

@section('title', 'Edit Akun')
@section('subtitle', 'Perbarui data akun / COA')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.master.akun.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-800">&larr; Kembali</a>
        </div>

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('admin.master.akun.update', $account) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="code">Kode</label>
                        <input id="code" name="code" type="text" value="{{ old('code', $account->code) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('code')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="name">Nama</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $account->name) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('name')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="type">Tipe Akun</label>
                        <select id="type" name="type" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            @foreach (['ASET', 'KEWAJIBAN', 'MODAL', 'PENDAPATAN', 'BIAYA'] as $type)
                                <option value="{{ $type }}" @selected(old('type', $account->type) === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="is_active">Status</label>
                        <select id="is_active" name="is_active" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="1" @selected(old('is_active', (string) $account->is_active) === '1')>Aktif</option>
                            <option value="0" @selected(old('is_active', (string) $account->is_active) === '0')>Nonaktif</option>
                        </select>
                        @error('is_active')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.master.akun.index') }}" class="rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
                        Batal
                    </a>
                    <button type="submit" class="rounded-full bg-slate-900 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
