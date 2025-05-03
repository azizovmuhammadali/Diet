<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\api\Admin\UserController;



    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::middleware(['admin', 'auth:sanctum'])->group(function () {
        Route::get('logout', [UserController::class, 'logout']);
    });


