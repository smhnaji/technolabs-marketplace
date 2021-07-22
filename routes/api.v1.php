<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Middleware\HasAdminRole;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Logged-in user
    Route::get('me', [UserController::class, 'show']);
    Route::patch('me', [UserController::class, 'update']);

    // Seller
    Route::prefix('seller')->middleware(HasSellerRole::class)->group(function() {
        
    });

    // Admin
    Route::prefix('admin')->middleware(HasAdminRole::class)->group(function() {
        Route::apiResource('users', UserController::class);
    });
});
