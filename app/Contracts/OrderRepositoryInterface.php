<?php

namespace App\Contracts;

use App\DTO\OrderDTO;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function getAll(Request $request): LengthAwarePaginator;
    public function getOrderByStationId(Request $request, int $stationId): LengthAwarePaginator;
    public function getOrderById(int $orderId): Order;
    public function create(OrderDTO $dto): Order;
    public function update(OrderDTO $dto, Order $order): Order;
    public function delete(Order $order): int;
}
