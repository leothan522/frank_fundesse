<?php

namespace App\Filament\Resources\Colegios\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Illuminate\Support\Str;

class ColegioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        Fieldset::make('Colegio')
                            ->schema([
                                TextEntry::make('codigo')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('nombre')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('fecha_fundacion')
                                    ->date()
                                    ->placeholder('-')
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('telefono_local')
                                    ->placeholder('-')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                            ])
                            ->columns(4),
                        Fieldset::make('Representante')
                            ->schema([
                                TextEntry::make('representante_nombre')
                                    ->label('Nombre')
                                    ->placeholder('-')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante_telefono')
                                    ->label('Teléfono celular')
                                    ->placeholder('-')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante_sexo')
                                    ->label('Sexo')
                                    ->placeholder('-')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                            ])
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Datos Territoriales')
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                TextEntry::make('estado.name')
                                    ->label('Estado')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('municipio.name')
                                    ->label('Municipio')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('parroquia.name')
                                    ->label('Parroquia')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('direccion')
                                    ->label('Dirrección')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->placeholder('-')
                                    ->columnSpan(2)
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('google_earth')
                                    ->label('Google Earth')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->placeholder('-')
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                            ])
                            ->columns(3)
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
