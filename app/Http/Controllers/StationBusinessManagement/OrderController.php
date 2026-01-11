<?php

namespace App\Http\Controllers\StationBusinessManagement;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderPlaceNotification;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $service
    ){}

    /**
     * Display a list of order base parameters
     * StationId
     * OrderStatus
     * User Role
     */
    public function index()
    {
        //
    }

    /**
     * Display list of order page
     */
    public function create()
    {
        // Render the view
    }

    public function placeOrder(Order $order, Request $request): JsonResponse
    {
        return response()->json(['data' => $this->service->updateOrderStatus($order, OrderStatusEnum::PENDING, OrderPlaceNotification::class)]);
    }

    public function placeOutForDelivery(Order $order, Request $request): JsonResponse
    {
        return response()->json(['data' => $this->service->updateOrderStatus($order, OrderStatusEnum::OUT_FOR_DELIVERY, OrderPlaceNotification::class)]);
    }

    public function setDelivered(Order $order, Request $request): JsonResponse
    {
        return response()->json(['data' => $this->service->updateOrderStatus($order, OrderStatusEnum::DELIVERED, OrderPlaceNotification::class)]);
    }
}
