<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CoaController extends Controller
{
    public function index(): View
    {
        return view('admin.master-data.coa.index');
    }
}
