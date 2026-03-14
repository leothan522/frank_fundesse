<?php

namespace App\Filament\Resources\Estudiantes\Tables;

use App\Models\Estudiante;
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
                    ->placeholder('-')
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
                SelectFilter::make('colegio')
                    ->relationship('colegio', 'nombre')
                    ->preload()
                    ->searchable(['codigo', 'nombre'])
                    ->visible(isAdmin()),

                SelectFilter::make('deportes')
                    ->relationship('deportes', 'nombre')
                    ->preload()
                    ->searchable(),
                SelectFilter::make('sexo')
                    ->options([
                        'femenino' => 'Femenino',
                        'masculino' => 'Masculino',
                    ]),
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
                ->withFilename('estudiantes-export')
                ->withColumns([
                    Column::make('colegio.codigo')
                        ->heading('COD Colegio')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state))
                        ->format(NumberFormat::FORMAT_TEXT),
                    Column::make('nombres')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('apellidos')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('cedula')
                        ->heading('C.I./Cédula Estudiantil')
                        ->format(NumberFormat::FORMAT_NUMBER),
                    Column::make('fecha_nacimiento')
                        ->heading('Nacimiento')
                        ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y'))
                        ->format(NumberFormat::FORMAT_DATE_DDMMYYYY),
                    Column::make('edad')
                        ->format(NumberFormat::FORMAT_NUMBER),
                    Column::make('sexo'),
                    Column::make('deportes')
                        ->formatStateUsing(fn ($state) =>
                            // $state será una colección de modelos Deporte
                        $state ? $state->pluck('nombre')->implode(', ') : 'Ninguno'
                        ),
                    Column::make('representante.nombre')
                        ->heading('Nombre Representante')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state)),
                    Column::make('representante.cedula')
                        ->heading('Cédula Representante')
                        ->format(NumberFormat::FORMAT_NUMBER),
                    Column::make('representante.telefono')
                        ->heading('Teléfono Representante')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state))
                        ->format(NumberFormat::FORMAT_TEXT),
                    Column::make('representante.telefono_2')
                        ->heading('Teléfono Secundario')
                        ->formatStateUsing(fn (string $state): string => Str::upper($state))
                        ->format(NumberFormat::FORMAT_TEXT),
                    Column::make('direccion_representante')
                        ->heading('¿Vive con representante?')
                        ->formatStateUsing(fn (bool $state): string => $state ? 'SI' : 'NO'),
                    Column::make('states_id')
                        ->heading('Estado')
                        ->getStateUsing(fn (Estudiante $record) => $record->direccion_representante ? $record->representante->estado->name : $record->estado->name),
                    Column::make('municipalities_id')
                        ->heading('Municipio')
                        ->getStateUsing(fn (Estudiante $record) => $record->direccion_representante ? $record->representante->municipio->name : $record->municipio->name),
                    Column::make('parishes_id')
                        ->heading('Parroquia')
                        ->getStateUsing(fn (Estudiante $record) => $record->direccion_representante ? $record->representante->parroquia->name : $record->parroquia->name),
                ]),
        ]);
    }
}
