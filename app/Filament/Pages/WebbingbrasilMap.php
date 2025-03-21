<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

use Filament\Pages\Page;
use Modules\Geo\Filament\Widgets\WebbingbrasilMap as Map;

class WebbingbrasilMap extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'geo::filament.pages.webbingbrasil-map';

    protected function getHeaderWidgets(): array
    {
        return [
            // LocationMapTableWidget::class,
            Map::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }
}
