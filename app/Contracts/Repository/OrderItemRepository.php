<?php

namespace App\Contracts\Repository;

use App\Contracts\OrderItemRepositoryInterface;
use App\DTO\OrderItemDTO;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function getByOrderId(Order $order): Collection
    {
        return $order->orderItems;
    }

    public function getTotalByOrderID(Order $order): float
    {
        return OrderItemDTO::where('order_id', $order->id)
            ->sum(fn($item) => $item->quantity * $item->price);
    }

    public function getOrderItemsViaOrderDeliveryDate(string $orderDeliveryDate): Collection
    {
        return OrderItem::with('order', function($query) use ($orderDeliveryDate) {
            return $query->whereData('delivery_date', $orderDeliveryDate);
        })->get();
    }

    public function create(OrderItemDTO $dto): OrderItemDTO
    {
        return OrderItemDTO::create($dto->toArray());
    }

    public function createBulk(int $orderId, array $orderItems): Collection
    {
        $now = now();
        foreach($orderItems as $orderItem) {
            $orderItem['order_id'] = $orderId;
            $orderItem['created_at'] = $now;
            $orderItem['updated_at'] = $now;
        }

        return OrderItemDTO::where('order_id', $orderId)->whereDate('created_at', $now)->get();
    }

    public function update(Order $order, OrderItemDTO $dto): int
    {
        return $order->update($dto->toArray());;
    }

    public function delete(OrderItem $orderItem): int
    {
        return $orderItem->delete();
    }

    public function deleteByOrderId(int $orderId): int
    {
        return OrderItemDTO::where('order_id', $orderId)->delete();
    }
}
