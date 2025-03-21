<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

use Filament\Pages\Page;
use Modules\Geo\Filament\Widgets;

class LocationMapTable extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'geo::filament.pages.location-map';

    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\LocationMapTableWidget::class,
            // Widgets\LocationMapWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }
}
