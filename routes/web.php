<?php

use App\Http\Controllers\KategoriMustahikController;
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
        Route::resource('mustahik', 'App\Http\Controllers\MustahikController');
        Route::resource('kategori_mustahik', 'App\Http\Controllers\KategoriMustahikController');
        Route::put('/kategori_mustahik/{id}', [KategoriMustahikController::class, 'update'])->name('kategori_mustahik.update');

        /* ----------------- Kelola Distribusi dan Pengumpulan Zakat ---------------- */
        Route::resource('pengumpulan_zakat', 'App\Http\Controllers\PengumpulanZakatController');
        Route::resource('distribusi_zakat', 'App\Http\Controllers\DistribusiZakatController');

        /* -------------------------- Laporan Zakat Fitrah -------------------------- */
        Route::resource('laporan_pengumpulan', 'App\Http\Controllers\LaporanPengumpulanController');
        Route::resource('laporan_distribusi', 'App\Http\Controllers\LaporanDistribusiController');
    });
