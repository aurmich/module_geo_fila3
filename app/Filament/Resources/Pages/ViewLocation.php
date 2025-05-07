<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\Pages;

<<<<<<< HEAD
=======
<<<<<<< HEAD
use Filament\Infolists\Components\TextEntry;
=======
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
use Modules\Geo\Filament\Resources\LocationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewLocation extends XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;

<<<<<<< HEAD
=======
<<<<<<< HEAD
    public function getInfolistSchema(): array
    {
        return [
            TextEntry::make('id'),
            TextEntry::make('name'),
            TextEntry::make('created_at')
                ->dateTime(),
            TextEntry::make('updated_at')
                ->dateTime(),
=======
>>>>>>> 3404601 (.)
    protected function getInfolistSchema(): array
    {
        return [
            \Filament\Infolists\Components\Section::make('Informazioni Location')
                ->schema([
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
                ])
                ->columns(2),
<<<<<<< HEAD
=======
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
        ];
    }
}
