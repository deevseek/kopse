<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CooperativeSetting;
use App\Models\Member;
use App\Models\SavingType;
use App\Models\SavingsAccount;
use App\Services\SavingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SavingController extends Controller
{
    public function index(): View
    {
        $savingTypes = SavingType::query()
            ->whereIn('code', ['POKOK', 'WAJIB', 'MANASUKA'])
            ->get()
            ->keyBy('code');

        $members = Member::query()
            ->with(['savingsAccounts' => function ($query) {
                $query->with('savingType');
            }])
            ->orderBy('name')
            ->get();

        return view('admin.simpanan.index', [
            'members' => $members,
            'savingTypes' => $savingTypes,
        ]);
    }

    public function show(Member $member): View
    {
        $savingTypes = SavingType::query()
            ->whereIn('code', ['POKOK', 'WAJIB', 'MANASUKA'])
            ->get()
            ->keyBy('code');

        $accounts = SavingsAccount::query()
            ->with(['savingType', 'transactions' => function ($query) {
                $query->latest('trx_date');
            }])
            ->where('member_id', $member->id)
            ->get()
            ->keyBy('saving_type_id');

        $setting = CooperativeSetting::query()->first();

        return view('admin.simpanan.show', [
            'member' => $member,
            'savingTypes' => $savingTypes,
            'accounts' => $accounts,
            'setting' => $setting,
        ]);
    }

    public function storeDeposit(Request $request, Member $member, SavingService $savingService): RedirectResponse
    {
        $data = $request->validate([
            'saving_type_id' => ['required', 'exists:saving_types,id'],
            'amount' => ['nullable', 'numeric', 'min:1'],
        ]);

        $savingType = SavingType::query()->findOrFail($data['saving_type_id']);
        $amount = (float) ($data['amount'] ?? 0);

        $savingService->deposit($member, $savingType, $amount);

        return redirect()
            ->route('admin.simpanan.show', $member)
            ->with('success', 'Transaksi setoran berhasil disimpan.');
    }

    public function storeWithdraw(Request $request, Member $member, SavingService $savingService): RedirectResponse
    {
        $data = $request->validate([
            'saving_type_id' => ['required', 'exists:saving_types,id'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $savingType = SavingType::query()->findOrFail($data['saving_type_id']);
        $amount = (float) $data['amount'];

        $savingService->withdraw($member, $savingType, $amount);

        return redirect()
            ->route('admin.simpanan.show', $member)
            ->with('success', 'Penarikan simpanan berhasil diproses.');
    }
}
