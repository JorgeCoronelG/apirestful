<?php

use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1'
], function () {
    // Users
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/users/verify/{token}', [UserController::class, 'verify'])->name('verify');
    Route::post('/users/reset-password', [UserController::class, 'resetPassword'])->name('reset.password');
});

Route::group([
   'prefix' => 'v1',
    // 'middleware' => ['auth:api']
], function () {
    // Users
    Route::apiResource('users', UserController::class);
    Route::get('/users/{user}/resend', [UserController::class, 'resend'])->name('resend');
    Route::get('/users/{user}/logout', [LoginController::class, 'logout'])->name('logout');
    Route::patch('/users/{user}/change-email', [UserController::class, 'updateEmail'])->name('update.email');
    Route::patch('/users/{user}/change-password', [UserController::class, 'updatePassword'])->name('update.password');

    // Leagues
    // Route::apiResource('leagues', LeagueController::class);

    // Notices
    // Route::apiResource('notices', NoticeController::class);
});
