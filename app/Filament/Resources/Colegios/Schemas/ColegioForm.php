<?php

namespace App\Filament\Resources\Colegios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ColegioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        Fieldset::make('Colegio')
                            ->schema([
                                TextInput::make('codigo')
                                    ->label('Código')
                                    ->maxLength(50)
                                    ->unique()
                                    ->required(),
                                TextInput::make('nombre')
                                    ->maxLength(150)
                                    ->required()
                                    ->columnSpan(2),
                                DatePicker::make('fecha_fundacion')
                                    ->label('fecha de fundación '),
                                TextInput::make('telefono_local')
                                    ->label('Teléfono local')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                            ])
                            ->dense()
                            ->columns(3)
                            ->columnSpan(3),
                        Fieldset::make('Representante')
                            ->schema([
                                TextInput::make('representante_nombre')
                                    ->label('Nombre')
                                    ->maxLength(150),
                                TextInput::make('representante_telefono')
                                    ->label('Teléfono celular')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                                Select::make('representante_sexo')
                                    ->label('Sexo')
                                    ->options([
                                        'Femenino' => 'Femenino',
                                        'Masculino' => 'Masculino',
                                    ]),
                            ])
                            ->dense()
                            ->columns(3)
                            ->columnSpan(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Datos Territoriales')
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                Select::make('states_id')
                                    ->relationship('estado', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set) {
                                        $set('municipalities_id', null);
                                        $set('parishes_id', null);
                                    }),
                                Select::make('municipalities_id')
                                    ->relationship(
                                        'municipio',
                                        'name',
                                        fn (Builder $query, Get $get) => $query->where('state_id', $get('states_id'))
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set) {
                                        $set('parishes_id', null);
                                    }),
                                Select::make('parishes_id')
                                    ->relationship(
                                        'parroquia',
                                        'name',
                                        fn (Builder $query, Get $get) => $query->where('municipality_id', $get('municipalities_id'))
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Textarea::make('direccion')
                                    ->label('Dirección')
                                    ->columnSpanFull(),
                                TextInput::make('google_earth'),
                            ])
                            ->dense()
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
