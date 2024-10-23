<?php

namespace App\Livewire\Pages\P04;


use App\Models\Store;
use App\Services\s04\StoresService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;

use Livewire\Component;

class StoresComponent extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;


    public function table(Table $table)
    {
        return $table->query(Store::query())
            ->columns(StoresService::tableSchema())

            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(StoresService::editSchema()),
                Tables\Actions\DeleteAction::make()
            ])

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Store::class)->form(StoresService::createSchema()),
            ]);
    }

    public function render()
    {
        return view('livewire.pages.p04.stores-component');
    }
}
