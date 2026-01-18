<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        if (! class_exists(Role::class)) {
            $this->command?->error(
                'Spatie roles are unavailable. Install spatie/laravel-permission and run composer install before seeding.'
            );

            return;
        }

        $roles = [
            'Admin',
            'Petugas',
            'Pembina',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin@koperasi.test'],
            [
                'name' => 'Admin Koperasi',
                'password' => Hash::make('password'),
                'status' => 'AKTIF',
            ]
        );

        $admin->syncRoles(['Admin']);
    }
}
