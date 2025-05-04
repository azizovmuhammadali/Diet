<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\api\Admin\UserController;
use App\Http\Controllers\V1\api\Admin\ProductController;
use App\Http\Controllers\V1\api\Admin\NotificationController;



    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::middleware(['admin', 'auth:sanctum'])->group(function () {
        Route::get('logout', [UserController::class, 'logout']);
        Route::apiResource('products',ProductController::class);
        Route::get('notifications/unread', [NotificationController::class, 'unreadNotifications']);
        Route::get('notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
        Route::get('notifications/all', [NotificationController::class, 'allNotifications']);
        Route::get('markAsRead/{id}', [NotificationController::class,'markAsRead']);
    });


