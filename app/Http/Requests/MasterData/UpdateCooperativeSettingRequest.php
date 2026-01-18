<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCooperativeSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('Admin') ?? false;
    }

    public function rules(): array
    {
        return [
            'cooperative_name' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'simpanan_pokok_amount' => ['required', 'numeric', 'min:0'],
            'simpanan_wajib_amount' => ['required', 'numeric', 'min:0'],
            'shu_cadangan_percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'shu_anggota_percent' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'cooperative_name.required' => 'Nama koperasi wajib diisi.',
            'school_name.required' => 'Nama sekolah wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'logo.image' => 'Logo koperasi harus berupa gambar.',
            'logo.max' => 'Ukuran logo maksimal 2MB.',
            'simpanan_pokok_amount.required' => 'Nominal simpanan pokok wajib diisi.',
            'simpanan_pokok_amount.numeric' => 'Nominal simpanan pokok harus berupa angka.',
            'simpanan_pokok_amount.min' => 'Nominal simpanan pokok tidak boleh negatif.',
            'simpanan_wajib_amount.required' => 'Nominal simpanan wajib wajib diisi.',
            'simpanan_wajib_amount.numeric' => 'Nominal simpanan wajib harus berupa angka.',
            'simpanan_wajib_amount.min' => 'Nominal simpanan wajib tidak boleh negatif.',
            'shu_cadangan_percent.required' => 'Persentase SHU Dana Cadangan wajib diisi.',
            'shu_cadangan_percent.numeric' => 'Persentase SHU Dana Cadangan harus berupa angka.',
            'shu_cadangan_percent.min' => 'Persentase SHU Dana Cadangan minimal 0.',
            'shu_cadangan_percent.max' => 'Persentase SHU Dana Cadangan maksimal 100.',
            'shu_anggota_percent.required' => 'Persentase SHU Anggota wajib diisi.',
            'shu_anggota_percent.numeric' => 'Persentase SHU Anggota harus berupa angka.',
            'shu_anggota_percent.min' => 'Persentase SHU Anggota minimal 0.',
            'shu_anggota_percent.max' => 'Persentase SHU Anggota maksimal 100.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $cadangan = (float) $this->input('shu_cadangan_percent', 0);
            $anggota = (float) $this->input('shu_anggota_percent', 0);

            if (round($cadangan + $anggota, 2) !== 100.00) {
                $validator->errors()->add(
                    'shu_cadangan_percent',
                    'Total persentase SHU Dana Cadangan dan SHU Anggota harus 100%.'
                );
            }
        });
    }
}
