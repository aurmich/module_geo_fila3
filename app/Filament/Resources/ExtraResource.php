<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Modules\Xot\Filament\Resources\ExtraResource\Pages;
use Modules\Xot\Models\Extra;

class ExtraResource extends XotBaseResource
{
    protected static ?string $model = Extra::class;

    /**
     * Get the form schema for the resource.
     *
     * @return array<string, Forms\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return [
            'post_type' => Forms\Components\TextInput::make('post_type')
                ->required()
                ->maxLength(255),
            'post_id' => Forms\Components\TextInput::make('post_id')
                ->required()
                ->numeric(),
            'value' => Forms\Components\TextInput::make('value')
                ->required(),
            'key' => Forms\Components\TextInput::make('key')
                ->required()
                ->maxLength(255),
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
            'index' => Pages\ListExtras::route('/'),
            'create' => Pages\CreateExtra::route('/create'),
            'edit' => Pages\EditExtra::route('/{record}/edit'),
        ];
    }
}
