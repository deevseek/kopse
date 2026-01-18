<?php

namespace Database\Seeders;

use App\Models\SavingType;
use Illuminate\Database\Seeder;

class SavingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'code' => 'POKOK',
                'name' => 'Simpanan Pokok',
                'is_withdrawable' => false,
                'is_periodic' => false,
                'default_amount' => null,
                'is_active' => true,
            ],
            [
                'code' => 'WAJIB',
                'name' => 'Simpanan Wajib',
                'is_withdrawable' => false,
                'is_periodic' => true,
                'default_amount' => null,
                'is_active' => true,
            ],
            [
                'code' => 'MANASUKA',
                'name' => 'Simpanan Manasuka',
                'is_withdrawable' => true,
                'is_periodic' => false,
                'default_amount' => null,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            SavingType::updateOrCreate(
                ['code' => $item['code']],
                $item,
            );
        }
    }
}
