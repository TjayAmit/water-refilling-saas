<?php

namespace App\Contracts;

use App\DTO\OrderItemDTO;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderItemRepositoryInterface
{
    public function getByOrderId(Order $order): Collection;
    public function getTotalByOrderID(Order $order): float;
    public function create(OrderItemDTO $dto): OrderItemDTO;
    public function createBulk(int $orderId, array $orderItems): Collection;
    public function update(Order $order, OrderItemDTO $dto): int;
    public function delete(OrderItemDTO $orderItem): int;
    public function deleteByOrderid(int $orderId): int;
}
