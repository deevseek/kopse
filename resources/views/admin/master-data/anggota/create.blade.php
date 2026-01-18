@extends('layouts.admin')

@section('title', 'Tambah Anggota')
@section('subtitle', 'Lengkapi data anggota baru koperasi')

@section('content')
    <div class="space-y-6">
        <a href="{{ route('admin.master-data.anggota.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-slate-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
            </svg>
            Kembali ke daftar
        </a>

        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <p class="font-semibold">Periksa kembali data yang diinput.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.master-data.anggota.store') }}" class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            @csrf
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700">Nomor Anggota</label>
                    <p class="mt-2 text-sm text-slate-500">Otomatis dibuat setelah data tersimpan.</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="name">Nama Anggota <span class="text-rose-500">*</span></label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="member_type">Tipe Anggota <span class="text-rose-500">*</span></label>
                    <select id="member_type" name="member_type" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0">
                        <option value="">Pilih tipe</option>
                        @foreach (['SISWA' => 'Siswa', 'GURU' => 'Guru', 'KARYAWAN' => 'Karyawan'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('member_type') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="class-field" class="hidden">
                    <label class="text-sm font-semibold text-slate-700" for="class_name">Kelas <span class="text-rose-500">*</span></label>
                    <input id="class_name" name="class_name" type="text" value="{{ old('class_name') }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0" />
                    <p class="mt-2 text-xs text-slate-400">Contoh: VII A, VIII B.</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="gender">Jenis Kelamin</label>
                    <select id="gender" name="gender" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0">
                        <option value="">Pilih</option>
                        <option value="L" @selected(old('gender') === 'L')>Laki-laki</option>
                        <option value="P" @selected(old('gender') === 'P')>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="phone">Nomor Telepon</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0" />
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold text-slate-700" for="address">Alamat</label>
                    <textarea id="address" name="address" rows="3" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0">{{ old('address') }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="join_date">Tanggal Bergabung <span class="text-rose-500">*</span></label>
                    <input id="join_date" name="join_date" type="date" value="{{ old('join_date') }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="status">Status Anggota <span class="text-rose-500">*</span></label>
                    <select id="status" name="status" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-0">
                        <option value="AKTIF" @selected(old('status', 'AKTIF') === 'AKTIF')>Aktif</option>
                        <option value="KELUAR" @selected(old('status') === 'KELUAR')>Keluar</option>
                        <option value="LULUS" @selected(old('status') === 'LULUS')>Lulus</option>
                    </select>
                </div>
            </div>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <button type="submit" class="rounded-full bg-slate-900 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    Simpan
                </button>
                <a href="{{ route('admin.master-data.anggota.index') }}" class="rounded-full border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const memberType = document.getElementById('member_type');
            const classField = document.getElementById('class-field');
            const classInput = document.getElementById('class_name');

            const toggleClassField = () => {
                if (memberType.value === 'SISWA') {
                    classField.classList.remove('hidden');
                    classInput.disabled = false;
                } else {
                    classField.classList.add('hidden');
                    classInput.value = '';
                    classInput.disabled = true;
                }
            };

            toggleClassField();
            memberType.addEventListener('change', toggleClassField);
        });
    </script>
@endsection
