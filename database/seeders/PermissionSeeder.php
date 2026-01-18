<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        if (! class_exists(Role::class)) {
            $this->command?->error(
                'Spatie roles are unavailable. Install spatie/laravel-permission and run composer install before seeding.'
            );

            return;
        }

        $permissions = [
            'master.view',
            'master.manage',
            'simpanan.view',
            'simpanan.manage',
            'pinjaman.view',
            'pinjaman.manage',
            'kas.view',
            'kas.manage',
            'shu.view',
            'shu.manage',
            'laporan.view',
            'user.manage',
            'role.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $petugas = Role::firstOrCreate(['name' => 'Petugas', 'guard_name' => 'web']);
        $pembina = Role::firstOrCreate(['name' => 'Pembina', 'guard_name' => 'web']);

        $admin->syncPermissions($permissions);

        $petugasPermissions = collect($permissions)
            ->reject(fn ($permission) => in_array($permission, ['user.manage', 'role.manage'], true))
            ->values()
            ->all();
        $petugas->syncPermissions($petugasPermissions);

        $pembinaPermissions = collect($permissions)
            ->filter(fn ($permission) => str_ends_with($permission, '.view'))
            ->values()
            ->all();
        $pembina->syncPermissions($pembinaPermissions);
    }
}
