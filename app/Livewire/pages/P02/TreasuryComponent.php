<?php

namespace App\Livewire\Pages\P02;


use App\Models\Treasury;
use App\Services\s02\TreasuryService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Component;

class TreasuryComponent extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function table(Table $table)
    {
        return $table->query(Treasury::query())
            ->columns(TreasuryService::tableSchema())
            ->filters(TreasuryService::filterSchema())

            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(TreasuryService::editSchema()),
                Tables\Actions\DeleteAction::make()
            ])

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Treasury::class)->form(TreasuryService::createSchema()),
            ])

            ->defaultPaginationPageOption('all')
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);;
    }
    public function render()
    {
        return view('livewire.pages.p02.treasury-component');
    }
}
