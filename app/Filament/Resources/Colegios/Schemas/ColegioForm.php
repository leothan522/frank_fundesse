<?php

namespace App\Filament\Resources\Colegios\Schemas;

use App\Filament\Resources\Customs\InputForm;
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
                                    ->label('Género')
                                    ->options([
                                        'femenino' => 'Femenino',
                                        'masculino' => 'Masculino',
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
                            ->schema(InputForm::datosDireccion(true))
                            ->dense()
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
