<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

class ClientsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'clients';

    /**
     * Definisce lo schema del form per la relazione.
     *
     * @return array<string, Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('phone')
                ->tel()
                ->maxLength(20),
        ];
    }

    /**
     * Definisce le colonne della tabella per la relazione.
     *
     * @return array<Tables\Columns\Column>
     */
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->searchable()
                ->sortable(),
            TextColumn::make('email')
                ->searchable()
                ->sortable(),
            TextColumn::make('phone')
                ->searchable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * Definisce le azioni della tabella.
     *
     * @return array<string, Tables\Actions\Action>
     */
    protected function getTableActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }

    /**
     * Definisce le azioni bulk della tabella.
     *
     * @return array<Tables\Actions\BulkAction>
     */
    protected function getTableBulkActions(): array
    {
        return [
            DeleteBulkAction::make(),
        ];
    }

    /**
     * Definisce la configurazione della tabella.
     *
     * @return array<string, mixed>
     */
    protected function getTableConfiguration(): array
    {
        return [
            'defaultSort' => 'created_at',
            'defaultSortDirection' => 'desc',
            'recordsPerPage' => 10,
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(
                $this->getTableColumns()
            )
            ->filters(
                [
                ]
            )
            ->headerActions(
                [
                    CreateAction::make(),
                ]
            )
            ->actions(
                $this->getTableActions()
            )
            ->bulkActions(
                $this->getTableBulkActions()
            )
            ->emptyStateActions(
                [
                    // {{ tableEmptyStateActions }}
                ]
            );
    }
}
