<?php

namespace App\Services\s05;

use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Auth;

final class UnitsService
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


            // TextColumn::make('company_code'),
            ToggleColumn::make('is_active'),
            TextColumn::make('is_master')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    '0' => 'gray',
                    '1' => 'success',
                })
                ->formatStateUsing(fn(?string $state): string => match ($state) {
                    '1' => 'أساسي',
                    '0' => 'تجزئة',
                    default => 'Partial', // default in case state is null or other
                }),

            TextColumn::make('date'),

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

                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->required()->columnSpanFull(),

                        Checkbox::make('is_active')
                            ->inline(),

                        Checkbox::make('is_master')
                            ->inline(),

                    ])
                ]),
            Section::make()
                ->schema([
                    Grid::make(2)->schema([
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

                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->required()->columnSpanFull(),

                        Checkbox::make('is_active')
                            ->inline(),

                        Checkbox::make('is_master')
                            ->inline(),

                    ])
                ]),
            Section::make()
                ->schema([
                    Grid::make(2)->schema([
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
