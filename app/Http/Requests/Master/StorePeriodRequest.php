<?php

namespace App\Http\Requests\Master;

use App\Models\Period;
use Illuminate\Foundation\Http\FormRequest;

class StorePeriodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'year' => ['required', 'string', 'max:20'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_active' => ['required', 'boolean'],
            'is_closed' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'year.required' => 'Tahun buku wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Tanggal mulai tidak valid.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.date' => 'Tanggal selesai tidak valid.',
            'end_date.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'is_active.required' => 'Status aktif wajib dipilih.',
            'is_closed.required' => 'Status tutup wajib dipilih.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->boolean('is_active')) {
                $hasActive = Period::query()->where('is_active', true)->exists();

                if ($hasActive) {
                    $validator->errors()->add('is_active', 'Hanya satu periode yang boleh aktif.');
                }
            }
        });
    }
}
