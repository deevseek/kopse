@extends('layouts.admin')

@section('title', 'Pengaturan Koperasi')
@section('subtitle', 'Konfigurasi profil koperasi')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($isReadOnly)
            <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                Anda memiliki akses baca saja untuk pengaturan koperasi.
            </div>
        @endif

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-1">
                <h2 class="text-lg font-semibold text-slate-900">Profil Koperasi</h2>
                <p class="text-sm text-slate-500">Lengkapi informasi profil koperasi dan pengaturan simpanan.</p>
            </div>

            <form class="mt-6 space-y-6" method="POST" action="{{ route('admin.master.pengaturan-koperasi.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-6 lg:grid-cols-[240px_1fr]">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-slate-700">Logo Koperasi</p>
                            <span class="text-xs text-slate-400">Opsional</span>
                        </div>
                        <div class="flex flex-col items-center gap-4 rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-4">
                            <div class="flex h-36 w-36 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-sm">
                                <img
                                    id="logo-preview"
                                    src="{{ $logoUrl ?? 'https://placehold.co/144x144?text=Logo' }}"
                                    alt="Logo koperasi"
                                    class="h-full w-full object-cover"
                                />
                            </div>
                            <input
                                id="logo"
                                name="logo"
                                type="file"
                                accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-slate-700"
                                @disabled($isReadOnly)
                            />
                            @error('logo')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700" for="cooperative_name">Nama Koperasi</label>
                            <input
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="cooperative_name"
                                name="cooperative_name"
                                type="text"
                                value="{{ old('cooperative_name', $setting->cooperative_name) }}"
                                @disabled($isReadOnly)
                            />
                            @error('cooperative_name')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700" for="school_name">Nama Sekolah</label>
                            <input
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="school_name"
                                name="school_name"
                                type="text"
                                value="{{ old('school_name', $setting->school_name) }}"
                                @disabled($isReadOnly)
                            />
                            @error('school_name')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-semibold text-slate-700" for="address">Alamat</label>
                            <textarea
                                class="min-h-[96px] w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="address"
                                name="address"
                                @disabled($isReadOnly)
                            >{{ old('address', $setting->address) }}</textarea>
                            @error('address')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700" for="phone">Nomor Telepon</label>
                            <input
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="phone"
                                name="phone"
                                type="text"
                                value="{{ old('phone', $setting->phone) }}"
                                @disabled($isReadOnly)
                            />
                            @error('phone')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700" for="simpanan_pokok_amount">Simpanan Pokok</label>
                            <input
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="simpanan_pokok_amount"
                                name="simpanan_pokok_amount"
                                type="number"
                                step="0.01"
                                value="{{ old('simpanan_pokok_amount', $setting->simpanan_pokok_amount) }}"
                                @disabled($isReadOnly)
                            />
                            @error('simpanan_pokok_amount')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700" for="simpanan_wajib_amount">Simpanan Wajib</label>
                            <input
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="simpanan_wajib_amount"
                                name="simpanan_wajib_amount"
                                type="number"
                                step="0.01"
                                value="{{ old('simpanan_wajib_amount', $setting->simpanan_wajib_amount) }}"
                                @disabled($isReadOnly)
                            />
                            @error('simpanan_wajib_amount')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700" for="shu_cadangan_percent">SHU Dana Cadangan (%)</label>
                            <input
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="shu_cadangan_percent"
                                name="shu_cadangan_percent"
                                type="number"
                                step="0.01"
                                value="{{ old('shu_cadangan_percent', $setting->shu_cadangan_percent) }}"
                                @disabled($isReadOnly)
                            />
                            @error('shu_cadangan_percent')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700" for="shu_anggota_percent">SHU Anggota (%)</label>
                            <input
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                                id="shu_anggota_percent"
                                name="shu_anggota_percent"
                                type="number"
                                step="0.01"
                                value="{{ old('shu_anggota_percent', $setting->shu_anggota_percent) }}"
                                @disabled($isReadOnly)
                            />
                            @error('shu_anggota_percent')
                                <p class="text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                @unless($isReadOnly)
                    <div class="flex items-center justify-end gap-3">
                        <button
                            type="submit"
                            class="rounded-full bg-slate-900 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                @endunless
            </form>
        </div>
    </div>

    <script>
        const logoInput = document.getElementById('logo');
        const logoPreview = document.getElementById('logo-preview');

        if (logoInput && logoPreview) {
            logoInput.addEventListener('change', (event) => {
                const [file] = event.target.files;
                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    logoPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection
