<?php

namespace App\Filament\Resources\Deportes\Pages;

use App\Filament\Resources\Deportes\DeporteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeportes extends ListRecords
{
    protected static string $resource = DeporteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
