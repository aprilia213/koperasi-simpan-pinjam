<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;

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
    Route::get('/pinjaman', [PinjamanController::class,'index'])
    ->name('pinjaman');

    Route::get('/pinjaman/create', [PinjamanController::class,'create'])
    ->name('pinjaman-create');

    Route::post('/pinjaman', [PinjamanController::class,'store'])
    ->name('pinjaman.store');

    // | Dashboard Admin
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->middleware([
        'role:admin',
    ])->name('admin.dashboard');

    // | Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';