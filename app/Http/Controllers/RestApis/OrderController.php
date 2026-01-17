<?php

namespace App\Http\Controllers\RestApis;

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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        // Render the view
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->service->createDraftOrder($request)], 201);
    }

    public function place(Order $order, Request $request): JsonResponse
    {
        return response()->json(['data' => $this->service->updateOrderStatus($order, OrderStatusEnum::PENDING, OrderPlaceNotification::class)]);
    }

    public function outForDelivery(Order $order, Request $request): JsonResponse
    {
        return response()->json(['data' => $this->service->updateOrderStatus($order, OrderStatusEnum::OUT_FOR_DELIVERY, OrderPlaceNotification::class)]);
    }

    public function complete(Order $order, Request $request): JsonResponse
    {
        return response()->json(['data' => $this->service->updateOrderStatus($order, OrderStatusEnum::DELIVERED, OrderPlaceNotification::class)]);
    }
}
