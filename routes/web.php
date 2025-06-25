<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman utama Search Dataset
Route::get('/search-dataset', [App\Http\Controllers\SearchDatasetController::class, 'index'])
    ->name('search-dataset.index');

// Halaman utama bantuan open data
Route::get('/open-data', function () {
    return view('bantuan.index');
});

// Open Data Tulang Bawang
Route::prefix('open-data')->group(function () {
    Route::view('/apa-itu', 'bantuan.open-data.apa-itu');
    Route::view('/mekanisme', 'bantuan.open-data.mekanisme');
});

// Dataset
Route::prefix('dataset')->group(function () {
    Route::view('/apa-itu', 'bantuan.dataset.apa-itu');
    Route::view('/cara-mencari', 'bantuan.dataset.cara-mencari');
    Route::view('/unduh', 'bantuan.dataset.unduh');
    Route::view('/format-unduh', 'bantuan.dataset.format-unduh');
    Route::view('/grafik', 'bantuan.dataset.grafik');
    Route::view('/peta', 'bantuan.dataset.peta');
    Route::view('/permohonan', 'bantuan.dataset.permohonan');
});

// Visualisasi
Route::prefix('visualisasi')->group(function () {
    Route::view('/apa-itu', 'bantuan.visualisasi.apa-itu');
    Route::view('/cara-mencari', 'bantuan.visualisasi.cara-mencari');
    Route::view('/unduh', 'bantuan.visualisasi.unduh');
    Route::view('/format-unduh', 'bantuan.visualisasi.format-unduh');
    Route::view('/panduan-kontribusi', 'bantuan.visualisasi.panduan-kontribusi');
});

// Infografik
Route::prefix('infografik')->group(function () {
    Route::view('/apa-itu', 'bantuan.infografik.apa-itu');
    Route::view('/cara-mencari', 'bantuan.infografik.cara-mencari');
    Route::view('/unduh', 'bantuan.infografik.unduh');
    Route::view('/format-unduh', 'bantuan.infografik.format-unduh');
});
