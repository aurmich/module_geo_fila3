<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\DeviceVerificationResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\TechPlanner\Filament\Resources\DeviceVerificationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListDeviceVerifications extends XotBaseListRecords
{
    protected static string $resource = DeviceVerificationResource::class;

    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'device_id' => TextColumn::make('device_id')
                ->sortable()
                ->searchable(),
            'verification_date' => TextColumn::make('verification_date')
                ->dateTime()
                ->sortable(),
            'status' => TextColumn::make('status')
                ->sortable()
                ->searchable(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
