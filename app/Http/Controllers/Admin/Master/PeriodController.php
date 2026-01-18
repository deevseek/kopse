<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StorePeriodRequest;
use App\Http\Requests\Master\UpdatePeriodRequest;
use App\Models\Period;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PeriodController extends Controller
{
    public function index(): View
    {
        $periods = Period::query()
            ->orderByDesc('start_date')
            ->paginate(10);

        return view('admin.master.periode.index', compact('periods'));
    }

    public function create(): View
    {
        return view('admin.master.periode.create');
    }

    public function store(StorePeriodRequest $request): RedirectResponse
    {
        Period::create($request->validated());

        return redirect()
            ->route('admin.master.periode.index')
            ->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit(Period $period): RedirectResponse|View
    {
        if ($period->is_closed) {
            return redirect()
                ->route('admin.master.periode.index')
                ->with('error', 'Periode yang sudah ditutup tidak dapat diubah.');
        }

        return view('admin.master.periode.edit', compact('period'));
    }

    public function update(UpdatePeriodRequest $request, Period $period): RedirectResponse
    {
        $period->update($request->validated());

        return redirect()
            ->route('admin.master.periode.index')
            ->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy(Period $period): RedirectResponse
    {
        if ($period->is_closed) {
            return redirect()
                ->route('admin.master.periode.index')
                ->with('error', 'Periode yang sudah ditutup tidak dapat dihapus.');
        }

        $period->delete();

        return redirect()
            ->route('admin.master.periode.index')
            ->with('success', 'Periode berhasil dihapus.');
    }
}
