<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources;

use Filament\Forms;
use Modules\Xot\Filament\Resources\SessionResource\Pages;
use Modules\Xot\Models\Session;

class SessionResource extends XotBaseResource
{
    protected static ?string $model = Session::class;

    /**
     * Get the form schema for the resource.
     *
     * @return array<string, Forms\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return [
            'id' => Forms\Components\TextInput::make('id')
                ->required()
                ->maxLength(255),
            'user_id' => Forms\Components\TextInput::make('user_id')
                ->numeric(),
            'ip_address' => Forms\Components\TextInput::make('ip_address')
                ->maxLength(45),
            'user_agent' => Forms\Components\TextInput::make('user_agent')
                ->maxLength(255),
            'payload' => Forms\Components\Textarea::make('payload')
                ->required(),
            'last_activity' => Forms\Components\DateTimePicker::make('last_activity')
                ->required(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSessions::route('/'),
            'create' => Pages\CreateSession::route('/create'),
            'edit' => Pages\EditSession::route('/{record}/edit'),
        ];
    }
}
