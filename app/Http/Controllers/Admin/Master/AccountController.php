<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreAccountRequest;
use App\Http\Requests\Master\UpdateAccountRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        $accounts = Account::query()
            ->orderBy('code')
            ->paginate(10);

        return view('admin.master.akun.index', compact('accounts'));
    }

    public function create(): View
    {
        return view('admin.master.akun.create');
    }

    public function store(StoreAccountRequest $request): RedirectResponse
    {
        Account::create($request->validated());

        return redirect()
            ->route('admin.master.akun.index')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit(Account $account): View
    {
        return view('admin.master.akun.edit', compact('account'));
    }

    public function update(UpdateAccountRequest $request, Account $account): RedirectResponse
    {
        $account->update($request->validated());

        return redirect()
            ->route('admin.master.akun.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(Account $account): RedirectResponse
    {
        $account->delete();

        return redirect()
            ->route('admin.master.akun.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
