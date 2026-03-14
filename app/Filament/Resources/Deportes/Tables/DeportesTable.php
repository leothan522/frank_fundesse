<?php

namespace App\Filament\Resources\Deportes\Tables;

use App\Models\Deporte;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DeportesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('deporte')
                    ->default(fn (Deporte $record): string => $record->nombre)
                    ->description(function (Deporte $record): string {
                        $response = '0 Modalidad';
                        $plural = '';
                        $modalidades = $record->modalidades_count;
                        if ($modalidades) {
                            $response = formatoMillares($modalidades, 0).' Modalidad';
                            if ($modalidades > 1) {
                                $plural = 'es';
                            }
                        }

                        return $response.$plural;
                    })
                    ->badge()
                    ->color(fn (Deporte $record): string => $record->is_active ? 'success' : 'danger')
                    ->size(TextSize::Large)
                    ->wrap()
                    ->hiddenFrom('md'),
                TextColumn::make('nombre')
                    ->formatStateUsing(fn (string $state): string => Str::ucwords($state))
                    ->searchable()
                    ->badge()
                    ->color(fn (Deporte $record): string => $record->is_active ? 'success' : 'danger')
                    ->size(TextSize::Large)
                    ->visibleFrom('md'),
                TextColumn::make('modalidades_count')
                    ->label('Total Modalidades')
                    ->counts('modalidades')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    RestoreAction::make(),
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
