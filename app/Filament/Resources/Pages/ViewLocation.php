<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\Pages;

use Filament\Infolists\Components\TextEntry;
use Modules\Geo\Filament\Resources\LocationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewLocation extends XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;

    public function getInfolistSchema(): array
    {
        return [
            TextEntry::make('id'),
            TextEntry::make('name'),
            TextEntry::make('created_at')
                ->dateTime(),
            TextEntry::make('updated_at')
                ->dateTime(),
        ];
    }
}
