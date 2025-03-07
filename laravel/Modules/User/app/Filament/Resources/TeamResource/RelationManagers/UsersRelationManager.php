<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\User\Filament\Resources\UserResource;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

class UsersRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $inverseRelationship = 'teams';

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Definisce lo schema del form per la relazione.
     *
     * @return array<string, Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return UserResource::getFormSchema();
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
            Tables\Columns\TextColumn::make('email')
                ->searchable()
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
