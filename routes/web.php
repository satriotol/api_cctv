<?php

use App\Http\Controllers\CctvController;
use App\Http\Controllers\CctvLokasiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('cctv', CctvController::class);
    Route::resource('cctv_lokasi', CctvLokasiController::class);
});


require __DIR__.'/auth.php';
