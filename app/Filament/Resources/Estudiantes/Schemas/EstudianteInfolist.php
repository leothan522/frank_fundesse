<?php

namespace App\Filament\Resources\Estudiantes\Schemas;

use App\Filament\Customs\TextInfolist;
use App\Models\Estudiante;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Illuminate\Support\Str;

class EstudianteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        Fieldset::make('Estudiante')
                            ->schema([
                                TextEntry::make('colegio.codigo')
                                    ->label('COD. Colegio')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('full_name')
                                    ->label('Nombre Completo')
                                    ->wrap()
                                    ->placeholder('-')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('fecha_nacimiento')
                                    ->label('Nacimiento')
                                    ->date()
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('edad')
                                    ->numeric()
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('sexo')
                                    ->badge()
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('cedula')
                                    ->label('C.I. / Cédula Estudiantil')
                                    ->numeric()
                                    ->placeholder('-')
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                            ])
                            ->dense()
                            ->columns(3),
                        Fieldset::make('Deportes')
                            ->schema([
                                TextEntry::make('deportes.nombre')
                                    ->hiddenLabel()
                                    ->badge()
                                    ->color('success')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Large)
                                    ->copyable()
                                    ->columnSpanFull(),
                            ])
                            ->dense(),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Representante')
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                TextEntry::make('representante.cedula')
                                    ->numeric()
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante.nombre')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante.sexo')
                                    ->badge()
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante.telefono')
                                    ->label('Teléfono')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante.telefono_2')
                                    ->label('Teléfono secundario')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->placeholder('-')
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('direccion_representante')
                                    ->label('¿Vive con representante?')
                                    ->formatStateUsing(fn (bool $state): string => $state ? 'SI' : 'NO')
                                    ->placeholder('-')
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
                Section::make('Dirección Habitación')
                    ->visible(fn (Estudiante $record): bool => ! $record->direccion_representante)
                    ->schema([
                        Fieldset::make()
                            ->schema(TextInfolist::datosDireccion())
                            ->dense()
                            ->columns(3),
                    ])
                    ->compact()
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Dirección Habitación')
                    ->visible(fn (Estudiante $record): bool => $record->direccion_representante)
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                TextEntry::make('representante.estado.name')
                                    ->label('Estado')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante.municipio.name')
                                    ->label('Municipio')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante.parroquia.name')
                                    ->label('Parroquia')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                TextEntry::make('representante.direccion')
                                    ->label('Dirrección')
                                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                                    ->placeholder('-')
                                    ->columnSpan(2)
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
            ]);
    }
}
