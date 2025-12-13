<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanMenuController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Contoh rute dasar, sesuaikan dengan kebutuhan Anda

// --- Rute untuk Form Input ---
Route::prefix('input')->group(function () {
    Route::get('/sarana', [LaporanMenuController::class, 'showSaranaForm'])->name('input.sarana.form');
    Route::post('/sarana', [LaporanMenuController::class, 'storeSarana'])->name('input.sarana.store');

    Route::get('/tenaga', [LaporanMenuController::class, 'showTenagaForm'])->name('input.tenaga.form');
    Route::post('/tenaga', [LaporanMenuController::class, 'storeTenaga'])->name('input.tenaga.store');

    Route::get('/bahan', [LaporanMenuController::class, 'showBahanForm'])->name('input.bahan.form');
    Route::post('/bahan', [LaporanMenuController::class, 'storeBahan'])->name('input.bahan.store');

    Route::get('/produk', [LaporanMenuController::class, 'showProdukForm'])->name('input.produk.form');
    Route::post('/produk', [LaporanMenuController::class, 'storeProduk'])->name('input.produk.store');

    Route::get('/omzet', [LaporanMenuController::class, 'showOmzetForm'])->name('input.omzet.form');
    Route::post('/omzet', [LaporanMenuController::class, 'storeOmzet'])->name('input.omzet.store');
});

// --- Rute untuk Tampilan Datatabel Output (Data Mentah) ---
Route::prefix('data')->group(function () {
    Route::get('/saranas', [LaporanMenuController::class, 'indexSarana'])->name('data.sarana.index');
    Route::get('/tenaga', [LaporanMenuController::class, 'indexTenaga'])->name('data.tenaga.index');
    Route::get('/bahan', [LaporanMenuController::class, 'indexBahan'])->name('data.bahan.index');
    Route::get('/produk', [LaporanMenuController::class, 'indexProduk'])->name('data.produk.index');
    Route::get('/omzet', [LaporanMenuController::class, 'indexOmzet'])->name('data.omzet.index');
});

// --- Rute untuk Laporan Agregat ---
Route::prefix('laporan')->group(function () {
    Route::get('laporan/tahunan', [LaporanMenuController::class, 'indexTahun'])->name('tahun.index');
    Route::get('laporan/triwulan', [LaporanMenuController::class, 'indexTriwulan'])->name('triwulan.index');
    Route::get('laporan/rekapitulasi', [LaporanMenuController::class, 'indexRekapitulasi'])->name('rekapitulasi.index');
});

