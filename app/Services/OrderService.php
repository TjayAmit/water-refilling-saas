<?php

namespace App\Services;

use App\Actions\GenerateOrderNumberAction;
use App\Contracts\OrderItemRepositoryInterface;
use App\Contracts\OrderRepositoryInterface;
use App\DTO\OrderDTO;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderDeliveredNotification;
use App\Notifications\OrderPlaceNotification;
use App\Notifications\OutForDeliveryNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected OrderItemRepositoryInterface $orderItemRepository,
        protected OrderItemService $service
    ){}

    public function getOrderByStationIdAndStatus(Request $request): Collection
    {
        $stationId = $request->input('station_id');

        $status = OrderStatusEnum::tryFrom(
            strtoupper($request->input('status', 'draft'))
        ) ?? OrderStatusEnum::DRAFT;

        return $this->orderRepository->getOrderByStationIdAndStatus($stationId, $status);
    }

    public function createDraftOrder(Request $request): Order
    {
        $stationId = $request->input('station_id');
        $orderDTO = OrderDTO::fromRequest($request);
        $orderDTO->orderNumber = GenerateOrderNumberAction::execute($stationId);

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

    public function deleteItemInOrder(Order $order, OrderItem $orderItem): int
    {
        $this->service->deleteOrderItem($orderItem);
        $totalAmount = $this->orderItemRepository->getTotalByOrderID($order);

        return $order->update(['total_amount' => $totalAmount]);
    }
}
