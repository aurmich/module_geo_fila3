<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\Pages;

<<<<<<< HEAD
use Filament\Infolists\Components\TextEntry;
=======
>>>>>>> aurmich/dev
use Modules\Geo\Filament\Resources\LocationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewLocation extends XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;

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
>>>>>>> aurmich/dev
        ];
    }
}
