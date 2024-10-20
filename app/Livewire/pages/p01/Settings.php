<?php

namespace App\Livewire\pages\p01;

use App\Models\Setting;
use App\Services\s01\SettingsService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Livewire\Component;


class Settings extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function table(Table $table)
    {
        return $table->query(Setting::query())
            ->columns(SettingsService::tableSchema())

            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(SettingsService::editSchema()),
                Tables\Actions\DeleteAction::make()
            ])

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Setting::class)->form(SettingsService::createSchema()),
            ]);;
    }

    public function render()
    {
        return view('livewire.pages.p01.settings');
    }
}
