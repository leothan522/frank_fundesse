<?php

namespace App\Filament\Resources\Deportes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DeporteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Deporte')
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                TextInput::make('nombre')
                                    ->maxLength(150)
                                    ->unique()
                                    ->required(),
                                Toggle::make('is_active')
                                    ->label('Activo')
                                    ->inline(false)
                                    ->hiddenOn('create'),
                            ]),
                    ])
                    ->compact()
                    ->columnSpanFull(),
            ]);
    }
}
