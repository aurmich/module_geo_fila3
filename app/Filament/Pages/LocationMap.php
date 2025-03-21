<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

use Filament\Pages\Page;
use Modules\Geo\Filament\Widgets\LocationMapTableWidget;
use Modules\Geo\Filament\Widgets\LocationMapWidget;

class LocationMap extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'geo::filament.pages.location-map';

    protected function getHeaderWidgets(): array
    {
        return [
            // LocationMapTableWidget::class,
            LocationMapWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }
}
