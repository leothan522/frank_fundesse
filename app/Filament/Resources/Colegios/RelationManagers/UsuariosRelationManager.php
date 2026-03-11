<?php

namespace App\Filament\Resources\Colegios\RelationManagers;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UsuariosRelationManager extends RelationManager
{
    protected static string $relationship = 'usuarios';

    protected static ?string $modelLabel = 'usuario';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->maxLength(255)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->maxLength(255)
                    ->unique()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->columnSpanFull(),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->minLength(8)
                    ->maxLength(15)
                    ->required()
                    ->hiddenOn('edit')
                    ->columnSpanFull(),
                Hidden::make('access_panel')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(UserResource::columnsUser())
            ->headerActions([
                CreateAction::make()
                    ->modalWidth(Width::Small)
                    ->createAnother(false),
                AssociateAction::make()
                    ->modalWidth(Width::Small)
                    ->recordSelectSearchColumns(['name', 'email'])
                    ->associateAnother(false),
            ])
            ->recordActions([
                ActionGroup::make([
                    UserResource::actionResetPassword(),
                    UserResource::actionValidarEmail(),
                    EditAction::make()
                        ->modalWidth(Width::Small),
                    DissociateAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make()
                        ->authorizeIndividualRecords('delete'),
                ]),
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
            ]);
    }
}
