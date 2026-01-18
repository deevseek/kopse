<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PeriodeController extends Controller
{
    public function index(): View
    {
        return view('admin.master-data.periode.index');
    }
}
