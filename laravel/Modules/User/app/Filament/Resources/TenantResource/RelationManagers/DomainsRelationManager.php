<?php

/**
 * --.
 */
declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

class DomainsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'domains';

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
            Forms\Components\TextInput::make('domain')
                ->required()
                ->url()
                ->maxLength(255),
            Forms\Components\Toggle::make('is_active')
                ->required(),
            Forms\Components\Toggle::make('is_primary')
                ->required(),
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
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('domain')
                ->searchable()
                ->sortable(),
            Tables\Columns\IconColumn::make('is_active')
                ->boolean()
                ->sortable(),
            Tables\Columns\IconColumn::make('is_primary')
                ->boolean()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
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
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            Tables\Actions\DeleteBulkAction::make(),
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
}
