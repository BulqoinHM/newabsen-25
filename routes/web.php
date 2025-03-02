<?php

use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('guru')->group(function(){
    Route::get('/', [GuruController::class, 'index']);
    Route::post('/store', [GuruController::class, 'store']);
    Route::post('/update/{id}', [GuruController::class, 'update']);
    Route::get('/delete/{id}', [GuruController::class, 'delete']);
});
