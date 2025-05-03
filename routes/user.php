<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\api\User\UserController;

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('show/{id}', [UserController::class, 'show']);
        Route::put('update/{id}', [UserController::class, 'update']);
        Route::delete('delete/{id}', [UserController::class, 'delete']);
        Route::get('logout', [UserController::class, 'logout']);
    });


