<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

Route::resource('kategori', KategoriController::class);
Route::resource('barang', BarangController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
