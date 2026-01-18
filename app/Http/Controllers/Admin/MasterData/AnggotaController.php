<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AnggotaController extends Controller
{
    public function index(): View
    {
        return view('admin.master-data.anggota.index');
    }
}
