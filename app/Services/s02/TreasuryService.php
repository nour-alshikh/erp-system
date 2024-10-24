<?php

namespace App\Services\s02;

use App\Models\Setting;
use App\Models\Treasury;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Auth;

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
                ->sortable(),

            TextColumn::make('last_receipt_exchange'),
            TextColumn::make('last_receipt_collect'),
            // TextColumn::make('company_code'),
            ToggleColumn::make('is_active'),
            ToggleColumn::make('is_master'),
            TextColumn::make('date'),
            SelectColumn::make('main_treasury_id')
                ->options(function (): array {
                    return Treasury::all()->pluck('name', 'id')->all();
                }),
            // TextColumn::make('addedByUser.name')->label('Added By'),
            // TextColumn::make('updatedByUser.name')->label('Updated By'),
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
            Section::make()
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('name')
                            ->required()->columnSpanFull(),
                        TextInput::make('last_receipt_exchange')
                            ->required(),
                        TextInput::make('last_receipt_collect')
                            ->required(),
                        Select::make('main_treasury_id')
                            ->options(function (): array {
                                return Treasury::all()->pluck('name', 'id')->all();
                            })
                            ->label('Main Treasury')
                            ->searchable(),
                        Checkbox::make('is_active')
                            ->inline(),
                        Checkbox::make('is_master')
                            ->inline(),
                    ])
                ]),

            Section::make()
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('company_code')
                            ->default(fn() => Setting::where('key', '=', 'company code')->first()->value)->disabled(),

                        DatePicker::make('date')
                            ->default(fn() => Carbon::now())
                            ->required()
                            ->disabled(),

                        Select::make('added_by')
                            ->options(function (): array {
                                return User::all()->pluck('name', 'id')->all();
                            })
                            ->default(fn() => Auth::id())
                            ->required()
                            ->searchable()
                            ->disabled(),

                        Select::make('updated_by')
                            ->options(function (): array {
                                return User::all()->pluck('name', 'id')->all();
                            })
                            ->default(fn() => Auth::id())
                            ->required()
                            ->searchable()
                            ->disabled(),

                    ])
                ])
        ];
    }
    public static function  editSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('name')
                            ->required()->columnSpanFull(),
                        TextInput::make('last_receipt_exchange')
                            ->required(),
                        TextInput::make('last_receipt_collect')
                            ->required(),
                        Select::make('main_treasury_id')
                            ->options(function (): array {
                                return Treasury::all()->pluck('name', 'id')->all();
                            })
                            ->label('Main Treasury')
                            ->searchable(),
                        Checkbox::make('is_active')
                            ->inline(),
                        Checkbox::make('is_master')
                            ->inline(),
                    ])
                ]),

            Section::make()
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('company_code')
                            ->default(fn() => Setting::where('key', '=', 'company code')->first()->value)->disabled(),

                        DatePicker::make('date')
                            ->default(fn() => Carbon::now())
                            ->required()
                            ->disabled(),

                        Select::make('added_by')
                            ->options(function (): array {
                                return User::all()->pluck('name', 'id')->all();
                            })
                            ->default(fn() => Auth::id())
                            ->required()
                            ->searchable()
                            ->disabled(),

                        Select::make('updated_by')
                            ->options(function (): array {
                                return User::all()->pluck('name', 'id')->all();
                            })
                            ->default(fn() => Auth::id())
                            ->required()
                            ->searchable()
                            ->disabled(),

                    ])
                ])
        ];
    }
}
