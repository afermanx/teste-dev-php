<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\AuthController
};

Route::prefix('v1')->group(function () {
    // Rota de boas-vindas
    Route::get('/', function () {
        return [
            'message' => 'Welcome!',
            'name' => config('app.name'),
            'version' => config('app.version'),
            'documentation' => config('app.documentation')
        ];
    });

    // Routes auth
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
    });

    //require authentication
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('users')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });

});