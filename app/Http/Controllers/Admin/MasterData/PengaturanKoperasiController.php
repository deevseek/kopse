<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PengaturanKoperasiController extends Controller
{
    public function index(): View
    {
        return view('admin.master-data.pengaturan-koperasi.index');
    }
}
