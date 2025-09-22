<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\LocationResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Geo\Filament\Resources\LocationResource;

class ListLocations extends ListRecords
{
    protected static string $resource = LocationResource::class;

<<<<<<< HEAD
    protected static null|string $title = 'All Locations';
=======
    protected static ?string $title = 'All Locations';
>>>>>>> 19c8248 (.)

    protected function getHeaderWidgets(): array
    {
        return [
            //            LocationResource\Widgets\LocationMapWidget::class,
        ];
    }

    //    protected function getTableFiltersFormWidth(): string
    //    {
    //        return '4xl';
    //    }
}
