<?php

namespace App\Filament\Owner\Resources\Deliveries\Pages;

use App\Filament\Owner\Resources\Deliveries\DeliveryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDelivery extends EditRecord
{
    protected static string $resource = DeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
