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

use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ViewAction;

class TreasuryComponent extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public $subTreasuries;  // To control modal visibility
    public $showModal = false;  // To control modal visibility

    public function table(Table $table)
    {
        return $table->query(Treasury::query())
            ->columns(TreasuryService::tableSchema())
            ->filters(TreasuryService::filterSchema())

            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(TreasuryService::editSchema()),
                Tables\Actions\DeleteAction::make(),

                // Custom Show action to trigger modal
                Tables\Actions\Action::make('show')
                    ->label('Show')
                    ->icon('heroicon-o-eye')
                    ->action(function ($record) {

                        $this->subTreasuries = Treasury::where('main_treasury_id', $record->id)->get();
                        $this->showModal = true;  // Open the modal
                    })
                    ->color('primary'),

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
            ]);
    }


    public function closeModal()
    {
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.pages.p02.treasury-component');
    }
}
