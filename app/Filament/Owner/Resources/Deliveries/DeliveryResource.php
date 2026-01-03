<?php

namespace App\Filament\Owner\Resources\Deliveries;

use App\Filament\Owner\Resources\Deliveries\Pages\CreateDelivery;
use App\Filament\Owner\Resources\Deliveries\Pages\EditDelivery;
use App\Filament\Owner\Resources\Deliveries\Pages\ListDeliveries;
use App\Filament\Owner\Resources\Deliveries\Schemas\DeliveryForm;
use App\Filament\Owner\Resources\Deliveries\Tables\DeliveriesTable;
use App\Models\Delivery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Order & Delivery Management';

    protected static ?string $recordTitleAttribute = 'deliveries';

    public static function form(Schema $schema): Schema
    {
        return DeliveryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeliveriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDeliveries::route('/'),
            'create' => CreateDelivery::route('/create'),
            'edit' => EditDelivery::route('/{record}/edit'),
        ];
    }
}
