<?php

namespace App\Services;

use App\Contracts\OrderItemRepositoryInterface;
use App\DTO\OrderItemDTO;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StationProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OrderItemService
{
    public function __construct(
        protected OrderItemRepositoryInterface $orderItemRepository
    ){}

    public function getOrderItemsViaOrderDeliveryDate(Request $request): Collection
    {
        $orderDeliveryDate = $request->input('delivery_date');

        return $this->orderItemRepository->getOrderItemsViaOrderDeliveryDate($orderDeliveryDate);
    }

    public function createOrderItems(int $orderId, Request $request): Collection
    {
        $orderItems = [];
        $orderItemsRequest = $request->input('order_items');

        foreach ($orderItemsRequest as $orderItem) {
            $product = StationProduct::find($orderItem['product_id']);
            $orderItem['price'] = $product->price;
            $orderItem['quantity'] = $orderItem['quantity'] ?? 1;
            $orderItem['order_id'] = $orderId;

            $orderItems[] = OrderItemDTO::fromArray($orderItem)->toArray();
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

    public function deleteOrderItem(OrderItem $orderItem): int
    {
        return $this->orderItemRepository->delete($orderItem);
    }
}
