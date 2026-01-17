<?php

namespace App\Filament\Refiller\Resources\Orders\Pages;

use App\Filament\Refiller\Resources\Orders\OrdersResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrders extends EditRecord
{
    protected static string $resource = OrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
