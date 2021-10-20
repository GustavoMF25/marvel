<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\consumirMarvelController;
use App\Http\Controllers\dashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard', [dashboardController::class, 'buscaComics'])->middleware(['auth'])->name('buscaComics');

Route::get('/consumirApiMarvel', [consumirMarvelController::class, 'BuscaTitleId'])->name('ApiMarvel');

require __DIR__ . '/auth.php';
