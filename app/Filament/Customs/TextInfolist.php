<?php

namespace App\Filament\Customs;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Illuminate\Support\Str;

class TextInfolist
{
    public static function datosDireccion($googleHearth = false): array
    {
        return [
            TextEntry::make('estado.name')
                ->label('Estado')
                ->formatStateUsing(fn (string $state): string => Str::upper($state))
                ->color('primary')
                ->weight(FontWeight::Bold)
                ->size(TextSize::Medium)
                ->copyable(),
            TextEntry::make('municipio.name')
                ->label('Municipio')
                ->formatStateUsing(fn (string $state): string => Str::upper($state))
                ->color('primary')
                ->weight(FontWeight::Bold)
                ->size(TextSize::Medium)
                ->copyable(),
            TextEntry::make('parroquia.name')
                ->label('Parroquia')
                ->formatStateUsing(fn (string $state): string => Str::upper($state))
                ->color('primary')
                ->weight(FontWeight::Bold)
                ->size(TextSize::Medium)
                ->copyable(),
            TextEntry::make('direccion')
                ->label('Dirrección')
                ->formatStateUsing(fn (string $state): string => Str::upper($state))
                ->placeholder('-')
                ->columnSpan(2)
                ->color('primary')
                ->weight(FontWeight::Bold)
                ->size(TextSize::Medium)
                ->copyable(),
            TextEntry::make('google_earth')
                ->label('Google Earth')
                ->formatStateUsing(fn (string $state): string => Str::upper($state))
                ->placeholder('-')
                ->color('primary')
                ->weight(FontWeight::Bold)
                ->size(TextSize::Medium)
                ->copyable()
                ->visible($googleHearth),
        ];
    }
}
