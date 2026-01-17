<?php

namespace App\Filament\Refiller\Resources\Orders\Pages;

use App\Filament\Refiller\Resources\Orders\OrdersResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
