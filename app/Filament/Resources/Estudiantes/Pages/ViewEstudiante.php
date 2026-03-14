<?php

namespace App\Filament\Resources\Estudiantes\Pages;

use App\Filament\Resources\Estudiantes\EstudianteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEstudiante extends ViewRecord
{
    protected static string $resource = EstudianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
            RestoreAction::make(),
            ForceDeleteAction::make(),
        ];
    }
}
