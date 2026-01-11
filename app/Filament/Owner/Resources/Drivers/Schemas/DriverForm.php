<?php

namespace App\Filament\Owner\Resources\Drivers\Schemas;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;

class DriverForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(
                                table: User::class,
                                column: 'email',
                                ignoreRecord: true,
                                modifyRuleUsing: function (Unique $rule, callable $get, ?Model $record) {
                                    // When editing, ignore the current driver's user email
                                    if ($record && $record->user) {
                                        return $rule->ignore($record->user->id, 'id');
                                    }
                                    return $rule;
                                }
                            )
                            ->maxLength(255),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn (string $context) => $context === 'create')
                            ->dehydrated(fn ($state) => filled($state))
                            ->minLength(8),
                    ]),

                Section::make('Driver Information')
                    ->schema([
                        Select::make('station_id')
                            ->relationship('station', 'name')
                            ->label('Station')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
