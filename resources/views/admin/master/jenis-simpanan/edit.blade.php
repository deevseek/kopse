@extends('layouts.admin')

@section('title', 'Edit Jenis Simpanan')
@section('subtitle', 'Perbarui konfigurasi jenis simpanan')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.master.jenis-simpanan.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-800">&larr; Kembali</a>
        </div>

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('admin.master.jenis-simpanan.update', $savingType) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="code">Kode</label>
                        <input id="code" name="code" type="text" value="{{ old('code', $savingType->code) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('code')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="name">Nama</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $savingType->name) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('name')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="is_withdrawable">Bisa Ditarik?</label>
                        <select id="is_withdrawable" name="is_withdrawable" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="1" @selected(old('is_withdrawable', (string) $savingType->is_withdrawable) === '1')>Bisa</option>
                            <option value="0" @selected(old('is_withdrawable', (string) $savingType->is_withdrawable) === '0')>Tidak</option>
                        </select>
                        @error('is_withdrawable')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="is_periodic">Periodik?</label>
                        <select id="is_periodic" name="is_periodic" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="1" @selected(old('is_periodic', (string) $savingType->is_periodic) === '1')>Ya</option>
                            <option value="0" @selected(old('is_periodic', (string) $savingType->is_periodic) === '0')>Tidak</option>
                        </select>
                        @error('is_periodic')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="default_amount">Nominal Default</label>
                        <input id="default_amount" name="default_amount" type="number" step="0.01" value="{{ old('default_amount', $savingType->default_amount) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('default_amount')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="is_active">Status</label>
                        <select id="is_active" name="is_active" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="1" @selected(old('is_active', (string) $savingType->is_active) === '1')>Aktif</option>
                            <option value="0" @selected(old('is_active', (string) $savingType->is_active) === '0')>Nonaktif</option>
                        </select>
                        @error('is_active')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.master.jenis-simpanan.index') }}" class="rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
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
