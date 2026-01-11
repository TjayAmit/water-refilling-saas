<?php

namespace App\Contracts;

use App\DTO\OrderItem;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderItemRepositoryInterface
{
    public function getTotalByOrderID(Order $order): float;
    public function create(OrderItem $dto): OrderItem;
    public function createBulk(int $orderId, array $orderItems): Collection;
    public function update(OrderItem $dto, OrderItem $orderItem): OrderItem;
    public function delete(OrderItem $orderItem): int;
    public function deleteByOrderid(int $orderId): int;
}
