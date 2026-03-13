<?php

namespace App\Filament\Resources\Estudiantes\Schemas;

use App\Models\Estudiante;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EstudianteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('colegios_id')
                    ->numeric(),
                TextEntry::make('nombres'),
                TextEntry::make('apellidos'),
                TextEntry::make('full_name')
                    ->placeholder('-'),
                TextEntry::make('fecha_nacimiento')
                    ->date(),
                TextEntry::make('sexo')
                    ->badge(),
                TextEntry::make('cedula')
                    ->placeholder('-'),
                TextEntry::make('representantes_id')
                    ->numeric(),
                IconEntry::make('direccion_representante')
                    ->boolean(),
                TextEntry::make('estado')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('municipio')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('parroquia')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('direccion')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Estudiante $record): bool => $record->trashed()),
            ]);
    }
}
