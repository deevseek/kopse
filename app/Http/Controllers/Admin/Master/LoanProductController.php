<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreLoanProductRequest;
use App\Http\Requests\Master\UpdateLoanProductRequest;
use App\Models\LoanProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoanProductController extends Controller
{
    public function index(): View
    {
        $loanProducts = LoanProduct::query()
            ->orderBy('code')
            ->paginate(10);

        return view('admin.master.produk-pinjaman.index', compact('loanProducts'));
    }

    public function create(): View
    {
        return view('admin.master.produk-pinjaman.create');
    }

    public function store(StoreLoanProductRequest $request): RedirectResponse
    {
        LoanProduct::create($request->validated());

        return redirect()
            ->route('admin.master.produk-pinjaman.index')
            ->with('success', 'Produk pinjaman berhasil ditambahkan.');
    }

    public function edit(LoanProduct $loanProduct): View
    {
        return view('admin.master.produk-pinjaman.edit', compact('loanProduct'));
    }

    public function update(UpdateLoanProductRequest $request, LoanProduct $loanProduct): RedirectResponse
    {
        $loanProduct->update($request->validated());

        return redirect()
            ->route('admin.master.produk-pinjaman.index')
            ->with('success', 'Produk pinjaman berhasil diperbarui.');
    }

    public function destroy(LoanProduct $loanProduct): RedirectResponse
    {
        $loanProduct->delete();

        return redirect()
            ->route('admin.master.produk-pinjaman.index')
            ->with('success', 'Produk pinjaman berhasil dihapus.');
    }
}
