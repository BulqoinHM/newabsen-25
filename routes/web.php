<?php

use App\Http\Controllers\DropdownController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ScheduleController;

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

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'indexlogin'])->name('login');
    Route::post('/postLogin', [LoginController::class, 'postLogin']);
});

Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
    
    // Route::get('/dashboardguru', [GuruController::class, 'dashboard']);
    
    Route::prefix('guru')->group(function () {
        Route::get('/', [GuruController::class, 'index']);
        Route::post('/store', [GuruController::class, 'store']);
        Route::post('/update/{id}', [GuruController::class, 'update']);
        Route::get('/show/{id}', [GuruController::class, 'show']);
        Route::get('/delete/{id}', [GuruController::class, 'delete']);
        Route::get('/active/{id}', [GuruController::class, 'active']);
  
    });

    Route::prefix('dropdown')->group(function () {
        Route::get('/', [DropdownController::class, 'index']);
        Route::post('/store', [DropdownController::class, 'store']);
        Route::post('/update/{id}', [DropdownController::class, 'update']);
        Route::get('/delete/{id}', [DropdownController::class, 'delete']);
  
    });

    Route::prefix('mapel')->group(function () {
        Route::get('/', [MapelController::class, 'index']);
        Route::post('/store', [MapelController::class, 'store']);
        Route::post('/update/{id}', [MapelController::class, 'update']);
        Route::get('/delete/{id}', [MapelController::class, 'delete']);
  
    });

    Route::prefix('jadwal')->group(function () {
        Route::post('/store', [ScheduleController::class, 'store']);
        Route::get('/update/{id}', [ScheduleController::class, 'update']);
        Route::get('/delete/{id}', [ScheduleController::class, 'delete']);
  
    });

    Route::prefix('presensi')->group(function () {
        Route::get('/dashboard', [PresensiController::class, 'index']);
        Route::post('/masuk', [PresensiController::class, 'absenMasuk']);
        Route::post('/keluar', [PresensiController::class, 'absenKeluar']);
        Route::post('/keluarawal', [PresensiController::class, 'absenKeluarAwal']);
        // Route::post('/update/{id}', [ScheduleController::class, 'update']);
        // Route::get('/delete/{id}', [ScheduleController::class, 'delete']);
  
    });

     Route::prefix('tes')->group(function () {
        Route::get('/', [PresensiController::class, 'tes']);
        // Route::post('/store', [ScheduleController::class, 'store']);
        // Route::post('/update/{id}', [ScheduleController::class, 'update']);
        // Route::get('/delete/{id}', [ScheduleController::class, 'delete']);
  
    });
});
