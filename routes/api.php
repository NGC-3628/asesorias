<?php

use App\Http\Controllers\HeroController;
use Illuminate\Support\Facades\Route;

Route::get('/heroes', [HeroController::class, 'index']); 
Route::get('/heroes/mas-de-un-poder', [HeroController::class, 'heroesConMasDeUnPoder']); 
Route::post('/heroes', [HeroController::class, 'store']); 
Route::get('/heroes/{id}', [HeroController::class, 'show']); 
Route::post('/heroes/{id}/poderes', [HeroController::class, 'addPoderes']); 
Route::put('/heroes/{id}', [HeroController::class, 'update']); 
Route::delete('/heroes/{id}', [HeroController::class, 'destroy']);