<?php

namespace App\Contracts\Repository;

use App\Contracts\OrderItemRepositoryInterface;
use App\DTO\OrderItem;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function getTotalByOrderID(Order $order): float
    {
        return OrderItem::where('order_id', $order->id)
            ->sum(fn($item) => $item->quantity * $item->price);
    }

    public function create(OrderItem $dto): OrderItem
    {
        return OrderItem::create($dto->toArray());
    }

    public function createBulk(int $orderId, array $orderItems): Collection
    {
        $now = now();
        foreach($orderItems as $orderItem) {
            $orderItem['order_id'] = $orderId;
            $orderItem['created_at'] = $now;
            $orderItem['updated_at'] = $now;
        }

        return OrderItem::where('order_id', $orderId)->whereDate('created_at', $now)->get();
    }

    public function update(OrderItem $dto, OrderItem $orderItem): OrderItem
    {
        $orderItem->update($dto->toArray());
        return $orderItem;
    }

    public function delete(OrderItem $orderItem): int
    {
        return $orderItem->delete();
    }

    public function deleteByOrderid(int $orderId): int
    {
        return OrderItem::where('order_id', $orderId)->delete();
    }
}
