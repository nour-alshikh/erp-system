<?php

namespace App\Livewire\dashboard\pages\p01;

use App\Models\Setting;
use App\Services\s01\SettingsForm;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Livewire\Component;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

class Settings extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function table(Table $table)
    {
        return $table->query(Setting::query())
            ->columns([
                TextColumn::make("key"),
                TextColumn::make("value"),
            ])

            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(SettingsForm::editSchema()),
                Tables\Actions\DeleteAction::make()
            ])

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Setting::class)->form(SettingsForm::createSchema()),
            ]);;
    }

    public function render()
    {
        return view('livewire.pages.dashboard.p01.settings');
    }
}
