<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLoanProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:20', Rule::unique('loan_products', 'code')],
            'name' => ['required', 'string', 'max:255'],
            'max_principal' => ['required', 'numeric', 'min:0'],
            'max_tenor_months' => ['required', 'integer', 'min:1'],
            'interest_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'admin_fee' => ['required', 'numeric', 'min:0'],
            'penalty_per_day' => ['required', 'numeric', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode produk pinjaman wajib diisi.',
            'code.unique' => 'Kode produk pinjaman sudah digunakan.',
            'name.required' => 'Nama produk pinjaman wajib diisi.',
            'max_principal.required' => 'Maksimum pokok wajib diisi.',
            'max_principal.numeric' => 'Maksimum pokok harus berupa angka.',
            'max_tenor_months.required' => 'Maksimum tenor wajib diisi.',
            'max_tenor_months.integer' => 'Maksimum tenor harus berupa angka bulat.',
            'interest_rate.required' => 'Suku bunga wajib diisi.',
            'interest_rate.numeric' => 'Suku bunga harus berupa angka.',
            'interest_rate.max' => 'Suku bunga tidak boleh lebih dari 100%.',
            'admin_fee.required' => 'Biaya administrasi wajib diisi.',
            'admin_fee.numeric' => 'Biaya administrasi harus berupa angka.',
            'penalty_per_day.required' => 'Denda per hari wajib diisi.',
            'penalty_per_day.numeric' => 'Denda per hari harus berupa angka.',
            'is_active.required' => 'Status aktif wajib dipilih.',
        ];
    }
}
