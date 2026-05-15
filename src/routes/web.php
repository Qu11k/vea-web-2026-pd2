<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FighterController;

Route::get('/', [HomeController::class, 'index']);
//Fighter adrese
Route::get('/fighters', [FighterController::class, 'list']);
Route::get('/fighters/create', [FighterController::class, 'create']);
Route::post('/fighters/put', [FighterController::class, 'put']);
Route::get('/fighters/update/{fighter}', [fighterController::class, 'update']);
Route::post('/fighters/patch/{fighter}', [fighterController::class, 'patch']);
Route::post('/fighters/delete/{fighter}', [fighterController::class, 'delete']);