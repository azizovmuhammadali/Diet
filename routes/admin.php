<?php

use App\Http\Controllers\V1\api\Admin\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\api\Admin\UserController;
use App\Http\Controllers\V1\api\Admin\ProductController;
use App\Http\Controllers\V1\api\Admin\NotificationController;
use App\Http\Controllers\V1\api\Admin\OrderController;
use App\Http\Controllers\V1\api\Admin\TranslationController;

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('login/number',[UserController::class,'loginNumber']);
    Route::middleware(['admin', 'auth:sanctum'])->group(function () {
        Route::get('logout', [UserController::class, 'logout']);
        Route::apiResource('products',ProductController::class);
        Route::get('notifications/unread', [NotificationController::class, 'unreadNotifications']);
        Route::get('notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
        Route::get('notifications/all', [NotificationController::class, 'allNotifications']);
        Route::get('markAsRead/{id}', [NotificationController::class,'markAsRead']);
        Route::apiResource('lang',LanguageController::class);
        Route::apiResource('translations',TranslationController::class);
        Route::put('orders/{id}',[OrderController::class,'status']);
    });


