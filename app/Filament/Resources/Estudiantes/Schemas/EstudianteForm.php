<?php

namespace App\Filament\Resources\Estudiantes\Schemas;

use App\Filament\Customs\InputForm;
use App\Models\Colegio;
use App\Models\Representante;
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
                                    ->getOptionLabelFromRecordUsing(fn (Colegio $record) => Str::upper($record->nombre))
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
                                    ->getOptionLabelFromRecordUsing(fn (Representante $record) => Str::upper(formatoMillares($record->cedula, 0).' '.$record->nombre))
                                    ->preload()
                                    ->searchable(['cedula', 'nombre'])
                                    ->required()
                                    ->createOptionForm([
                                        Section::make('Datos Básicos')
                                            ->schema([
                                                TextInput::make('cedula')
                                                    ->numeric()
                                                    ->minValue(1)
                                                    ->unique()
                                                    ->required(),
                                                TextInput::make('nombre')
                                                    ->required()
                                                    ->columnSpan(2),
                                                Select::make('sexo')
                                                    ->options(['femenino' => 'Femenino', 'masculino' => 'Masculino'])
                                                    ->required(),
                                                TextInput::make('telefono')
                                                    ->label('Teléfono')
                                                    ->tel()
                                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                    ->required(),
                                                TextInput::make('telefono_2')
                                                    ->label('Teléfono secundario')
                                                    ->tel()
                                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                                            ])
                                            ->compact()
                                            ->columns(3)
                                            ->collapsible(),
                                        Section::make('Dirección Habitación')
                                            ->schema(InputForm::datosDireccion())
                                            ->compact()
                                            ->columns(3)
                                            ->collapsible(),
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
                            ->schema(fn (Get $get): array => InputForm::datosDireccion(false, ! $get('direccion_representante')))
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull()
                    ->visible(fn (Get $get): bool => ! $get('direccion_representante')),
            ]);
    }
}
