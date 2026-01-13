<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Petugas\StokController;
use App\Http\Controllers\Petugas\TransaksiController;


// Auth
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('user', UserController::class);
});

// Petugas Routes
Route::middleware(['auth', 'petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');

    Route::get('/dashboard/petugas', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');

    Route::get('/petugas/stok', [StokController::class, 'index'])
        ->name('petugas.stok.index');
        Route::get('/petugas/transaksi', [TransaksiController::class, 'index'])
        ->name('petugas.transaksi.index');

    Route::post('/petugas/transaksi', [TransaksiController::class, 'store'])
        ->name('petugas.transaksi.store');

});