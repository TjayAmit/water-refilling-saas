<?php

namespace App\Filament\Owner\Resources\Drivers;

use App\Filament\Owner\Resources\Drivers\Pages\CreateDriver;
use App\Filament\Owner\Resources\Drivers\Pages\EditDriver;
use App\Filament\Owner\Resources\Drivers\Pages\ListDrivers;
use App\Filament\Owner\Resources\Drivers\Schemas\DriverForm;
use App\Filament\Owner\Resources\Drivers\Tables\DriversTable;
use App\Models\Driver;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use UnitEnum;

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Business Management';

    protected static ?string $recordTitleAttribute = 'drivers';

    public static function form(Schema $schema): Schema
    {
        return DriverForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DriversTable::configure($table);
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
            'index' => ListDrivers::route('/'),
            'create' => CreateDriver::route('/create'),
            'edit' => EditDriver::route('/{record}/edit'),
        ];
    }
}
