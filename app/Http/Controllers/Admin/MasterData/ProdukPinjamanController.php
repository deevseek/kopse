<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProdukPinjamanController extends Controller
{
    public function index(): View
    {
        return view('admin.master-data.produk-pinjaman.index');
    }
}
