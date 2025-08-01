<?php

use App\Http\Controllers\API\SekolahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::prefix('sekolah')->controller(SekolahController::class)->group(function () {
    Route::get('/', 'index')->name('index.sekolah');
    Route::post('/import', 'import')->name('import.sekolah');
});
