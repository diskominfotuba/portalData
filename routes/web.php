<?php

use App\Http\Controllers\StatistikSektoralController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\SearchDatasetController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\Monitoring\DashboardController;

// Route untuk Dashboard Monitoring
Route::get('/dashboard-monitoring', [DashboardController::class, 'index'])->name('dashboard-monitoring.index');
Route::get('/dashboard-monitoring/show', [DashboardController::class, 'show'])->name('dashboard-monitoring.show');

Route::view('/', 'home.index')->name('home');
Route::view('/webgis', 'webgis.index')->name('webgis');

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
    return view('search-dataset.show');
})->name('show');

Route::prefix('statistik-sektoral')->group(function () {
    Route::get('/', [StatistikSektoralController::class, 'index'])->name('statistik.index');
    Route::get('/show', [StatistikSektoralController::class, 'show'])->name('statistik.show');
});
