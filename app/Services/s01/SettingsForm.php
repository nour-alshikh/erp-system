<?php

namespace App\Services\s01;



use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

final class SettingsForm
{

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
