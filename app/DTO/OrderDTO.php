<?php

namespace App\DTO;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDTO
{
    public function __construct(
        public int $stationId,
        public int $customerId,
        public string $deliveryDate,
        public ?int $orderId = null,
        public ?string $orderNumber = null,
        public float $totalAmount = 0.0,
        public string $paymentMethod = 'cash',
        public OrderStatusEnum $status = OrderStatusEnum::PENDING,
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            stationId: $request->input('station_id'),
            customerId: $request->input('customer_id'),
            deliveryDate: $request->input('delivery_date')
            ?? now()->addDays(3)->toDateString()
            ?? now()->toDateString()
        );
    }

    public static function fromModel(Order $order): self
    {
        return new self(
            stationId: $order->station_id,
            customerId: $order->customer_id,
            deliveryDate: $order->delivery_date,
            orderId: $order->id,
            orderNumber: $order->order_number,
            totalAmount: $order->total_amount,
            paymentMethod: $order->payment_method,
            status: $order->status,
        );
    }

    public function toArray(): array
    {
        return [
            'order_number' => $this->orderNumber,
            'station_id' => $this->stationId,
            'customer_id' => $this->customerId,
            'total_amount' => $this->totalAmount,
            'payment_method' => $this->paymentMethod,
            'status' => $this->status,
            'delivery_date' => $this->deliveryDate,
        ];
    }
}
