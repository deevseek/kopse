<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DanaCadanganController;
use App\Http\Controllers\Admin\KasController;
use App\Http\Controllers\Admin\KeamananSistemController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SavingController;
use App\Http\Controllers\Admin\Master\AccountController;
use App\Http\Controllers\Admin\Master\LoanProductController;
use App\Http\Controllers\Admin\Master\PeriodController as MasterPeriodController;
use App\Http\Controllers\Admin\Master\SavingTypeController;
use App\Http\Controllers\Admin\PinjamanController;
use App\Http\Controllers\Admin\ShuController;
use App\Http\Controllers\Admin\MasterData\AnggotaController;
use App\Http\Controllers\Admin\MasterData\CoaController;
use App\Http\Controllers\Admin\MasterData\CooperativeSettingController;
use App\Http\Controllers\Admin\MasterData\JenisSimpananController;
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
    Route::resource('/master-data/anggota', AnggotaController::class)
        ->except(['index', 'show'])
        ->names('admin.master-data.anggota');
    Route::get('/master-data/jenis-simpanan', [JenisSimpananController::class, 'index'])->name('admin.master-data.jenis-simpanan');
    Route::get('/master-data/produk-pinjaman', [ProdukPinjamanController::class, 'index'])->name('admin.master-data.produk-pinjaman');
    Route::get('/master-data/coa', [CoaController::class, 'index'])->name('admin.master-data.coa');
    Route::get('/master-data/periode', [PeriodeController::class, 'index'])->name('admin.master-data.periode');
    Route::get('/pinjaman', [PinjamanController::class, 'index'])->name('admin.pinjaman');
    Route::get('/kas', [KasController::class, 'index'])->name('admin.kas');
    Route::get('/shu', [ShuController::class, 'index'])->name('admin.shu');
    Route::get('/dana-cadangan', [DanaCadanganController::class, 'index'])->name('admin.dana-cadangan');
    Route::get('/keamanan', [KeamananSistemController::class, 'index'])->name('admin.keamanan');
});

Route::prefix('admin/master')->middleware(['auth', 'role:Admin|Petugas|Pembina'])->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('admin.master.pengguna.index');
    Route::get('/role', [RoleController::class, 'index'])->name('admin.master.role.index');
    Route::get('/jenis-simpanan', [SavingTypeController::class, 'index'])->name('admin.master.jenis-simpanan.index');
    Route::get('/produk-pinjaman', [LoanProductController::class, 'index'])->name('admin.master.produk-pinjaman.index');
    Route::get('/akun', [AccountController::class, 'index'])->name('admin.master.akun.index');
    Route::get('/periode', [MasterPeriodController::class, 'index'])->name('admin.master.periode.index');
    Route::get('/pengaturan-koperasi', [CooperativeSettingController::class, 'edit'])
        ->name('admin.master.pengaturan-koperasi.edit');
});

Route::prefix('admin/master')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('admin.master.pengguna.create');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('admin.master.pengguna.store');
    Route::get('/pengguna/{user}/edit', [PenggunaController::class, 'edit'])->name('admin.master.pengguna.edit');
    Route::put('/pengguna/{user}', [PenggunaController::class, 'update'])->name('admin.master.pengguna.update');
    Route::delete('/pengguna/{user}', [PenggunaController::class, 'destroy'])->name('admin.master.pengguna.destroy');
    Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name('admin.master.role.edit');
    Route::put('/role/{role}', [RoleController::class, 'update'])->name('admin.master.role.update');

    Route::get('/jenis-simpanan/create', [SavingTypeController::class, 'create'])->name('admin.master.jenis-simpanan.create');
    Route::post('/jenis-simpanan', [SavingTypeController::class, 'store'])->name('admin.master.jenis-simpanan.store');
    Route::get('/jenis-simpanan/{savingType}/edit', [SavingTypeController::class, 'edit'])->name('admin.master.jenis-simpanan.edit');
    Route::put('/jenis-simpanan/{savingType}', [SavingTypeController::class, 'update'])->name('admin.master.jenis-simpanan.update');
    Route::delete('/jenis-simpanan/{savingType}', [SavingTypeController::class, 'destroy'])->name('admin.master.jenis-simpanan.destroy');

    Route::get('/produk-pinjaman/create', [LoanProductController::class, 'create'])->name('admin.master.produk-pinjaman.create');
    Route::post('/produk-pinjaman', [LoanProductController::class, 'store'])->name('admin.master.produk-pinjaman.store');
    Route::get('/produk-pinjaman/{loanProduct}/edit', [LoanProductController::class, 'edit'])->name('admin.master.produk-pinjaman.edit');
    Route::put('/produk-pinjaman/{loanProduct}', [LoanProductController::class, 'update'])->name('admin.master.produk-pinjaman.update');
    Route::delete('/produk-pinjaman/{loanProduct}', [LoanProductController::class, 'destroy'])->name('admin.master.produk-pinjaman.destroy');

    Route::get('/akun/create', [AccountController::class, 'create'])->name('admin.master.akun.create');
    Route::post('/akun', [AccountController::class, 'store'])->name('admin.master.akun.store');
    Route::get('/akun/{account}/edit', [AccountController::class, 'edit'])->name('admin.master.akun.edit');
    Route::put('/akun/{account}', [AccountController::class, 'update'])->name('admin.master.akun.update');
    Route::delete('/akun/{account}', [AccountController::class, 'destroy'])->name('admin.master.akun.destroy');

    Route::get('/periode/create', [MasterPeriodController::class, 'create'])->name('admin.master.periode.create');
    Route::post('/periode', [MasterPeriodController::class, 'store'])->name('admin.master.periode.store');
    Route::get('/periode/{period}/edit', [MasterPeriodController::class, 'edit'])->name('admin.master.periode.edit');
    Route::put('/periode/{period}', [MasterPeriodController::class, 'update'])->name('admin.master.periode.update');
    Route::delete('/periode/{period}', [MasterPeriodController::class, 'destroy'])->name('admin.master.periode.destroy');

    Route::put('/pengaturan-koperasi', [CooperativeSettingController::class, 'update'])
        ->name('admin.master.pengaturan-koperasi.update');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin|Petugas|Pembina'])->group(function () {
    Route::get('/master-data/anggota', [AnggotaController::class, 'index'])->name('admin.master-data.anggota.index');
    Route::get('/master-data/anggota/{member}', [AnggotaController::class, 'show'])->name('admin.master-data.anggota.show');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/simpanan', [SavingController::class, 'index'])->name('admin.simpanan');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin|Petugas'])->group(function () {
    Route::get('/simpanan/create', [SavingController::class, 'create'])->name('admin.simpanan.create');
    Route::post('/simpanan', [SavingController::class, 'store'])->name('admin.simpanan.store');
    Route::post('/simpanan/{member}/deposit', [SavingController::class, 'storeDeposit'])->name('admin.simpanan.deposit');
    Route::post('/simpanan/{member}/withdraw', [SavingController::class, 'storeWithdraw'])->name('admin.simpanan.withdraw');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin|Petugas|Pembina'])->group(function () {
    Route::get('/simpanan/{member}', [SavingController::class, 'show'])->name('admin.simpanan.show');
});

require __DIR__.'/auth.php';
