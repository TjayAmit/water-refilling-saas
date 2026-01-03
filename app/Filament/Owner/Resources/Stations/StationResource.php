<?php

namespace App\Filament\Owner\Resources\Stations;

use App\Filament\Owner\Resources\Stations\Pages\CreateStation;
use App\Filament\Owner\Resources\Stations\Pages\EditStation;
use App\Filament\Owner\Resources\Stations\Pages\ListStations;
use App\Filament\Owner\Resources\Stations\Schemas\StationForm;
use App\Filament\Owner\Resources\Stations\Tables\StationsTable;
use App\Models\Station;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StationResource extends Resource
{
    protected static ?string $model = Station::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Business Management';

    protected static ?string $recordTitleAttribute = 'stations';

    public static function form(Schema $schema): Schema
    {
        return StationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StationsTable::configure($table);
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
            'index' => ListStations::route('/'),
            'create' => CreateStation::route('/create'),
            'edit' => EditStation::route('/{record}/edit'),
        ];
    }
}
