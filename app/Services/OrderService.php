<?php

namespace App\Services;

use App\Contracts\OrderItemRepositoryInterface;
use App\Contracts\OrderRepositoryInterface;
use App\DTO\OrderDTO;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Notifications\OrderDeliveredNotification;
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

    public function updateOrderStatus(Order $order, OrderStatusEnum $status, ?string $notificationClass = null): Order
    {
        $orderDTO = OrderDTO::fromModel($order);
        $orderDTO->status = OrderStatusEnum::PENDING;
        $this->orderRepository->update($orderDTO, $order);

        if ($notificationClass) {
            $order->customer->user->notify(new $notificationClass($order));
        }

        return $order;
    }
}
