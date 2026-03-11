<?php

namespace App\Filament\Resources\Colegios\Tables;

use App\Models\Colegio;
use Carbon\Carbon;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use pxlrbt\FilamentExcel\Actions\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ColegiosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('colegio')
                    ->default(fn (Colegio $record): string => Str::upper($record->nombre))
                    ->description(fn (Colegio $record): string => Str::upper($record->codigo), position: 'above')
                    ->hiddenFrom('md'),
                TextColumn::make('codigo')
                    ->label('Código')
                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('nombre')
                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                    ->searchable()
                    ->wrap()
                    ->visibleFrom('md'),
                TextColumn::make('representante_nombre')
                    ->label('Representante')
                    ->default('-')
                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                    ->description(fn (Colegio $record): string => Str::upper($record->representante_telefono))
                    ->searchable()
                    ->wrap()
                    ->visibleFrom('md'),
                TextColumn::make('fecha_fundacion')
                    ->label('Fecha de fundación')
                    ->date()
                    ->visibleFrom('md'),
                TextColumn::make('telefono_local')
                    ->label('Teléfono local')
                    ->default('-')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('municipio.name')
                    ->formatStateUsing(fn (string $state): string => Str::upper($state))
                    ->searchable()
                    ->wrap()
                    ->visibleFrom('xl'),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->relationship('estado', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('municipio')
                    ->relationship('municipio', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('parroquia')
                    ->relationship('parroquia', 'name')
                    ->searchable()
                    ->preload(),
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
                self::actionExportExcel(),
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
            ]);
    }

    protected static function actionExportExcel()
    {
        return ExportBulkAction::make()->exports([
            ExcelExport::make()
                ->withFilename('colegios-export')
                ->withColumns([
                    Column::make('codigo')
                        ->heading('Código')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state))
                        ->format(NumberFormat::FORMAT_TEXT),
                    Column::make('nombre')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('fecha_fundacion')
                        ->heading('Fecha de fundación')
                        ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y'))
                        ->format(NumberFormat::FORMAT_DATE_DDMMYYYY),
                    Column::make('telefono_local')
                        ->heading('Teléfono local')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state))
                        ->format(NumberFormat::FORMAT_TEXT),
                    Column::make('representante_nombre')
                        ->heading('Representante')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('representante_telefono')
                        ->heading('Teléfono celular')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state))
                        ->format(NumberFormat::FORMAT_TEXT),
                    Column::make('representante_sexo')
                        ->heading('Sexo')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('estado.name')
                        ->heading('Estado')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('municipio.name')
                        ->heading('Municipio')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('parroquia.name')
                        ->heading('Parroquia')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('google_earth')
                        ->heading('Google Earth')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state))
                        ->format(NumberFormat::FORMAT_TEXT),
                    Column::make('direccion')
                        ->heading('Dirección')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                ]),
        ]);
    }
}
