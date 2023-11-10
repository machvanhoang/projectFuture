<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthSocialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::prefix('social')->controller(AuthSocialController::class)->group(function () {
    Route::prefix('google')->group(function () {
        Route::post('url', 'googleUrl');
        Route::post('login', 'googleLogin');
    });
});

Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout');
    Route::get('user', 'user');
});
