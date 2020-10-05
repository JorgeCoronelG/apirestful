<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\League\LeagueController;
use \App\Http\Controllers\User\LoginController;

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth:api')->prefix('v1/app')->group(function () {
    Route::apiResource('leagues',LeagueController::class);
    Route::get('/users/{user}/logout', [LoginController::class, 'logout']);
});
