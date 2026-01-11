<?php

namespace App\Contracts\Repository;

use App\Contracts\OrderRepositoryInterface;
use App\DTO\OrderDTO;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $search = $request->get('search');
        $limit = $request->get('limit') ?? 10;
        $page = $request->get('page') ?? 1;

        return Order::when($search, function ($query) use ($search) {
            $query->where('order_id', 'LIKE', "%{$search}%");
        })->paginate(limit: $limit, page: $page);
    }

    public function getOrderByStationId(Request $request, int $stationId): LengthAwarePaginator
    {
        $stationId = $request->get('station_id');
        $search = $request->get('search');
        $limit = $request->get('limit') ?? 10;
        $page = $request->get('page') ?? 1;

        return Order::when($search, function ($query) use ($search) {
                $query->where('order_id', 'LIKE', "%{$search}%");
            })
            ->where('station_id', $stationId)
            ->paginate(limit: $limit, page: $page);
    }

    public function getOrderById(int $orderId): Order
    {
        return Order::find($orderId);
    }

    public function getOrderByStationIdAndStatus(Station $station,OrderStatusEnum $status): Collection
    {
        return $station->orders()->where('status', $status)->get();
    }

    public function create(OrderDTO $dto): Order
    {
        return Order::create($dto->toArray());
    }

    public function update(OrderDTO $dto, Order $order): Order
    {
        $order->update($dto->toArray());
        return $order;
    }

    public function delete(Order $order): int
    {
        return $order->delete();
    }
}
