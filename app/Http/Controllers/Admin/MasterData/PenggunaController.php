<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\StoreUserRequest;
use App\Http\Requests\MasterData\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->orderBy('name')->get();

        return view('admin.master.pengguna.index', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.master.pengguna.create', [
            'roles' => $roles,
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'password' => Hash::make($request->string('password')),
            'status' => $request->string('status'),
        ]);

        $user->syncRoles([$request->string('role')]);

        return redirect()
            ->route('admin.master.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.master.pengguna.edit', [
            'user' => $user->load('roles'),
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $payload = [
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'status' => $request->string('status'),
        ];

        if ($request->filled('password')) {
            $payload['password'] = Hash::make($request->string('password'));
        }

        $user->update($payload);
        $user->syncRoles([$request->string('role')]);

        return redirect()
            ->route('admin.master.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.master.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
