<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateCooperativeSettingRequest;
use App\Models\CooperativeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CooperativeSettingController extends Controller
{
    public function edit(): View
    {
        $setting = $this->getSetting();
        $isReadOnly = ! auth()->user()->hasRole('Admin');

        return view('admin.master-data.pengaturan-koperasi.edit', [
            'setting' => $setting,
            'isReadOnly' => $isReadOnly,
            'logoUrl' => $setting->logo_path ? Storage::url($setting->logo_path) : null,
        ]);
    }

    public function update(UpdateCooperativeSettingRequest $request): RedirectResponse
    {
        $setting = $this->getSetting();
        $data = Arr::except($request->validated(), ['logo']);

        if ($request->hasFile('logo')) {
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }

            $data['logo_path'] = $request->file('logo')->store('cooperative-logos', 'public');
        }

        $setting->update($data);

        return redirect()
            ->route('admin.master.pengaturan-koperasi.edit')
            ->with('success', 'Pengaturan koperasi berhasil diperbarui.');
    }

    private function getSetting(): CooperativeSetting
    {
        return CooperativeSetting::query()->firstOrCreate([], [
            'cooperative_name' => 'Koperasi Sekolah',
            'school_name' => 'Nama Sekolah',
            'address' => null,
            'phone' => null,
            'logo_path' => null,
            'simpanan_pokok_amount' => 50000,
            'simpanan_wajib_amount' => 10000,
            'shu_cadangan_percent' => 40,
            'shu_anggota_percent' => 60,
        ]);
    }
}
