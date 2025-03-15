<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;


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

    Route::prefix('guru')->group(function () {
        Route::get('/', [GuruController::class, 'index']);
        Route::post('/store', [GuruController::class, 'store']);
        Route::post('/update/{id}', [GuruController::class, 'update']);
        Route::get('/show/{id}', [GuruController::class, 'show']);
        Route::get('/delete/{id}', [GuruController::class, 'delete']);
        Route::get('/active/{id}', [GuruController::class, 'active']);
    });
});
