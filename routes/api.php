<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\AuthController,
    Suppliers\SupplierController,
    Suppliers\RestoreSupplierController,
    getCompanyByCnpjController,
};
use App\Http\Resources\Users\UserResource;

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
            Route::get('/me', function (Request $request) {
                return  UserResource::make($request->user());
            });
            Route::post('/logout', [AuthController::class, 'logout']);
        });
        Route::prefix('suppliers')->controller(SupplierController::class)->group(function () {
            Route::post('/{supplier}/restore', RestoreSupplierController::class)->withTrashed();
            Route::get('/', 'index');
            Route::get('/{supplier}', 'show');
            Route::post('/', 'store');
            Route::patch('/{supplier}', 'update');
            Route::delete('/{supplier}', 'destroy');
        });
    });


    Route::get('/company/search', getCompanyByCnpjController::class);

});
