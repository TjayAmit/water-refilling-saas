<?php

namespace App\Filament\Owner\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrders extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => \App\Models\Order::query())
            ->columns([
                TextColumn::make('customer.name')->label('Customer'),
                TextColumn::make('orderItems_count')
                    ->counts('orderItems')
                    ->label('Order Items'),
                TextColumn::make('total_amount')->label('Total Amount'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
