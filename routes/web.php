<?php

use App\Http\Controllers\HeroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/heroes', [HeroController::class, 'index']);
Route::post('/heroes', [HeroController::class, 'store']);
Route::put('/heroes/{id}', [HeroController::class, 'update']);
Route::delete('/heroes/{id}', [HeroController::class, 'destroy']);

Route::get('/heroes-multiple-podere/{id}', [HeroController::class, 'OPheroe']);