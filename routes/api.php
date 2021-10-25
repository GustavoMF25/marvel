<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\consumirMarvelController;
use App\Http\Controllers\api\AuthController;
use \App\Http\Controllers\api\UserController;

Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('/buscarComicsMobile', [consumirMarvelController::class, 'index']);
    Route::get('/buscaUsuarios', [UserController::class, 'index']);
});
//Route::get('/buscaUsuarios', [UserController::class, 'index']);

Route::get('/consumirApiMarvel', [consumirMarvelController::class, 'BuscaTitleId'])->name('ApiMarvel');
Route::get('/consumirApiMarvelSemanal', [consumirMarvelController::class, 'StoreUltimaSemana'])->name('ApiMarvelSemanal');
