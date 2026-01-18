@extends('layouts.admin')

@section('title', 'Detail Simpanan')
@section('subtitle', 'Riwayat dan transaksi simpanan anggota')

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
        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-1">
                <p class="text-sm text-slate-500">Anggota</p>
                <h2 class="text-lg font-semibold text-slate-900">{{ $member->name }}</h2>
                <p class="text-xs text-slate-400">No Anggota: {{ $member->member_no }}</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach (['POKOK' => 'Simpanan Pokok', 'WAJIB' => 'Simpanan Wajib', 'MANASUKA' => 'Simpanan Manasuka'] as $code => $label)
                @php
                    $type = $savingTypes->get($code);
                    $account = $type ? $accounts->get($type->id) : null;
                    $balance = $account?->balance ?? 0;
                    $transactions = $account?->transactions ?? collect();
                    $hasPokokDeposit = $code === 'POKOK' ? $transactions->where('trx_type', 'SETOR')->count() > 0 : false;
                    $pokokAmount = (float) ($setting?->simpanan_pokok_amount ?? 0);
                    $wajibAmount = (float) ($setting?->simpanan_wajib_amount ?? 0);
                    $lockedAmount = $code === 'POKOK' ? $pokokAmount : ($code === 'WAJIB' ? $wajibAmount : '');
                    $isLocked = $code === 'POKOK' || $code === 'WAJIB';
                    $isLockedAmountValid = $isLocked ? $lockedAmount > 0 : true;
                @endphp
                <div class="flex flex-col gap-4 rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                    <div class="space-y-1">
                        <p class="text-sm text-slate-500">{{ $label }}</p>
                        <p class="text-2xl font-semibold text-slate-900">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                    </div>

                    @hasanyrole('Admin|Petugas')
                        <div class="flex flex-wrap gap-2">
                            @if ($type)
                                <button type="button"
                                    class="open-saving-modal inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800 disabled:cursor-not-allowed disabled:bg-slate-300"
                                    data-action="{{ route('admin.simpanan.deposit', $member) }}"
                                    data-title="Setor {{ $label }}"
                                    data-type-id="{{ $type->id }}"
                                    data-type-code="{{ $type->code }}"
                                    data-amount="{{ $lockedAmount }}"
                                    data-locked="{{ $isLocked ? 'true' : 'false' }}"
                                    data-kind="SETOR"
                                    data-max=""
                                    @if (($code === 'POKOK' && $hasPokokDeposit) || ! $isLockedAmountValid) disabled @endif>
                                    Setor
                                </button>
                                @if ($code === 'MANASUKA')
                                    <button type="button"
                                        class="open-saving-modal inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 transition hover:border-slate-300 hover:text-slate-900 disabled:cursor-not-allowed disabled:border-slate-200 disabled:text-slate-300"
                                        data-action="{{ route('admin.simpanan.withdraw', $member) }}"
                                        data-title="Tarik {{ $label }}"
                                        data-type-id="{{ $type->id }}"
                                        data-type-code="{{ $type->code }}"
                                        data-amount=""
                                        data-locked="false"
                                        data-kind="TARIK"
                                        data-max="{{ $balance }}"
                                        @if ($balance <= 0) disabled @endif>
                                        Tarik
                                    </button>
                                @endif
                            @endif
                        </div>
                        @if ($code === 'POKOK' && $hasPokokDeposit)
                            <p class="text-xs text-slate-400">Simpanan pokok sudah disetor sekali.</p>
                        @elseif ($isLocked && ! $isLockedAmountValid)
                            <p class="text-xs text-rose-500">Nominal simpanan belum diatur pada pengaturan koperasi.</p>
                        @endif
                    @else
                        <span class="text-xs text-slate-400">Hanya baca</span>
                    @endhasanyrole

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Riwayat Transaksi</p>
                        <div class="mt-3 space-y-2">
                            @forelse ($transactions as $transaction)
                                <div class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3 text-sm">
                                    <div>
                                        <p class="font-semibold text-slate-800">{{ $transaction->ref_no }}</p>
                                        <p class="text-xs text-slate-400">{{ $transaction->trx_date->format('d M Y H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $transaction->trx_type === 'SETOR' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $transaction->trx_type }}
                                        </span>
                                        <p class="mt-1 font-semibold text-slate-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-slate-400">Belum ada transaksi.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="saving-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 px-4 py-6">
        <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-400">Transaksi Simpanan</p>
                    <h3 id="saving-modal-title" class="text-lg font-semibold text-slate-900">Setor Simpanan</h3>
                </div>
                <button type="button" id="saving-modal-close" class="text-slate-400 transition hover:text-slate-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6l-12 12" />
                    </svg>
                </button>
            </div>

            <form id="saving-modal-form" method="POST" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="saving_type_id" id="saving-type-id">
                <div class="space-y-2">
                    <label for="saving-amount" class="text-sm font-semibold text-slate-700">Nominal</label>
                    <input id="saving-amount" name="amount" type="number" min="1" step="1"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-slate-400 focus:outline-none"
                        placeholder="Masukkan nominal">
                    <p id="saving-helper" class="text-xs text-slate-400">Pastikan nominal sesuai ketentuan.</p>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" id="saving-modal-cancel"
                        class="rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">
                        Batal
                    </button>
                    <button type="submit" id="saving-modal-submit"
                        class="rounded-full bg-slate-900 px-5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('saving-modal');
        const modalTitle = document.getElementById('saving-modal-title');
        const modalForm = document.getElementById('saving-modal-form');
        const modalClose = document.getElementById('saving-modal-close');
        const modalCancel = document.getElementById('saving-modal-cancel');
        const amountInput = document.getElementById('saving-amount');
        const savingTypeInput = document.getElementById('saving-type-id');
        const helperText = document.getElementById('saving-helper');
        const submitButton = document.getElementById('saving-modal-submit');

        const openButtons = document.querySelectorAll('.open-saving-modal');

        const openModal = (button) => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalTitle.textContent = button.dataset.title;
            modalForm.action = button.dataset.action;
            savingTypeInput.value = button.dataset.typeId;
            amountInput.value = button.dataset.amount || '';
            amountInput.readOnly = button.dataset.locked === 'true';
            amountInput.dataset.max = button.dataset.max || '';
            amountInput.dataset.kind = button.dataset.kind;
            amountInput.focus();
            validateAmount();
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modalForm.reset();
            helperText.textContent = 'Pastikan nominal sesuai ketentuan.';
            submitButton.disabled = false;
        };

        const validateAmount = () => {
            const value = parseFloat(amountInput.value || 0);
            const max = parseFloat(amountInput.dataset.max || 0);
            const kind = amountInput.dataset.kind;

            let message = 'Pastikan nominal sesuai ketentuan.';
            let isValid = value > 0;

            if (kind === 'TARIK' && max > 0 && value > max) {
                message = `Nominal melebihi saldo. Maksimum Rp ${max.toLocaleString('id-ID')}`;
                isValid = false;
            }

            helperText.textContent = message;
            submitButton.disabled = !isValid;
        };

        openButtons.forEach((button) => {
            button.addEventListener('click', () => openModal(button));
        });

        [modalClose, modalCancel].forEach((button) => {
            button.addEventListener('click', closeModal);
        });

        amountInput.addEventListener('input', validateAmount);

        modalForm.addEventListener('submit', (event) => {
            const actionText = modalTitle.textContent || 'transaksi';
            if (! confirm(`Konfirmasi ${actionText.toLowerCase()}?`)) {
                event.preventDefault();
            }
        });
    </script>
@endsection
