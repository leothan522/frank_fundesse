<?php

namespace App\Filament\Resources\Estudiantes\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EstudiantesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Nombre Completo')
                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                    ->wrap()
                    ->searchable(),
                TextColumn::make('fecha_nacimiento')
                    ->label('Nacimiento')
                    ->date()
                    ->searchable()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('edad')
                    ->numeric()
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('sexo')
                    ->badge()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('cedula')
                    ->label('C.I. / Cédula E.')
                    ->numeric()
                    ->alignCenter()
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('deportes.nombre')
                    ->badge()
                    ->searchable()
                    ->color('success')
                    ->wrap()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('colegio.codigo')
                    ->label('COD. Colegio')
                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                    ->visible(isAdmin())
                    ->alignCenter()
                    ->visibleFrom('lg'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
            ]);
    }
}
