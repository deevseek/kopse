<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnggotaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Member::query();

        if ($search = $request->get('search')) {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('member_no', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($memberType = $request->get('member_type')) {
            $query->where('member_type', $memberType);
        }

        $members = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin.master-data.anggota.index', [
            'members' => $members,
        ]);
    }

    public function create(): View
    {
        return view('admin.master-data.anggota.create');
    }

    public function store(StoreMemberRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($data['member_type'] !== 'SISWA') {
            $data['class_name'] = null;
        }

        Member::create($data);

        return redirect()
            ->route('admin.master-data.anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show(Member $member): View
    {
        return view('admin.master-data.anggota.show', [
            'member' => $member,
        ]);
    }

    public function edit(Member $member): View
    {
        return view('admin.master-data.anggota.edit', [
            'member' => $member,
        ]);
    }

    public function update(UpdateMemberRequest $request, Member $member): RedirectResponse
    {
        $data = $request->validated();

        if ($data['member_type'] !== 'SISWA') {
            $data['class_name'] = null;
        }

        $member->update($data);

        return redirect()
            ->route('admin.master-data.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        if ($member->status !== 'AKTIF') {
            return back()->with('error', 'Anggota dengan status keluar atau lulus tidak bisa dihapus.');
        }

        $member->delete();

        return redirect()
            ->route('admin.master-data.anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}
