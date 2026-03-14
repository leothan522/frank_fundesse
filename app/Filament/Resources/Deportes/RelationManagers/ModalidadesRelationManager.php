<?php

namespace App\Filament\Resources\Deportes\RelationManagers;

use App\Models\Modalidad;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ModalidadesRelationManager extends RelationManager
{
    protected static string $relationship = 'modalidades';

    protected static bool $isLazy = false;

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->unique()
                    ->maxLength(255)
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->placeholder('Para reglas breves o detalles específicos')
                    ->columnSpanFull(),
                TextInput::make('edad_minima')
                    ->label('Edad mínima')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                TextInput::make('edad_maxima')
                    ->label('Edad máxima')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Select::make('genero')
                    ->label('Género')
                    ->options(['femenino' => 'Femenino', 'masculino' => 'Masculino', 'mixto' => 'Mixto'])
                    ->required(),
                Select::make('tipo_participacion')
                    ->label('Tipo participación')
                    ->options(['individual' => 'Individual', 'colectivo' => 'Colectivo'])
                    ->required(),
                TextInput::make('min_participantes')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->minValue(1),
                TextInput::make('max_participantes')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->minValue(1),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
                    ->hiddenOn('create')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                TextColumn::make('modalidad')
                    ->default(fn (Modalidad $record): string => Str::ucwords($record->nombre))
                    ->description(fn (Modalidad $record): string => Str::ucfirst($record->genero))
                    ->hiddenFrom('md'),
                TextColumn::make('nombre')
                    ->formatStateUsing(fn (string $state): string => Str::ucwords($state))
                    ->wrap()
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('edad_minima')
                    ->label('Edad mínima')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('edad_maxima')
                    ->label('Edad máxima')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('genero')
                    ->label('Género')
                    ->badge()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('tipo_participacion')
                    ->label('Tipo participación')
                    ->badge()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('min_participantes')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('xl'),
                TextColumn::make('max_participantes')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('xl'),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->createAnother(false)
                    ->modalWidth(Width::Small),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->modalWidth(Width::Small),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
            ]);
    }
}
