<?php

namespace App\Filament\Resources\Colegios\Schemas;

use App\Models\Colegio;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ColegioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('codigo'),
                TextEntry::make('nombre'),
                TextEntry::make('direccion')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('states_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('municipalities_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('parishes_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('google_earth')
                    ->placeholder('-'),
                TextEntry::make('representante_nombre')
                    ->placeholder('-'),
                TextEntry::make('representante_telefono')
                    ->placeholder('-'),
                TextEntry::make('representante_sexo')
                    ->placeholder('-'),
                TextEntry::make('fecha_fundacion')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('telefono_local')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Colegio $record): bool => $record->trashed()),
            ]);
    }
}
