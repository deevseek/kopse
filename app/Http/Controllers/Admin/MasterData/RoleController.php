<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateRolePermissionsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with('permissions')->orderBy('name')->get();

        return view('admin.master.role.index', [
            'roles' => $roles,
        ]);
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::orderBy('name')->get();
        $groupedPermissions = $this->groupPermissions($permissions);

        return view('admin.master.role.edit', [
            'role' => $role->load('permissions'),
            'groupedPermissions' => $groupedPermissions,
        ]);
    }

    public function update(UpdateRolePermissionsRequest $request, Role $role): RedirectResponse
    {
        $role->syncPermissions($request->input('permissions', []));

        return redirect()
            ->route('admin.master.role.index')
            ->with('success', 'Hak akses role berhasil diperbarui.');
    }

    /**
     * @param \Illuminate\Support\Collection<int, \Spatie\Permission\Models\Permission> $permissions
     * @return array<string, \Illuminate\Support\Collection<int, \Spatie\Permission\Models\Permission>>
     */
    private function groupPermissions($permissions): array
    {
        $groups = [
            'MASTER DATA' => ['master.view', 'master.manage'],
            'SIMPANAN' => ['simpanan.view', 'simpanan.manage'],
            'PINJAMAN' => ['pinjaman.view', 'pinjaman.manage'],
            'KAS' => ['kas.view', 'kas.manage'],
            'SHU' => ['shu.view', 'shu.manage'],
            'LAPORAN' => ['laporan.view'],
            'SYSTEM' => ['user.manage', 'role.manage'],
        ];

        return collect($groups)->map(function (array $permissionNames) use ($permissions) {
            return $permissions->whereIn('name', $permissionNames);
        })->all();
    }
}
