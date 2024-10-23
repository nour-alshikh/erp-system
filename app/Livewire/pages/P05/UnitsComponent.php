<?php

namespace App\Livewire\Pages\P05;


use App\Models\Unit;
use App\Services\s05\UnitsService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;

use Livewire\Component;


class UnitsComponent extends Component  implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function table(Table $table)
    {
        return $table->query(Unit::query())
            ->columns(UnitsService::tableSchema())

            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(UnitsService::editSchema()),
                Tables\Actions\DeleteAction::make()
            ])

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Unit::class)->form(UnitsService::createSchema()),
            ])
            ->striped();
    }

    public function render()
    {
        return view('livewire.pages.p05.units-component');
    }
}
