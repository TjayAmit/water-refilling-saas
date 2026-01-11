<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case DRAFT = 'Draft';
    case PENDING = 'Pending';
    case OUT_FOR_DELIVERY = 'Out for delivery';
    case DELIVERED = 'Delivered';
    case CANCELLED = 'Cancelled';

    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'Draft',
            self::PENDING => 'Pending',
            self::OUT_FOR_DELIVERY => 'Out for Delivery',
            self::DELIVERED => 'Delivered',
            self::CANCELLED => 'Cancelled',
        };
    }
}
