<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\consumirMarvelController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/consumirApiMarvel', [consumirMarvelController::class, 'BuscaTitleId'])->name('ApiMarvel');
Route::get('/consumirApiMarvelSemanal', [consumirMarvelController::class, 'StoreUltimaSemana'])->name('ApiMarvelSemanal');
