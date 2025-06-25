<?php

use App\Http\Controllers\MetabaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/search-dataset', [App\Http\Controllers\SearchDatasetController::class, 'index'])
    ->name('search-dataset.index');

Route::get('/show', function () {
    return view('show');
});

Route::get('/show/kinerja-pegawai', [MetabaseController::class, 'showDashboard']);
