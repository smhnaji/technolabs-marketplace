<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ShopController;
use App\Http\Middleware\HasAdminRole;
use App\Http\Middleware\HasSellerRole;
use App\Http\Middleware\SellerOwnsShop;
use App\Http\Middleware\SellerOwnsProduct;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Logged-in user
    Route::get('me', [UserController::class, 'show']);
    Route::patch('me', [UserController::class, 'update']);

    // Seller
    Route::prefix('seller')->middleware(HasSellerRole::class)->group(function () {

        Route::prefix('shops/{shop}')->middleware(SellerOwnsShop::class)->apiResource('shops', ShopController::class);
        Route::apiResource('shops', ShopController::class)->only(['index', 'store']);

        Route::prefix('products/{product}')->middleware(SellerOwnsProduct::class)->apiResource('products', ProductController::class);
        Route::apiResource('products', ProductController::class)->only(['index', 'store']);
    });

    // Admin
    Route::prefix('admin')->middleware(HasAdminRole::class)->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('shops', ShopController::class);
        Route::apiResource('products', ProductController::class);
    });
});
