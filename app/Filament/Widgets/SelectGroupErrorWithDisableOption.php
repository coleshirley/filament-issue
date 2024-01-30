<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class SelectGroupErrorWithDisableOption extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.select-group-error-with-disable-option';


    public array $data = [];

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('select')
                ->live()
                ->required()
                ->options([
                    'Group 1' => [
                        1 => 'A',
                    ],
                    'Group 2' => [
                        2 => 'B',
                    ],
                ])
                ->disableOptionWhen(
                    fn (string $value) => $value == 1
                )
                ->in(fn (Select $component): array => array_keys($component->getEnabledOptions()))
                ->afterStateUpdated(function () {
                    $this->form->validate();
                }),
        ])
            ->statePath('data');
    }
}
