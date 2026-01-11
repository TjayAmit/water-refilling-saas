<?php

namespace App\DTO;

use Illuminate\Http\Request;

class OrderItem
{
    public function __construct(
        public ?int $orderId,
        public int $productId,
        public int $quantity,
        public float $price
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            orderId: $request->input('order_id') ?? null,
            productId: $request->input('product_id'),
            quantity: $request->input('quantity'),
            price: $request->input('price')
        );
    }

    public function toArray(): array
    {
        return [
            'order_id' => $this->orderId,
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
