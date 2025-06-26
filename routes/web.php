<?php

use App\Http\Controllers\MetabaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\SearchDatasetController;
use App\Http\Controllers\OrganisasiController;

Route::view('/', 'home.index')->name('home');

// Route untuk Pencarian Dataset
Route::get('/search-dataset', [SearchDatasetController::class, 'index'])
    ->name('search-dataset.index');

// Route untuk Organisasi
Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('organisasi.index');

// Route utama untuk Bantuan
Route::prefix('bantuan')->group(function () {
    Route::get('/', [BantuanController::class, 'index'])->name('bantuan.index');
    // Dataset
    Route::view('/dataset/apa-itu', 'bantuan.dataset.apa-itu')->name('bantuan.dataset.apa-itu');
    // Visualisasi
    Route::view('/visualisasi/apa-itu', 'bantuan.visualisasi.apa-itu')->name('bantuan.visualisasi.apa-itu');
    // Infografik
    Route::view('/infografik/apa-itu', 'bantuan.infografik.apa-itu')->name('bantuan.infografik.apa-itu');
});

Route::get('/show', function () {
    return view('show');
});

Route::get('/show/kinerja-pegawai', [MetabaseController::class, 'showDashboard']);
