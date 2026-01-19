<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RestApis\{
    Auth\AuthController,
    CustomerOrderController,
    OrderController,
    NotificationController,
    StationController,
    StationProductController,
    StationOrderController};

Route::post('login', [AuthController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->group(function () {
        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index']);
            Route::post('/', [OrderController::class, 'store']);
            Route::patch('{order}/place', [OrderController::class, 'place']);
            Route::patch('{order}/out_for_delivery', [OrderController::class, 'outForDelivery']);
            Route::patch('{order}/complete', [OrderController::class, 'complete']);
        });

        // Customer Orders
        Route::get('customer-orders', [CustomerOrderController::class, 'index']);

        // Station
        Route::get('stations', [StationController::class, 'index']);

        // Station Products
        Route::get('stations/{station}/products', [StationProductController::class, 'index']);

        // Station Orders
        Route::get('stations/{station}/orders', [StationOrderController::class, 'index']);

        // Notifications
        Route::prefix('notifications')->group(function () {
            Route::get('/', [NotificationController::class, 'index']);
            Route::get('unread-count', [NotificationController::class, 'unreadCount']);
            Route::patch('{notification}/read', [NotificationController::class, 'markAsRead']);
            Route::post('read-all', [NotificationController::class, 'markAllAsRead']);
        });
    });
});

/**
 * Third Party entry for Customer Platform
 *
 * 1. Customer must be able to view station products
 * 2. Customer must be able to place orders
 * 3. Customer must be able to cancel order
 */
Route::prefix('v1/external')->group(function () {
    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::patch('{order}/place', [OrderController::class, 'place']);
        Route::patch('{order}/out_for_delivery', [OrderController::class, 'outForDelivery']);
        Route::patch('{order}/complete', [OrderController::class, 'complete']);
    });

    // Station Products
    Route::get('stations/{station}/products', [StationProductController::class, 'index']);

    // Station Orders
    Route::get('stations/{station}/orders', [StationOrderController::class, 'index']);
});
