<?php

namespace Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLegalRepresentatives extends XotBaseListRecords
{
    protected static string $resource = LegalRepresentativeResource::class;

    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable(),
            'name' => TextColumn::make('name')
                ->searchable()
                ->sortable(),
            'identification_number' => TextColumn::make('identification_number')
                ->searchable(),
            'phone' => TextColumn::make('phone')
                ->searchable(),
            'email' => TextColumn::make('email')
                ->searchable()
                ->sortable(),
        ];
    }
}
