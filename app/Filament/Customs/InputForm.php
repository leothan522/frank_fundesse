<?php

namespace App\Filament\Customs;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Database\Eloquent\Builder;

class InputForm
{
    public static function datosDireccion($googleHearth = false, $required = true): array
    {
        return array_filter([
            Select::make('states_id')
                ->relationship('estado', 'name')
                ->searchable()
                ->preload()
                ->required($required)
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
                ->required($required)
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
                ->required($required),
            Textarea::make('direccion')
                ->label('Dirección')
                ->required($required)
                ->columnSpanFull(),
            $googleHearth ? TextInput::make('google_earth') : null,
        ]);
    }
}
