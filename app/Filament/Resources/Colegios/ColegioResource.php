<?php

namespace App\Filament\Resources\Colegios;

use App\Filament\Resources\Colegios\Pages\CreateColegio;
use App\Filament\Resources\Colegios\Pages\EditColegio;
use App\Filament\Resources\Colegios\Pages\ListColegios;
use App\Filament\Resources\Colegios\Pages\ViewColegio;
use App\Filament\Resources\Colegios\RelationManagers\UsuariosRelationManager;
use App\Filament\Resources\Colegios\Schemas\ColegioForm;
use App\Filament\Resources\Colegios\Schemas\ColegioInfolist;
use App\Filament\Resources\Colegios\Tables\ColegiosTable;
use App\Models\Colegio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use UnitEnum;

class ColegioResource extends Resource
{
    protected static ?string $model = Colegio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string | UnitEnum | null $navigationGroup = 'Liga de Talentos';

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return Str::upper($record->nombre);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['codigo', 'nombre', 'representante_nombre', 'representante_telefono', 'telefono_local'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Código' => Str::upper($record->codigo),
            'Representante' => Str::upper($record->representante_nombre),
            'Teléfono Celular' => Str::upper($record->representante_telefono),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return ColegioForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ColegioInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ColegiosTable::configure($table);
    }

    public static function getRelations(): array
    {
        // Verificamos si la ruta existe y si contiene ".edit"
        if (str_contains(request()->route()?->getName() ?? '', '.edit')) {
            return [];
        }
        return [
            UsuariosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListColegios::route('/'),
            'create' => CreateColegio::route('/create'),
            'view' => ViewColegio::route('/{record}'),
            'edit' => EditColegio::route('/{record}/edit'),
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
