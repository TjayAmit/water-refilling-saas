<?php

namespace App\Filament\Resources\SubscriptionPlans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubscriptionPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('max_drivers')
                    ->required()
                    ->numeric(),
                TextInput::make('max_branches')
                    ->required()
                    ->numeric(),
                TextInput::make('features')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
