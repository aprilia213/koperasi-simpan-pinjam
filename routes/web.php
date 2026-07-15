<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AdminSimpananController;
use App\Http\Controllers\AdminPinjamanController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // | Dashboard User
    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])
    ->middleware([
        'verified',
        'role:user',
    ])->name('dashboard');

    // | Simpanan User
    Route::get('/simpanan', [
        SimpananController::class,
        'index'
    ])
    ->middleware([
        'verified',
        'role:user',
    ])->name('simpanan');

    Route::get('/simpanan/create', [
        SimpananController::class,
        'create'
    ])
    ->middleware([
        'verified',
        'role:user',
    ])->name('simpanan.create');

    Route::post('/simpanan', [
        SimpananController::class,
        'store'
    ])
    ->middleware([
        'verified',
        'role:user',
    ])->name('simpanan.store');

    // | Pinjaman User
    Route::get('/pinjaman', [
        PinjamanController::class, 'index'
    ])
    ->middleware([
        'verified',
        'role:user',
    ])->name('pinjaman');

    Route::get('/pinjaman/create', [
        PinjamanController::class, 'create'
    ])->middleware([
        'verified',
        'role:user',
    ])->name('pinjaman-create');

    Route::post('/pinjaman', [
        PinjamanController::class, 'store'
    ])->middleware([
        'verified',
        'role:user',
    ])->name('pinjaman.store');

    // | Dashboard Admin
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->middleware([
        'role:admin',
    ])->name('admin.dashboard');

    // | Simpanan Admin
    Route::get('/admin/simpanan', [
        AdminSimpananController::class,
        'index'
    ])
    ->middleware([
        'role:admin',
    ])
    ->name('admin.simpananadmin');

    Route::patch('/admin/simpanan/{id}', [
        AdminSimpananController::class,
        'update'
    ])
    ->middleware([
        'role:admin',
    ])
    ->name('admin.simpanan.update');

    // | simpanan admin aksi
    Route::put('/admin/simpanan/{id}/terima',
        [AdminSimpananController::class, 'terima']
    )->name('admin.simpanan.terima');

    Route::put('/admin/simpanan/{id}/tolak',
        [AdminSimpananController::class, 'tolak']
    )->name('admin.simpanan.tolak');

    // | Pinjaman Admin
    Route::get('/admin/pinjaman', [
        AdminPinjamanController::class,
        'index'
    ])
    ->middleware([
        'role:admin',
    ])
    ->name('admin.pinjamanadmin');

    Route::put('/admin/pinjaman/{id}', [
        AdminPinjamanController::class,
        'update'
    ])->middleware([
        'role:admin',
    ])->name('admin.pinjaman.update');

    // | Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';