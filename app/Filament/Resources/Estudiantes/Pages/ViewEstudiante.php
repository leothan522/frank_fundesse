<?php

namespace App\Filament\Resources\Estudiantes\Pages;

use App\Filament\Resources\Estudiantes\EstudianteResource;
use App\Models\Estudiante;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;

class ViewEstudiante extends ViewRecord
{
    protected static string $resource = EstudianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make()
                ->before(function (Estudiante $record) {
                    $cedula = '*'.$record->cedula;
                    $record->update(['cedula' => $cedula]);
                }),
            RestoreAction::make()
                ->before(function (Estudiante $record) {
                    $cedula = Str::replace('*', '', $record->cedula);
                    $record->update(['cedula' => $cedula]);
                }),
            ForceDeleteAction::make(),
        ];
    }
}
