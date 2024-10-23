<?php

namespace App\Services\s02;

use App\Models\Treasury;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;

final class TreasuryService
{

    public static function  tableSchema(): array
    {
        return [
            TextColumn::make('counter')
                ->label('#')
                ->rowIndex(),
            TextColumn::make('name')
                ->searchable(isIndividual: true)
                ->extraAttributes(['class' => 'bg-green-400'])
                ->sortable(),
            TextColumn::make('last_receipt_exchange'),
            TextColumn::make('last_receipt_collect'),
            TextColumn::make('company_code'),
            ToggleColumn::make('is_active'),
            ToggleColumn::make('is_master'),
            TextColumn::make('date'),
            SelectColumn::make('main_treasury_id')
                ->options(function (): array {
                    return Treasury::all()->pluck('name', 'id')->all();
                }),
            TextColumn::make('addedByUser.name')->label('Added By'),
            TextColumn::make('updatedByUser.name')->label('Updated By'),
        ];
    }
    public static function  filterSchema(): array
    {
        return [
            TernaryFilter::make('is_active'),
            TernaryFilter::make('is_master'),
        ];
    }
    public static function  createSchema(): array
    {
        return [
            Grid::make(3)->schema([
                TextInput::make('name')
                    ->required()->columnSpanFull(),
                TextInput::make('last_receipt_exchange')
                    ->required(),
                TextInput::make('last_receipt_collect')
                    ->required(),
                TextInput::make('company_code')
                    ->required(),

                Select::make('added_by')
                    ->options(function (): array {
                        return User::all()->pluck('name', 'id')->all();
                    })
                    ->required()
                    ->searchable(),

                Select::make('updated_by')
                    ->options(function (): array {
                        return User::all()->pluck('name', 'id')->all();
                    })
                    ->required()
                    ->searchable(),
                Select::make('main_treasury_id')
                    ->options(function (): array {
                        return Treasury::all()->pluck('name', 'id')->all();
                    })
                    ->label('Main Treasury')
                    ->searchable(),
                DatePicker::make('date')
                    ->required(),

                Checkbox::make('is_active')
                    ->inline(),
                Checkbox::make('is_master')
                    ->inline(),
            ])
        ];
    }
    public static function  editSchema(): array
    {
        return [
            Grid::make(3)->schema([
                TextInput::make('name')
                    ->required()->columnSpanFull(),
                TextInput::make('last_receipt_exchange')
                    ->required(),
                TextInput::make('last_receipt_collect')
                    ->required(),
                TextInput::make('company_code')
                    ->required(),

                Select::make('added_by')
                    ->options(function (): array {
                        return User::all()->pluck('name', 'id')->all();
                    })
                    ->required()
                    ->searchable(),

                Select::make('updated_by')
                    ->options(function (): array {
                        return User::all()->pluck('name', 'id')->all();
                    })
                    ->required()
                    ->searchable(),

                Select::make('main_treasury_id')
                    ->options(function (): array {
                        return Treasury::all()->pluck('name', 'id')->all();
                    })
                    ->label('Main Treasury')
                    ->searchable(),

                DatePicker::make('date')
                    ->required(),

                Checkbox::make('is_active')
                    ->inline(),
                Checkbox::make('is_master')
                    ->inline(),
            ])
        ];
    }
}
