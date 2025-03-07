<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Modules\Activity\Filament\Resources\SnapshotResource\Pages;
use Modules\Activity\Models\Snapshot;
use Modules\Xot\Filament\Resources\XotBaseResource;

class SnapshotResource extends XotBaseResource
{
    protected static ?string $model = Snapshot::class;

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('model_type')
                ->required()
                ->maxLength(255),
            TextInput::make('model_id')
                ->numeric()
                ->required(),
            KeyValue::make('state')
                ->columnSpanFull(),
            TextInput::make('created_by_type')
                ->maxLength(255),
            TextInput::make('created_by_id')
                ->numeric(),
        ];

    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSnapshots::route('/'),
            'create' => Pages\CreateSnapshot::route('/create'),
            'edit' => Pages\EditSnapshot::route('/{record}/edit'),
        ];
    }
}
