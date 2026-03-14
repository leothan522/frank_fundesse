<?php

namespace App\Filament\Widgets;

use App\Models\Estudiante;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EstudiantesStats extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        return isAdmin() || auth()->user()->has('colegio');
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Estudiantes', $this->getEstudiantes())
                ->description('Registrados en el sistema')
                ->descriptionIcon(Heroicon::OutlinedUserGroup, IconPosition::Before)
                ->chart([7, 3, 4, 5, 6, 3, 5, 10]) // Opcional: una línea de tendencia
                ->color('primary'),

            Stat::make('Masculinos', $this->getMasculinos())
                ->description('Estudiantes varones')
                ->descriptionIcon('heroicon-m-user', IconPosition::Before)
                ->color('info'),

            Stat::make('Femeninas', $this->getFemeninas())
                ->description('Estudiantes hembras')
                ->descriptionIcon('heroicon-m-user', IconPosition::Before)
                ->color('success'),
        ];
    }

    protected function getEstudiantes(): int
    {
        $query = Estudiante::query();
        if (! isAdmin()) {
            $query->where('colegios_id', auth()->user()->colegios_id);
        }

        return $query->count();
    }

    protected function getMasculinos(): int
    {
        $query = Estudiante::query();
        $query->where('sexo', 'masculino');
        if (! isAdmin()) {
            $query->where('colegios_id', auth()->user()->colegios_id);
        }

        return $query->count();
    }

    protected function getFemeninas(): int
    {
        $query = Estudiante::query();
        $query->where('sexo', 'femenino');
        if (! isAdmin()) {
            $query->where('colegios_id', auth()->user()->colegios_id);
        }

        return $query->count();
    }
}
