<?php

namespace App\Filament\Owner\Resources\Orders\Pages;

use App\Filament\Owner\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
