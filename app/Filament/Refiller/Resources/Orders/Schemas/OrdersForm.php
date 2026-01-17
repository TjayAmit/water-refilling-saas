<?php

namespace App\Filament\Refiller\Resources\Orders\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrdersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('selected_products')->default([]),
                Repeater::make('orderItems')
                    ->reactive()
                    ->relationship()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('selected_products', collect($state)->pluck('id')->toArray());
                    })
                    ->schema([
                        Select::make('id')
                            ->relationship(
                                name: 'stationProduct',
                                titleAttribute: 'id',
                                modifyQueryUsing: function ($query, $get) {
                                    $selected = $get('selected_products') ?? [];
                                    return $query->where('station_id', auth()->user()->station->id)
                                        ->whereNotIn('id', $selected)
                                        ->with('product');
                                }
                            )
                            ->getOptionLabelFromRecordUsing(
                                fn ($record) => $record->product->name
                            )
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $price = \App\Models\StationProduct::find($state)?->price ?? 0;
                                $set('price', $price);
                            }),
                        TextInput::make('quantity')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $set('subtotal', $get('price') * $state);
                            }),
                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->disabled(),
                        TextInput::make('subtotal')
                            ->numeric()
                            ->disabled(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->afterStateUpdated(function ($state, callable $set) {
                        foreach ($state as $key => $item) {
                            $state[$key]['subtotal'] = $item['price'] * ($item['quantity'] ?? 1);
                        }
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $total = collect($state)->sum(fn ($item) => $item['price'] * ($item['quantity'] ?? 1));
                        $set('total_amount', $total);
                    })
                    ->grid(2),
                Select::make('payment_method')
                    ->options(['cash' => 'Cash', 'card' => 'Card']),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
