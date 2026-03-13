<?php

namespace App\Filament\Resources\Deportes\Schemas;

use App\Models\Deporte;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\TextSize;
use Illuminate\Support\Str;

class DeporteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Deporte')
                    ->schema([
                        Fieldset::make()
                            ->dense()
                            ->schema([
                                TextEntry::make('nombre')
                                    ->formatStateUsing(fn (string $state): string => Str::ucwords($state))
                                    ->color('primary')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextSize::Medium)
                                    ->copyable(),
                                IconEntry::make('is_active')
                                    ->label('Activo')
                                    ->boolean()
                                    ->size(IconSize::Large),
                            ]),
                    ])
                    ->compact()
                    ->columnSpanFull(),
            ]);
    }
}
