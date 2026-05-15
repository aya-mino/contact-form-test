<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/admin', [ContactController::class, 'admin']);
Route::get('/export', [ContactController::class, 'export']);
Route::delete('/delete/{id}', [ContactController::class, 'destroy']);
Route::middleware('auth')->group(function () {
    Route::get('/admin', [ContactController::class, 'admin']);
});