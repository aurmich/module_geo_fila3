<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Set;
use Illuminate\Support\Collection;
use Modules\Geo\Models\Place;
use Modules\Xot\Filament\Pages\XotBasePage;

/**
 * Pagina per visualizzare la mappa dei luoghi.
 */
class DotswanMap extends XotBasePage
{
    public array $location;

    /**
     * @return Collection<int, array{lat: float, lng: float, title: string}>
     */
    public function getMapMarkers(): Collection
    {
        /** @var Collection<int, Place> $places */
<<<<<<< HEAD
        $places = Place::query()->whereNotNull(['latitude', 'longitude'])->get();

        return $places->map(fn(Place $place): array => [
=======
        $places = Place::query()
            ->whereNotNull(['latitude', 'longitude'])
            ->get();

        return $places->map(fn (Place $place): array => [
>>>>>>> 19c8248 (.)
            'lat' => (float) $place->latitude,
            'lng' => (float) $place->longitude,
            'title' => (string) ($place->getAttribute('name') ?? 'Unnamed Place'),
        ]);
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    public function getFormSchema(): array
    {
        return [
            Map::make('location')
                ->label('Location')
                ->columnSpanFull()
<<<<<<< HEAD
                ->afterStateUpdated(function (Set $set, null|array $state): void {
=======
                ->afterStateUpdated(function (Set $set, ?array $state): void {
>>>>>>> 19c8248 (.)
                    if (is_array($state)) {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    }
                })
<<<<<<< HEAD
                ->afterStateHydrated(function ($_state, $record, Set $set): void {
=======
                ->afterStateHydrated(function ($state, $record, Set $set): void {
>>>>>>> 19c8248 (.)
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
                ->showMyLocationButton()
                ->extraTileControl([]),
        ];
    }
}
