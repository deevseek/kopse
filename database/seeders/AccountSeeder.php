<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['code' => '101', 'name' => 'Kas', 'type' => 'ASET', 'is_active' => true],
            ['code' => '102', 'name' => 'Piutang Pinjaman', 'type' => 'ASET', 'is_active' => true],
            ['code' => '201', 'name' => 'Simpanan Manasuka', 'type' => 'KEWAJIBAN', 'is_active' => true],
            ['code' => '301', 'name' => 'Simpanan Pokok', 'type' => 'MODAL', 'is_active' => true],
            ['code' => '302', 'name' => 'Simpanan Wajib', 'type' => 'MODAL', 'is_active' => true],
            ['code' => '303', 'name' => 'Dana Cadangan', 'type' => 'MODAL', 'is_active' => true],
            ['code' => '304', 'name' => 'SHU Ditahan', 'type' => 'MODAL', 'is_active' => true],
            ['code' => '401', 'name' => 'Jasa Pinjaman', 'type' => 'PENDAPATAN', 'is_active' => true],
            ['code' => '402', 'name' => 'Denda', 'type' => 'PENDAPATAN', 'is_active' => true],
            ['code' => '501', 'name' => 'Biaya Operasional', 'type' => 'BIAYA', 'is_active' => true],
        ];

        foreach ($items as $item) {
            Account::updateOrCreate(
                ['code' => $item['code']],
                $item,
            );
        }
    }
}
