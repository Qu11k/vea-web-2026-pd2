<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FighterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\WeightClassController;
use App\Http\Controllers\DataController;

Route::get('/', [HomeController::class, 'index']);
//Fighter adrese
Route::get('/fighters', [FighterController::class, 'list']);
Route::get('/fighters/create', [FighterController::class, 'create']);
Route::post('/fighters/put', [FighterController::class, 'put']);
Route::get('/fighters/update/{fighter}', [fighterController::class, 'update']);
Route::post('/fighters/patch/{fighter}', [fighterController::class, 'patch']);
Route::post('/fighters/delete/{fighter}', [fighterController::class, 'delete']);
//auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);
//fight
Route::get('/fights', [FightController::class, 'list']);
Route::get('/fights/create', [FightController::class, 'create']);
Route::post('/fights/put', [FightController::class, 'put']);
Route::get('/fights/update/{fight}', [FightController::class, 'update']);
Route::post('/fights/patch/{fight}', [FightController::class, 'patch']);
Route::post('/fights/delete/{fight}', [FightController::class, 'delete']);
//weightclass
Route::get('/weightclasses', [WeightClassController::class, 'list']);
Route::get('/weightclasses/create', [WeightClassController::class, 'create']);
Route::post('/weightclasses/put', [WeightClassController::class, 'put']);
Route::get('/weightclasses/update/{weightclass}', [WeightClassController::class, 'update']);
Route::post('/weightclasses/patch/{weightclass}', [WeightClassController::class, 'patch']);
Route::post('/weightclasses/delete/{weightclass}', [WeightClassController::class, 'delete']);
//data
Route::get('/data/get-top-fighters', [DataController::class, 'getTopFighters']);
Route::get('/data/get-fighter/{fighter}', [DataController::class, 'getFighter']);
Route::get('/data/get-related-fighters/{fighter}', [DataController::class, 'getRelatedFighters']);