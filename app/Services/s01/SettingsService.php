<?php

namespace App\Services\s01;



use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

final class SettingsService
{

    public static function  tableSchema(): array
    {
        return [
            TextColumn::make("key"),
            TextColumn::make("value"),
        ];
    }
    public static function  editSchema(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('key')
                    ->required(),
                TextInput::make('value')
                    ->required(),
            ])
        ];
    }
    public static function  createSchema(): array
    {
        return [
            // Repeater::make('Settings')
            //     ->schema([
            //         TextInput::make('Key')->required(),
            //         TextInput::make('Value')->required(),

            //     ])
            //     ->columns(2)
            Grid::make(2)->schema([
                TextInput::make('key')
                    ->required(),
                TextInput::make('value')
                    ->required(),
            ])
        ];
    }
}
