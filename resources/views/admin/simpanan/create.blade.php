@extends('layouts.admin')

@section('title', 'Tambah Simpanan')
@section('subtitle', 'Formulir pencatatan simpanan anggota')

@section('content')
    <div class="space-y-6">
        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.simpanan') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-800">&larr; Kembali</a>
        </div>

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('admin.simpanan.store') }}" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="member_id">Anggota</label>
                        <select id="member_id" name="member_id" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="">Pilih anggota</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                                    {{ $member->name }} - {{ $member->member_no }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="trx_type">Jenis Transaksi</label>
                        <select id="trx_type" name="trx_type" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="SETOR" @selected(old('trx_type', 'SETOR') === 'SETOR')>Setor</option>
                            <option value="TARIK" @selected(old('trx_type') === 'TARIK')>Tarik</option>
                        </select>
                        @error('trx_type')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="saving_type_id">Jenis Simpanan</label>
                        <select id="saving_type_id" name="saving_type_id" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="">Pilih jenis simpanan</option>
                            @foreach ($savingTypes as $savingType)
                                <option value="{{ $savingType->id }}" @selected(old('saving_type_id') == $savingType->id)>
                                    {{ $savingType->name }} ({{ $savingType->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('saving_type_id')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600" for="amount">Nominal</label>
                        <input id="amount" name="amount" type="number" min="1" step="1" value="{{ old('amount') }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                            placeholder="Masukkan nominal" />
                        <p id="amount-helper" class="mt-2 text-xs text-slate-400">Pastikan nominal sesuai ketentuan.</p>
                        @error('amount')
                            <p class="mt-2 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.simpanan') }}" class="rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
                        Batal
                    </a>
                    <button type="submit" id="saving-submit"
                        class="rounded-full bg-slate-900 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const memberSelect = document.getElementById('member_id');
        const trxSelect = document.getElementById('trx_type');
        const typeSelect = document.getElementById('saving_type_id');
        const amountInput = document.getElementById('amount');
        const helperText = document.getElementById('amount-helper');
        const submitButton = document.getElementById('saving-submit');

        const savingTypesData = @json($savingTypes);
        const savingTypes = savingTypesData.map(type => ({
            id: type.id,
            code: type.code,
            name: type.name,
        }));
        const savingTypeMap = savingTypes.reduce((acc, type) => {
            acc[String(type.id)] = type;
            return acc;
        }, {});
        const memberBalances = @json($memberBalances);
        const lockedAmounts = {
            POKOK: {{ (float) ($setting?->simpanan_pokok_amount ?? 0) }},
            WAJIB: {{ (float) ($setting?->simpanan_wajib_amount ?? 0) }},
        };

        const updateSavingTypeOptions = () => {
            const isWithdraw = trxSelect.value === 'TARIK';
            Array.from(typeSelect.options).forEach((option) => {
                const type = savingTypeMap[option.value];
                if (!type) {
                    return;
                }
                option.disabled = isWithdraw && type.code !== 'MANASUKA';
            });

            if (isWithdraw) {
                const manasuka = savingTypes.find((type) => type.code === 'MANASUKA');
                if (manasuka) {
                    typeSelect.value = String(manasuka.id);
                }
            }
        };

        const updateAmountState = () => {
            const type = savingTypeMap[typeSelect.value];
            const trxType = trxSelect.value;
            const memberId = memberSelect.value;
            const balance = memberBalances?.[memberId]?.[type?.code] ?? 0;

            let message = 'Pastikan nominal sesuai ketentuan.';
            let isValid = true;

            if (!memberId || !typeSelect.value) {
                isValid = false;
            }

            if (type?.code === 'POKOK' || type?.code === 'WAJIB') {
                const lockedAmount = lockedAmounts[type.code] ?? 0;
                amountInput.value = lockedAmount || '';
                amountInput.readOnly = true;

                if (lockedAmount <= 0) {
                    message = 'Nominal simpanan belum diatur pada pengaturan koperasi.';
                    isValid = false;
                }
            } else {
                amountInput.readOnly = false;
            }

            const amountValue = parseFloat(amountInput.value || 0);

            if (trxType === 'TARIK') {
                if (balance <= 0) {
                    message = 'Saldo simpanan belum tersedia untuk penarikan.';
                    isValid = false;
                } else if (amountValue > balance) {
                    message = `Nominal melebihi saldo. Maksimum Rp ${balance.toLocaleString('id-ID')}`;
                    isValid = false;
                }
            }

            if (!amountInput.readOnly && amountValue <= 0) {
                isValid = false;
            }

            helperText.textContent = message;
            submitButton.disabled = !isValid;
        };

        memberSelect.addEventListener('change', updateAmountState);
        trxSelect.addEventListener('change', () => {
            updateSavingTypeOptions();
            updateAmountState();
        });
        typeSelect.addEventListener('change', updateAmountState);
        amountInput.addEventListener('input', updateAmountState);

        updateSavingTypeOptions();
        updateAmountState();
    </script>
@endsection
