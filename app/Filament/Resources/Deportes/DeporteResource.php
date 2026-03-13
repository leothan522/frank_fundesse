<?php

namespace App\Filament\Resources\Deportes;

use App\Filament\Resources\Deportes\Pages\CreateDeporte;
use App\Filament\Resources\Deportes\Pages\EditDeporte;
use App\Filament\Resources\Deportes\Pages\ListDeportes;
use App\Filament\Resources\Deportes\Pages\ViewDeporte;
use App\Filament\Resources\Deportes\RelationManagers\ModalidadesRelationManager;
use App\Filament\Resources\Deportes\Schemas\DeporteForm;
use App\Filament\Resources\Deportes\Schemas\DeporteInfolist;
use App\Filament\Resources\Deportes\Tables\DeportesTable;
use App\Models\Deporte;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class DeporteResource extends Resource
{
    protected static ?string $model = Deporte::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrophy;

    protected static string | UnitEnum | null $navigationGroup = 'Liga de Talentos';

    protected static ?int $navigationSort = 81;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return DeporteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DeporteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeportesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ModalidadesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDeportes::route('/'),
            'create' => CreateDeporte::route('/create'),
            'view' => ViewDeporte::route('/{record}'),
            'edit' => EditDeporte::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
