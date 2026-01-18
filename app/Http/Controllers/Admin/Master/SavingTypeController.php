<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreSavingTypeRequest;
use App\Http\Requests\Master\UpdateSavingTypeRequest;
use App\Models\SavingType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SavingTypeController extends Controller
{
    public function index(): View
    {
        $savingTypes = SavingType::query()
            ->orderBy('code')
            ->paginate(10);

        return view('admin.master.jenis-simpanan.index', compact('savingTypes'));
    }

    public function create(): View
    {
        return view('admin.master.jenis-simpanan.create');
    }

    public function store(StoreSavingTypeRequest $request): RedirectResponse
    {
        SavingType::create($request->validated());

        return redirect()
            ->route('admin.master.jenis-simpanan.index')
            ->with('success', 'Jenis simpanan berhasil ditambahkan.');
    }

    public function edit(SavingType $savingType): View
    {
        return view('admin.master.jenis-simpanan.edit', compact('savingType'));
    }

    public function update(UpdateSavingTypeRequest $request, SavingType $savingType): RedirectResponse
    {
        $savingType->update($request->validated());

        return redirect()
            ->route('admin.master.jenis-simpanan.index')
            ->with('success', 'Jenis simpanan berhasil diperbarui.');
    }

    public function destroy(SavingType $savingType): RedirectResponse
    {
        $savingType->delete();

        return redirect()
            ->route('admin.master.jenis-simpanan.index')
            ->with('success', 'Jenis simpanan berhasil dihapus.');
    }
}
