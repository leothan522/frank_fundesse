<?php

namespace App\Filament\Resources\Estudiantes\Schemas;

use App\Filament\Resources\Customs\InputForm;
use App\Models\Colegio;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EstudianteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                Select::make('colegios_id')
                                    ->relationship('colegio', 'nombre')
                                    ->getOptionLabelFromRecordUsing(fn(Colegio $record) => Str::upper($record->nombre))
                                    ->preload()
                                    ->searchable()
                                    ->required()
                                    ->columnSpanFull()
                                    ->default(auth()->user()->colegios_id)
                                    ->visible(isAdmin()),
                                TextInput::make('nombres')
                                    ->required(),
                                TextInput::make('apellidos')
                                    ->required(),
                                TextInput::make('cedula')
                                    ->label('Cédula'),
                                DatePicker::make('fecha_nacimiento')
                                    ->required(),
                                Select::make('sexo')
                                    ->options(['femenino' => 'Femenino', 'masculino' => 'Masculino'])
                                    ->required(),
                                Select::make('representantes_id')
                                    ->relationship('representante', 'nombre')
                                    ->preload()
                                    ->searchable()
                                    ->required()
                                    ->createOptionForm([
                                        Section::make('Datos Básicos')
                                            ->schema([
                                                Fieldset::make('Datos Básicos')
                                                    ->schema([
                                                        TextInput::make('cedula')
                                                            ->required(),
                                                        TextInput::make('nombre')
                                                            ->required(),
                                                        TextInput::make('apellido')
                                                            ->required(),
                                                        Select::make('sexo')
                                                            ->options(['femenino' => 'Femenino', 'masculino' => 'Masculino'])
                                                            ->required(),
                                                        TextInput::make('telefono')
                                                            ->tel()
                                                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                            ->required(),
                                                        TextInput::make('telefono_2'),
                                                    ])
                                                    ->columns(3),
                                            ])
                                            ->compact(),
                                        Section::make('Dirección Habitación')
                                            ->schema([
                                                Fieldset::make('Dirección Habitación')
                                                    ->schema(InputForm::datosDireccion())
                                                    ->columns(3),
                                            ]),
                                    ]),
                                Toggle::make('direccion_representante')
                                    ->label('¿Vive con representante?  ')
                                    ->default(true)
                                    ->inline(false)
                                    ->required()
                                    ->live(),
                            ])
                            ->columns(),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Dirección Habitación')
                    ->schema([
                        Fieldset::make()
                            ->schema(fn(Get $get): array => InputForm::datosDireccion(false, !$get('direccion_representante')))
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull()
                    ->visible(fn(Get $get): bool => !$get('direccion_representante')),
            ]);
    }
}
