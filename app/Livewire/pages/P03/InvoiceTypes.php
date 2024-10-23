<?php

namespace App\Livewire\Pages\P03;

use App\Models\InvoiceType;
use App\Services\s03\InvoiceTypesService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;

use Livewire\Component;

class InvoiceTypes extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function table(Table $table)
    {
        return $table->query(InvoiceType::query())
            ->columns(InvoiceTypesService::tableSchema())

            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(InvoiceTypesService::editSchema()),
                Tables\Actions\DeleteAction::make()
            ])

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(InvoiceType::class)->form(InvoiceTypesService::createSchema()),
            ]);;
    }

    public function render()
    {
        return view('livewire.pages.p03.invoice-types');
    }
}
