<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case DRAFT = 'Draft';
    case PENDING = 'Pending';
    case DELIVERY = 'Delivery';
    case DELIVERED = 'Delivered';
    case CANCELLED = 'Cancelled';

    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'Draft',
            self::PENDING => 'Pending',
            self::DELIVERY => 'Delivery',
            self::DELIVERED => 'Delivered',
            self::CANCELLED => 'Cancelled',
        };
    }
}
