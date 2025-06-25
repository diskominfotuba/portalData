<?php

use App\Http\Controllers\MetabaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\SearchDatasetController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman utama Search Dataset
Route::get('/search-dataset', [SearchDatasetController::class, 'index'])
    ->name('search-dataset.index');

Route::get('/show', function () {
    return view('show');
});

Route::get('/show/kinerja-pegawai', [MetabaseController::class, 'showDashboard']);

// Route utama untuk Bantuan
Route::prefix('bantuan')->group(function () {

    Route::get('/', [BantuanController::class, 'index'])->name('bantuan.index');

    // Dataset
    Route::view('/dataset/apa-itu', 'bantuan.dataset.apa-itu')->name('bantuan.dataset.apa-itu');
    Route::view('/dataset/cara-mencari', 'bantuan.dataset.cara-mencari')->name('bantuan.dataset.cara-mencari');
    Route::view('/dataset/unduh', 'bantuan.dataset.unduh')->name('bantuan.dataset.unduh');
    Route::view('/dataset/format-unduh', 'bantuan.dataset.format-unduh')->name('bantuan.dataset.format-unduh');
    Route::view('/dataset/grafik', 'bantuan.dataset.grafik')->name('bantuan.dataset.grafik');
    Route::view('/dataset/peta', 'bantuan.dataset.peta')->name('bantuan.dataset.peta');
    Route::view('/dataset/permohonan', 'bantuan.dataset.permohonan')->name('bantuan.dataset.permohonan');

    // Visualisasi
    Route::view('/visualisasi/apa-itu', 'bantuan.visualisasi.apa-itu')->name('bantuan.visualisasi.apa-itu');
    Route::view('/visualisasi/cara-mencari', 'bantuan.visualisasi.cara-mencari')->name('bantuan.visualisasi.cara-mencari');
    Route::view('/visualisasi/unduh', 'bantuan.visualisasi.unduh')->name('bantuan.visualisasi.unduh');
    Route::view('/visualisasi/format-unduh', 'bantuan.visualisasi.format-unduh')->name('bantuan.visualisasi.format-unduh');
    Route::view('/visualisasi/panduan-kontribusi', 'bantuan.visualisasi.panduan-kontribusi')->name('bantuan.visualisasi.panduan-kontribusi');

    // Infografik
    Route::view('/infografik/apa-itu', 'bantuan.infografik.apa-itu')->name('bantuan.infografik.apa-itu');
    Route::view('/infografik/cara-mencari', 'bantuan.infografik.cara-mencari')->name('bantuan.infografik.cara-mencari');
    Route::view('/infografik/unduh', 'bantuan.infografik.unduh')->name('bantuan.infografik.unduh');
    Route::view('/infografik/format-unduh', 'bantuan.infografik.format-unduh')->name('bantuan.infografik.format-unduh');
});
