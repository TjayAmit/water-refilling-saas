<?php

namespace App\DTO;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDTO
{
    public function __construct(
        public ?int $orderId = null,
        public int $stationId,
        public int $customerId,
        public ?string $orderNumber = null,
        public float $totalAmount = 0.0,
        public string $paymentMethod = 'cash',
        public OrderStatusEnum $status = OrderStatusEnum::PENDING,
        public string $deliveryDate
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
            $orderId = $order->id,
            stationId: $order->station_id,
            customerId: $order->customer_id,
            orderNumber: $order->order_number,
            totalAmount: $order->total_amount,
            paymentMethod: $order->payment_method,
            status: $order->status,
            deliveryDate: $order->delivery_date
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
