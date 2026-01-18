<?php

namespace Database\Seeders;

use App\Models\CooperativeSetting;
use Illuminate\Database\Seeder;

class CooperativeSettingSeeder extends Seeder
{
    public function run(): void
    {
        CooperativeSetting::query()->firstOrCreate([], [
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
