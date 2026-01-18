<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'member_type' => ['required', 'in:SISWA,GURU,KARYAWAN'],
            'class_name' => ['required_if:member_type,SISWA', 'prohibited_unless:member_type,SISWA', 'nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:L,P'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'join_date' => ['required', 'date'],
            'status' => ['required', 'in:AKTIF,KELUAR,LULUS'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama anggota wajib diisi.',
            'name.max' => 'Nama anggota maksimal 255 karakter.',
            'member_type.required' => 'Tipe anggota wajib dipilih.',
            'member_type.in' => 'Tipe anggota tidak valid.',
            'class_name.required_if' => 'Kelas wajib diisi untuk anggota siswa.',
            'class_name.prohibited_unless' => 'Kelas hanya boleh diisi untuk anggota siswa.',
            'class_name.max' => 'Kelas maksimal 255 karakter.',
            'gender.in' => 'Jenis kelamin tidak valid.',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'join_date.required' => 'Tanggal bergabung wajib diisi.',
            'join_date.date' => 'Tanggal bergabung tidak valid.',
            'status.required' => 'Status anggota wajib dipilih.',
            'status.in' => 'Status anggota tidak valid.',
        ];
    }
}
