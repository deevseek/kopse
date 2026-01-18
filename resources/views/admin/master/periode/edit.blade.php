@extends('layouts.admin')

@section('title', 'Edit Periode')
@section('subtitle', 'Perbarui data periode buku')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.master.periode.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-800">&larr; Kembali</a>
        </div>

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('admin.master.periode.update', $period) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="year">Tahun Buku</label>
                        <input id="year" name="year" type="text" value="{{ old('year', $period->year) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('year')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="start_date">Tanggal Mulai</label>
                        <input id="start_date" name="start_date" type="date" value="{{ old('start_date', $period->start_date->format('Y-m-d')) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('start_date')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="end_date">Tanggal Selesai</label>
                        <input id="end_date" name="end_date" type="date" value="{{ old('end_date', $period->end_date->format('Y-m-d')) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" />
                        @error('end_date')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="is_active">Status Aktif</label>
                        <select id="is_active" name="is_active" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="1" @selected(old('is_active', (string) $period->is_active) === '1')>Aktif</option>
                            <option value="0" @selected(old('is_active', (string) $period->is_active) === '0')>Nonaktif</option>
                        </select>
                        @error('is_active')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="is_closed">Status Tutup</label>
                        <select id="is_closed" name="is_closed" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="0" @selected(old('is_closed', (string) $period->is_closed) === '0')>Terbuka</option>
                            <option value="1" @selected(old('is_closed', (string) $period->is_closed) === '1')>Ditutup</option>
                        </select>
                        @error('is_closed')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.master.periode.index') }}" class="rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
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
