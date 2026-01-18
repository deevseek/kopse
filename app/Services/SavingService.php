<?php

namespace App\Services;

use App\Models\CooperativeSetting;
use App\Models\Member;
use App\Models\SavingType;
use App\Models\SavingsAccount;
use App\Models\SavingsTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SavingService
{
    public function deposit(Member $member, SavingType $savingType, float $amount): SavingsTransaction
    {
        return DB::transaction(function () use ($member, $savingType, $amount) {
            $setting = CooperativeSetting::query()->first();

            if (! $setting) {
                throw ValidationException::withMessages([
                    'amount' => 'Pengaturan koperasi belum tersedia.',
                ]);
            }

            $amount = $this->resolveAmount($savingType, $amount, $setting);

            $account = SavingsAccount::query()
                ->where('member_id', $member->id)
                ->where('saving_type_id', $savingType->id)
                ->lockForUpdate()
                ->first();

            if (! $account) {
                $account = SavingsAccount::create([
                    'member_id' => $member->id,
                    'saving_type_id' => $savingType->id,
                    'balance' => 0,
                ]);
                $account = SavingsAccount::query()->whereKey($account->id)->lockForUpdate()->first();
            }

            if ($savingType->code === 'POKOK') {
                $hasDeposit = $account->transactions()->where('trx_type', 'SETOR')->exists();
                if ($hasDeposit) {
                    throw ValidationException::withMessages([
                        'amount' => 'Simpanan pokok hanya sekali seumur hidup anggota.',
                    ]);
                }
            }

            $account->balance = $account->balance + $amount;
            $account->save();

            return SavingsTransaction::create([
                'savings_account_id' => $account->id,
                'trx_type' => 'SETOR',
                'amount' => $amount,
                'trx_date' => now(),
                'ref_no' => $this->generateRef(),
                'description' => null,
                'created_by' => Auth::id(),
            ]);
        });
    }

    public function withdraw(Member $member, SavingType $savingType, float $amount): SavingsTransaction
    {
        return DB::transaction(function () use ($member, $savingType, $amount) {
            if (! $savingType->is_withdrawable || $savingType->code !== 'MANASUKA') {
                throw ValidationException::withMessages([
                    'amount' => 'Jenis simpanan ini tidak bisa ditarik.',
                ]);
            }

            $account = SavingsAccount::query()
                ->where('member_id', $member->id)
                ->where('saving_type_id', $savingType->id)
                ->lockForUpdate()
                ->first();

            if (! $account) {
                throw ValidationException::withMessages([
                    'amount' => 'Belum ada saldo simpanan manasuka.',
                ]);
            }

            if ($amount <= 0) {
                throw ValidationException::withMessages([
                    'amount' => 'Nominal penarikan tidak valid.',
                ]);
            }

            if ($amount > $account->balance) {
                throw ValidationException::withMessages([
                    'amount' => 'Saldo simpanan manasuka tidak mencukupi.',
                ]);
            }

            $account->balance = $account->balance - $amount;
            $account->save();

            return SavingsTransaction::create([
                'savings_account_id' => $account->id,
                'trx_type' => 'TARIK',
                'amount' => $amount,
                'trx_date' => now(),
                'ref_no' => $this->generateRef(),
                'description' => null,
                'created_by' => Auth::id(),
            ]);
        });
    }

    private function resolveAmount(SavingType $savingType, float $amount, CooperativeSetting $setting): float
    {
        if ($savingType->code === 'POKOK') {
            $amount = (float) $setting->simpanan_pokok_amount;
        } elseif ($savingType->code === 'WAJIB') {
            $amount = (float) $setting->simpanan_wajib_amount;
        }

        if ($amount <= 0) {
            throw ValidationException::withMessages([
                'amount' => 'Nominal simpanan tidak valid.',
            ]);
        }

        return $amount;
    }

    private function generateRef(): string
    {
        $year = now()->year;
        $lastRef = SavingsTransaction::query()
            ->where('ref_no', 'like', "SAV/{$year}/%")
            ->orderByDesc('ref_no')
            ->value('ref_no');

        $sequence = 1;
        if ($lastRef) {
            $parts = explode('/', $lastRef);
            $sequence = (int) end($parts) + 1;
        }

        return sprintf('SAV/%s/%06d', $year, $sequence);
    }
}
