<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages;

use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

/**
 * Undocumented class
 */
class ListPhoneCalls extends XotBaseListRecords
{
    protected static string $resource = PhoneCallResource::class;

    public function getListTableColumns(): array
    {
        return [
            'date' => Tables\Columns\TextColumn::make('date')
                ->sortable(),
            'duration' => Tables\Columns\TextColumn::make('duration')
                ->sortable(),
            'notes' => Tables\Columns\TextColumn::make('notes')
                ->limit(50),
            'call_type' => Tables\Columns\TextColumn::make('call_type')
                ->sortable(),
        ];
    }
}
