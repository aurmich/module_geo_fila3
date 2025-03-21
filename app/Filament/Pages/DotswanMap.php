<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Set;
use Filament\Pages\Page;

class DotswanMap extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'geo::filament.pages.dotswan-map';

    public array $location;

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    protected function getFormSchema(): array
    {
        return [
            Map::make('location')
                ->label('Location')
                ->columnSpanFull()
                // ->default([
                //     'lat' => 40.4168,
                //     'lng' => -3.7038
                // ])
                ->afterStateUpdated(function (Set $set, ?array $state): void {
                    if (is_array($state)) {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    }
                })
                ->afterStateHydrated(function ($state, $record, Set $set): void {
                    $set('location', ['lat' => $record->latitude, 'lng' => $record->longitude]);
                })
                ->extraStyles([
                    'min-height: 80vh',
                    'border-radius: 50px',
                ])
                ->liveLocation()
                ->showMarker()
                ->markerColor('#22c55eff')
                ->showFullscreenControl()
                ->showZoomControl()
                ->draggable()
                ->tilesUrl('https://tile.openstreetmap.de/{z}/{x}/{y}.png')
                // ->zoom(15)
                // ->detectRetina()
                ->showMyLocationButton()
                ->extraTileControl([]),
            // ->extraControl([
            //     'zoomDelta'           => 1,
            //     'zoomSnap'            => 2,
            // ])
        ];
    }
}
