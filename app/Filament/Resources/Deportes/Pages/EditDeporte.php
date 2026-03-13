<?php

namespace App\Filament\Resources\Deportes\Pages;

use App\Filament\Resources\Deportes\DeporteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDeporte extends EditRecord
{
    protected static string $resource = DeporteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
