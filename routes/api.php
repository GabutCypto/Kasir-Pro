<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route untuk mengelola produk
Route::get('/produk', [ProdukController::class, 'index']); // Menampilkan semua produk
Route::post('/produk', [ProdukController::class, 'store']); // Menambah produk baru
Route::get('/produk/{id}', [ProdukController::class, 'show']); // Menampilkan detail produk
Route::put('/produk/{id}', [ProdukController::class, 'update']); // Memperbarui produk
Route::delete('/produk/{id}', [ProdukController::class, 'destroy']); // Menghapus produk

// Route untuk mengelola transaksi
Route::post('/transaksi', [TransaksiController::class, 'store']); // Membuat transaksi baru
Route::get('/transaksi/{id}', [TransaksiController::class, 'show']); // Menampilkan detail transaksi

// Route untuk mengelola promosi
Route::post('/promosi', [PromosiController::class, 'store']); // Menambahkan promosi baru
Route::get('/promosi', [PromosiController::class, 'index']); // Melihat semua promosi
Route::delete('/promosi/{id}', [PromosiController::class, 'destroy']); // Menghapus promosi