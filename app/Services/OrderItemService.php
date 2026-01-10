<?php

namespace App\Services;

use App\Contracts\OrderItemRepositoryInterface;
use App\DTO\OrderItemDTO;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OrderItemService
{
    public function __construct(
        protected OrderItemRepositoryInterface $orderItemRepository
    ){}

    public function createOrderItems(int $orderId, Request $request): Collection
    {
        $orderItems = [];
        $orderItemsRequest = $request->input('order_items');

        foreach ($orderItemsRequest as $orderItem) {
            $orderItems[] = OrderItemDTO::fromArray($orderItem);
        }

        return $this->orderItemRepository->createBulk($orderId, $orderItems);
    }

    public function addItemToOrder(Order $order, Request $request): Collection
    {
        $orderItems = [];
        $orderItemsRequest = $request->input('order_items');

        foreach ($orderItemsRequest as $orderItem) {
            $orderItems[] = OrderItemDTO::fromArray($orderItem);
        }
        $this->orderItemRepository->createBulk($order->id, $orderItems);

        return $this->orderItemRepository->getByOrderId($order);
    }
}
