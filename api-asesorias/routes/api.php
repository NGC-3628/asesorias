<?php

use App\Http\Controllers\HeroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/heroes', [HeroController::class, 'index']);
Route::post('/heroes', [HeroController::class, 'store']);
Route::put('/heroes/{id}', [HeroController::class, 'update']);
Route::delete('/heroes/{id}', [HeroController::class, 'destroy']);

Route::get('/heroes-multiple-podere', [HeroController::class, 'OPheroe']);
Route::post('/heroes/{id}/poderes', [HeroController::class, 'agregarPoder']);