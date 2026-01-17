<?php

namespace App\Filament\Refiller\Resources\Orders\Pages;

use App\Filament\Refiller\Resources\Orders\OrdersResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrders extends CreateRecord
{
    protected static string $resource = OrdersResource::class;
}
