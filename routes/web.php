<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DanaCadanganController;
use App\Http\Controllers\Admin\KasController;
use App\Http\Controllers\Admin\KeamananSistemController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PinjamanController;
use App\Http\Controllers\Admin\ShuController;
use App\Http\Controllers\Admin\SimpananController;
use App\Http\Controllers\Admin\MasterData\AnggotaController;
use App\Http\Controllers\Admin\MasterData\CoaController;
use App\Http\Controllers\Admin\MasterData\JenisSimpananController;
use App\Http\Controllers\Admin\MasterData\PengaturanKoperasiController;
use App\Http\Controllers\Admin\MasterData\PenggunaController;
use App\Http\Controllers\Admin\MasterData\PeriodeController;
use App\Http\Controllers\Admin\MasterData\ProdukPinjamanController;
use App\Http\Controllers\Admin\MasterData\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'role:Admin|Petugas|Pembina'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin|Petugas'])->group(function () {
    Route::get('/master-data/anggota', [AnggotaController::class, 'index'])->name('admin.master-data.anggota');
    Route::get('/master-data/pengguna', [PenggunaController::class, 'index'])->name('admin.master-data.pengguna');
    Route::get('/master-data/roles', [RoleController::class, 'index'])->name('admin.master-data.roles');
    Route::get('/master-data/jenis-simpanan', [JenisSimpananController::class, 'index'])->name('admin.master-data.jenis-simpanan');
    Route::get('/master-data/produk-pinjaman', [ProdukPinjamanController::class, 'index'])->name('admin.master-data.produk-pinjaman');
    Route::get('/master-data/coa', [CoaController::class, 'index'])->name('admin.master-data.coa');
    Route::get('/master-data/periode', [PeriodeController::class, 'index'])->name('admin.master-data.periode');
    Route::get('/master-data/pengaturan-koperasi', [PengaturanKoperasiController::class, 'index'])->name('admin.master-data.pengaturan-koperasi');

    Route::get('/simpanan', [SimpananController::class, 'index'])->name('admin.simpanan');
    Route::get('/pinjaman', [PinjamanController::class, 'index'])->name('admin.pinjaman');
    Route::get('/kas', [KasController::class, 'index'])->name('admin.kas');
    Route::get('/shu', [ShuController::class, 'index'])->name('admin.shu');
    Route::get('/dana-cadangan', [DanaCadanganController::class, 'index'])->name('admin.dana-cadangan');
    Route::get('/keamanan', [KeamananSistemController::class, 'index'])->name('admin.keamanan');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin|Petugas|Pembina'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
});

require __DIR__.'/auth.php';
