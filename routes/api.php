<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RestApis\{
    OrderController,
    StationController,
    StationProductController
};

Route::prefix('v1')->group(function () {
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::put('orders/{order}/place-order', [OrderController::class, 'placeOrder']);
    Route::put('orders/{order}/place-out-for-delivery', [OrderController::class, 'placeOutForDelivery']);
    Route::put('orders/{order}/delivered', [OrderController::class, 'setDelivered']);

    // Station
    Route::get('stations', [StationController::class, 'index']);

    // Station Products
    Route::get('stations/{station}/products', [StationProductController::class, 'index']);
});
