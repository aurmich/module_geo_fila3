<?php

namespace Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLegalOffices extends XotBaseListRecords
{
    protected static string $resource = LegalOfficeResource::class;

    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable(),
            'name' => TextColumn::make('name')
                ->searchable()
                ->sortable(),
            'address' => TextColumn::make('address')
                ->searchable(),
            'phone' => TextColumn::make('phone')
                ->searchable(),
            'email' => TextColumn::make('email')
                ->searchable()
                ->sortable(),
        ];
    }
}
