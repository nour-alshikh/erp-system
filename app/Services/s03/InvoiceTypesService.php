<?php

namespace App\Services\s03;

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

final class InvoiceTypesService
{

    public static function  tableSchema(): array
    {
        return [
            TextColumn::make('counter')
                ->label('#')
                ->rowIndex(),
            TextColumn::make('name')
                ->searchable(isIndividual: true)
                ->sortable(),

            TextColumn::make('company_code'),
            ToggleColumn::make('is_active'),

            TextColumn::make('date'),

            TextColumn::make('addedByUser.name')->label('Added By'),
            TextColumn::make('updatedByUser.name')->label('Updated By'),
        ];
    }
    public static function  filterSchema(): array
    {
        return [
            TernaryFilter::make('is_active'),

        ];
    }
    public static function  createSchema(): array
    {
        return [
            Grid::make(3)->schema([
                TextInput::make('name')
                    ->required()->columnSpanFull(),

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

                DatePicker::make('date')
                    ->required(),

                Checkbox::make('is_active')
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


                DatePicker::make('date')
                    ->required(),

                Checkbox::make('is_active')
                    ->inline(),

            ])
        ];
    }
}
