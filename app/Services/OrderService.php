<?php

namespace App\Services;

use App\Contracts\OrderItemRepositoryInterface;
use App\Contracts\OrderRepositoryInterface;
use App\DTO\OrderDTO;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Notifications\OrderPlaceNotification;
use App\Notifications\OutForDeliveryNotification;
use Illuminate\Http\Request;

class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected OrderItemRepositoryInterface $orderItemRepository,
        protected OrderItemService $service
    ){}

    public function createDraftOrder(Request $request): Order
    {
        $orderDTO = OrderDTO::fromRequest($request);
        $order = $this->orderRepository->create($orderDTO);

        $this->service->createOrderItems($order->id, $request);

        $totalAmount = $this->orderItemRepository->getTotalByOrderID($order);
        $order->update(['total_amount' => $totalAmount]);

        return $order;
    }

    public function placeOrder(Order $order): Order
    {
        $orderDTO = OrderDTO::fromModel($order);
        $orderDTO->status = OrderStatusEnum::PENDING;

        $this->orderRepository->update($orderDTO, $order);
        $user = $order->customer->user;
        $user->notify(new OrderPlaceNotification($order));

        return $order;
    }

    public function outOfDelivery(Order $order): Order
    {
        $orderDTO = OrderDTO::fromModel($order);
        $orderDTO->status = OrderStatusEnum::OUT_FOR_DELIVERY;

        $this->orderRepository->update($orderDTO, $order);
        $user = $order->customer->user;
        $user->notify(new OutForDeliveryNotification($order));

        return $order;
    }
}
