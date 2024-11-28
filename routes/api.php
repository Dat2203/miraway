<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Middleware\EnsureTokenIsProvided;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(EnsureTokenIsProvided::class);
    Route::post('/refresh-token', [AuthController::class,'refreshToken'])->middleware(EnsureTokenIsProvided::class);
    Route::post('/reset-password', [AuthController::class,'resetPassword'])->middleware(EnsureTokenIsProvided::class);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'devices'
], function ($router) {
    Route::get('/', [DeviceController::class, 'index'])->middleware(EnsureTokenIsProvided::class); // GET /api/devices

    Route::post('/', [DeviceController::class, 'store'])->middleware(EnsureTokenIsProvided::class); // POST /api/devices

    Route::get('{id}', [DeviceController::class, 'show'])->middleware(EnsureTokenIsProvided::class); // GET /api/devices/{id}

    Route::put('{id}', [DeviceController::class, 'update'])->middleware(EnsureTokenIsProvided::class); // PUT /api/devices/{id}

    Route::delete('{id}', [DeviceController::class, 'destroy'])->middleware(EnsureTokenIsProvided::class); 
});