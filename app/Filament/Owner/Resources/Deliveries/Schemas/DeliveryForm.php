<?php

namespace App\Filament\Owner\Resources\Deliveries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeliveryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_id')
                    ->required()
                    ->numeric(),
                TextInput::make('driver_id')
                    ->required()
                    ->numeric(),
                TextInput::make('sequence')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('delivered_at'),
                TextInput::make('status')
                    ->required(),
            ]);
    }
}
