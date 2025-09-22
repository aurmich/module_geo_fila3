<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\Pages;

use Modules\Geo\Filament\Resources\LocationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewLocation extends XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;

<<<<<<< HEAD
    #[\Override]
=======
>>>>>>> 19c8248 (.)
    protected function getInfolistSchema(): array
    {
        return [
            \Filament\Infolists\Components\Section::make('Informazioni Location')
                ->schema([
<<<<<<< HEAD
                    \Filament\Infolists\Components\TextEntry::make('name')->label('Nome'),
                    \Filament\Infolists\Components\TextEntry::make('address')->label('Indirizzo'),
                    \Filament\Infolists\Components\TextEntry::make('city')->label('Città'),
                    \Filament\Infolists\Components\TextEntry::make('postal_code')->label('CAP'),
                    \Filament\Infolists\Components\TextEntry::make('country')->label('Paese'),
=======
                    \Filament\Infolists\Components\TextEntry::make('name')
                        ->label('Nome'),
                    \Filament\Infolists\Components\TextEntry::make('address')
                        ->label('Indirizzo'),
                    \Filament\Infolists\Components\TextEntry::make('city')
                        ->label('Città'),
                    \Filament\Infolists\Components\TextEntry::make('postal_code')
                        ->label('CAP'),
                    \Filament\Infolists\Components\TextEntry::make('country')
                        ->label('Paese'),
>>>>>>> 19c8248 (.)
                ])
                ->columns(2),
        ];
    }
}
