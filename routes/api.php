<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['lang'])->group(function () {

    Route::prefix('admin')->group(function () {
        require __DIR__.'/admin.php';
    });

    Route::prefix('user')->group(function () {
        require __DIR__.'/user.php';
    });

});
