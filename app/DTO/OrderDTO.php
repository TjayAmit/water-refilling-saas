<?php

namespace App\DTO;

use App\Enums\OrderStatusEnum;
use Illuminate\Http\Request;

class OrderDTO
{
    public function __construct(
        public int $stationId,
        public int $customerId,
        public float $totalAmount = 0.0,
        public string $paymentMethod,
        public OrderStatusEnum $status = OrderStatusEnum::PENDING,
        public string $deliveryDate
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            stationId: $request->input('station_id'),
            customerId: $request->input('customer_id'),
            paymentMethod: $request->input('payment_method'),
            deliveryDate: $request->input('delivery_date')
            ?? now()->addDays(3)->toDateString()
            ?? now()->toDateString()
        );
    }

    public function toArray(): array
    {
        return [
            'station_id' => $this->stationId,
            'customer_id' => $this->customerId,
            'total_amount' => $this->totalAmount,
            'payment_method' => $this->paymentMethod,
            'status' => $this->status,
            'delivery_date' => $this->deliveryDate,
        ];
    }
}
