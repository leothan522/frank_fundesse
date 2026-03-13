<?php

namespace App\Filament\Resources\Deportes\Pages;

use App\Filament\Resources\Deportes\DeporteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDeporte extends ViewRecord
{
    protected static string $resource = DeporteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
