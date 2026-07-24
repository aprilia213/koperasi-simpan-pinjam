<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AdminSimpananController;
use App\Http\Controllers\AdminPinjamanController;
use App\Http\Controllers\UserTransaksiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AnggotaController;

Route::get('/', fn () => view('welcome'));

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    // Dashboard User
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['verified', 'role:user'])
        ->name('dashboard');

    // Simpanan User
    Route::get('/simpanan', [SimpananController::class, 'index'])
        ->middleware(['verified', 'role:user'])
        ->name('simpanan');

    Route::get('/simpanan/create', [SimpananController::class, 'create'])
        ->middleware(['verified', 'role:user'])
        ->name('simpanan.create');

    Route::post('/simpanan', [SimpananController::class, 'store'])
        ->middleware(['verified', 'role:user'])
        ->name('simpanan.store');

    // Pinjaman User
    Route::get('/pinjaman', [PinjamanController::class, 'index'])
        ->middleware(['verified', 'role:user'])
        ->name('pinjaman');

    Route::get('/pinjaman/create', [PinjamanController::class, 'create'])
        ->middleware(['verified', 'role:user'])
        ->name('pinjaman-create');

    Route::post('/pinjaman', [PinjamanController::class, 'store'])
        ->middleware(['verified', 'role:user'])
        ->name('pinjaman.store');

    // Pembayaran Angsuran
    Route::get('/transaksi', [UserTransaksiController::class, 'index'])
        ->middleware(['verified', 'role:user'])
        ->name('transaksi.index');

    Route::post('/transaksi', [UserTransaksiController::class, 'store'])
        ->middleware(['verified', 'role:user'])
        ->name('transaksi.store');

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->middleware(['verified', 'role:user'])
        ->name('riwayat');


    

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    // Dashboard Admin
    Route::get('/admin', fn () => view('admin.dashboard'))
        ->middleware(['role:admin'])
        ->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | KELOLA ANGGOTA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/anggota', [AnggotaController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('admin.anggota');

Route::delete('/admin/anggota/{user}', [AnggotaController::class, 'destroy'])
    ->middleware(['role:admin'])
    ->name('admin.anggota.destroy');


    /*
    |--------------------------------------------------------------------------
    | SIMPANAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/simpanan', [AdminSimpananController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('admin.simpananadmin');

    Route::patch('/admin/simpanan/{id}', [AdminSimpananController::class, 'update'])
        ->middleware(['role:admin'])
        ->name('admin.simpanan.update');

    Route::patch('/admin/simpanan/{id}/terima', [AdminSimpananController::class, 'terima'])
        ->middleware(['role:admin'])
        ->name('admin.simpanan.terima');

    Route::patch('/admin/simpanan/{id}/tolak', [AdminSimpananController::class, 'tolak'])
        ->middleware(['role:admin'])
        ->name('admin.simpanan.tolak');



    /*
    |--------------------------------------------------------------------------
    | PINJAMAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/pinjaman', [AdminPinjamanController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('admin.pinjamanadmin');

    Route::patch('/admin/pinjaman/{id}', [AdminPinjamanController::class, 'update'])
        ->middleware(['role:admin'])
        ->name('admin.pinjaman.update');



    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI PEMBAYARAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/transaksi', [AdminTransaksiController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('admin.transaksi.index');

    Route::patch('/admin/transaksi/{id}/terima', [AdminTransaksiController::class, 'terima'])
        ->middleware(['role:admin'])
        ->name('admin.transaksi.terima');

    Route::patch('/admin/transaksi/{id}/tolak', [AdminTransaksiController::class, 'tolak'])
        ->middleware(['role:admin'])
        ->name('admin.transaksi.tolak');



    /*
    |--------------------------------------------------------------------------
    | LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/laporan', [LaporanController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('admin.laporan');

    Route::get('/admin/laporan/pdf', [LaporanController::class, 'pdf'])
        ->middleware(['role:admin'])
        ->name('admin.laporan.pdf');



    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';