<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSavingTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $savingType = $this->route('savingType');

        return [
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('saving_types', 'code')->ignore($savingType?->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'is_withdrawable' => ['required', 'boolean'],
            'is_periodic' => ['required', 'boolean'],
            'default_amount' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode jenis simpanan wajib diisi.',
            'code.unique' => 'Kode jenis simpanan sudah digunakan.',
            'name.required' => 'Nama jenis simpanan wajib diisi.',
            'is_withdrawable.required' => 'Status penarikan wajib dipilih.',
            'is_periodic.required' => 'Status periodik wajib dipilih.',
            'default_amount.numeric' => 'Nominal default harus berupa angka.',
            'default_amount.min' => 'Nominal default tidak boleh negatif.',
            'is_active.required' => 'Status aktif wajib dipilih.',
        ];
    }
}
