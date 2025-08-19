<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\AddressResource\Pages;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Geo\Filament\Resources\AddressResource;


class ListAddresses extends XotBaseListRecords
{
    protected static string $resource = AddressResource::class;

    /**
     * @return array<\Filament\Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->sortable()
                ->searchable(),
            TextColumn::make('name')
                ->label('Nome')
                ->sortable()
                ->searchable(),
            TextColumn::make('formatted_address')
                ->label('Indirizzo')
                ->limit(50)
                ->searchable(),
            TextColumn::make('locality')
                ->label('Località')
                ->sortable()
                ->searchable(),
            TextColumn::make('type')
                ->label('Tipo')
                ->badge()
                ->sortable(),
            TextColumn::make('is_primary')
                ->label('Primario')
                ->boolean()
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Creato')
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * @return array<\Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}