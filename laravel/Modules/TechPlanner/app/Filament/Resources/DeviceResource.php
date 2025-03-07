<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Modules\TechPlanner\Filament\Resources\DeviceResource\Pages;
use Modules\TechPlanner\Filament\Resources\DeviceResource\RelationManagers;
use Modules\TechPlanner\Models\Device;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * Undocumented class
 */
class DeviceResource extends XotBaseResource
{
    protected static ?string $model = Device::class;

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('serial_number')
                ->required()
                ->maxLength(255),
            TextInput::make('model')
                ->required()
                ->maxLength(255),
            TextInput::make('manufacturer')
                ->required()
                ->maxLength(255),
            DatePicker::make('purchase_date')
                ->required(),
            DatePicker::make('warranty_expiration')
                ->required(),
            Forms\Components\Textarea::make('notes')
                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'view' => Pages\ViewDevice::route('/{record}'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DeviceVerificationsRelationManager::class,
        ];
    }
}
