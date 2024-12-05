<?php

use App\Http\Controllers\KategoriMustahikController;
use App\Http\Controllers\MuzakkiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {
        /* ------------------------- Halaman Dashboard Admin ------------------------ */

        Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

        /* ---------------------------- Kelola Data Warga --------------------------- */
        Route::resource('muzakki', 'App\Http\Controllers\MuzakkiController');
        Route::get('muzakki/export/excel', [MuzakkiController::class, 'export'])->name('muzakki.export.excel');

        Route::resource('mustahik', 'App\Http\Controllers\MustahikController');
        Route::resource('kategori_mustahik', 'App\Http\Controllers\KategoriMustahikController');
        Route::put('/kategori_mustahik/{id}', [KategoriMustahikController::class, 'update'])->name('kategori_mustahik.update');
        Route::get('/get-kategori-mustahik', [KategoriMustahikController::class, 'getKategoriMustahik'])->name('kategori_mustahik.get');

        /* ----------------- Kelola Distribusi dan Pengumpulan Zakat ---------------- */
        Route::resource('pengumpulan_zakat', 'App\Http\Controllers\PengumpulanZakatController');
        Route::resource('distribusi_zakat', 'App\Http\Controllers\DistribusiZakatController');

        /* -------------------------- Laporan Zakat Fitrah -------------------------- */
        Route::resource('laporan_pengumpulan', 'App\Http\Controllers\LaporanPengumpulanController');
        Route::resource('laporan_distribusi', 'App\Http\Controllers\LaporanDistribusiController');

        Route::resource('laporan_distribusi', 'App\Http\Controllers\LaporanDistribusiController');

    });
