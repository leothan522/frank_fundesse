<?php

namespace App\Filament\Resources\Colegios\Schemas;

use App\Filament\Customs\TextInfolist;
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
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('nombre')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
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
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                            ])
                            ->dense()
                            ->columns(4),
                        Fieldset::make('Representante')
                            ->schema([
                                TextEntry::make('representante_nombre')
                                    ->label('Nombre')
                                    ->placeholder('-')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante_telefono')
                                    ->label('Teléfono celular')
                                    ->placeholder('-')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante_sexo')
                                    ->label('Sexo')
                                    ->placeholder('-')
                                    ->badge()
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                            ])
                            ->dense()
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Datos Territoriales')
                    ->schema([
                        Fieldset::make()
                            ->schema(TextInfolist::datosDireccion())
                            ->dense()
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
