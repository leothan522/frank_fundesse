<?php

namespace App\Filament\Resources\Estudiantes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class EstudiantesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('colegios_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nombres')
                    ->searchable(),
                TextColumn::make('apellidos')
                    ->searchable(),
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                TextColumn::make('sexo')
                    ->badge(),
                TextColumn::make('cedula')
                    ->searchable(),
                TextColumn::make('representantes_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('direccion_representante')
                    ->boolean(),
                TextColumn::make('estado')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('municipio')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('parroquia')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
