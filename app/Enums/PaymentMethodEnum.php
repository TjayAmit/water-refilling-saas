<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case CASH = 'Cash';
    case MAYA = 'Maya';
    case GCASH = 'GCash';

    public function label(): string
    {
        return match($this) {
            self::CASH => 'Cash',
            self::MAYA => 'Maya',
            self::GCASH => 'GCash',
        };
    }
}
