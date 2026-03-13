<?php

namespace App\Filament\Resources\Deportes\Pages;

use App\Filament\Resources\Deportes\DeporteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDeporte extends CreateRecord
{
    protected static string $resource = DeporteResource::class;

    protected static bool $canCreateAnother = false;
}
