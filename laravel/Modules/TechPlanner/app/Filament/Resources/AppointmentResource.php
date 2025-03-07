<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Modules\TechPlanner\Models\Appointment;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * Undocumented class
 */
class AppointmentResource extends XotBaseResource
{
    protected static ?string $model = Appointment::class;

    public static function getFormSchema(): array
    {
        return [
            // Forms\Components\Select::make('client_id')
            //    ->relationship('client', 'name')
            //    ->required(),

            Forms\Components\DateTimePicker::make('date'),
            Forms\Components\Select::make('status')
                ->options([
                    'scheduled' => 'Scheduled',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->required(),
            Textarea::make('notes')
                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }
}
