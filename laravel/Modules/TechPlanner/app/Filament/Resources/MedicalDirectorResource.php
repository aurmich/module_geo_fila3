<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Forms;
use Modules\TechPlanner\Models\MedicalDirector;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * Undocumented class
 */
class MedicalDirectorResource extends XotBaseResource
{
    protected static ?string $model = MedicalDirector::class;

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('license_number')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('specialization')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('phone')
                ->tel()
                ->required()
                ->maxLength(255),
            Forms\Components\DatePicker::make('license_expiry')
                ->required(),
            Forms\Components\Textarea::make('notes')
                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }
}
