<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View as ViewFacade;
use Modules\Geo\Models\Place;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;

/**
 * Widget per visualizzare una mappa con una posizione.
 *
 * Questo widget estende MapWidget per mostrare una mappa interattiva
 * che può visualizzare una posizione specifica con un marker.
 * La mappa può essere configurata per mostrare diversi tipi di vista
 * (strada, satellite, ibrida) e può essere personalizzata con controlli
 * e stili specifici.
 */
class LocationMapWidget extends MapWidget
{
    protected int|string|array $columnSpan = 'full';

    public Htmlable|string|null $heading = 'Mappa';

    protected const CACHE_TTL = 3600;

    protected function getViewData(): array
    {
        return [
            'heading' => $this->heading,
            'maxHeight' => $this->getMaxHeight(),
            'options' => $this->getOptions(),
            'markers' => $this->getMarkers(),
        ];
    }

    /**
     * Restituisce l'altezza massima del widget.
     */
<<<<<<< HEAD
    protected function getMaxHeight(): null|string
    {
        $height = $this->maxHeight ?? '50vh';
        return is_string($height) ? $height : ((string) $height);
=======
    protected function getMaxHeight(): ?string
    {
        $height = $this->maxHeight ?? '50vh';
        return is_string($height) ? $height : (string) $height;
>>>>>>> 19c8248 (.)
    }

    /**
     * Restituisce le opzioni di configurazione della mappa.
     *
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        /** @var array<string, mixed> $config */
        $config = Config::get('maps', []);

        return [
<<<<<<< HEAD
            'zoom' => is_numeric($config['zoom'] ?? null) ? ((int) $config['zoom']) : 12,
=======
            'zoom' => is_numeric($config['zoom'] ?? null) ? (int) $config['zoom'] : 12,
>>>>>>> 19c8248 (.)
            'center' => $this->getMapCenter(),
            'mapTypeId' => is_string($config['type'] ?? null) ? $config['type'] : 'roadmap',
            'mapTypeControl' => true,
            'streetViewControl' => true,
            'fullscreenControl' => true,
            'zoomControl' => true,
            'styles' => [],
        ];
    }

    /**
     * Restituisce i luoghi da visualizzare sulla mappa.
     *
     * @return Collection<int, Place>
     */
    /** @return Collection<int, Place> */
    /**
     * @return Collection<int, Place>
     */
    public function getPlaces(): Collection
    {
        /* @var Collection<int, Place> */
        return Place::with(['placeType'])->get();
    }

    /**
     * Restituisce i marker da visualizzare sulla mappa.
     *
     * @return array<int, array{
     *     position: array{lat: float, lng: float},
     *     title: string,
     *     icon?: array{url: string, scaledSize: array{width: int, height: int}}
     * }>
     */
    public function getMarkers(): array
    {
        return $this->getPlaces()
            ->filter(fn(Place $place) => $place->latitude !== null && $place->longitude !== null)
            ->map(function (Place $place): array {
                $marker = [
                    'position' => [
                        'lat' => (float) $place->latitude,
                        'lng' => (float) $place->longitude,
                    ],
                    'title' => (string) ($place->name ?? 'Unnamed Place'),
                ];

                $icon = $this->getMarkerIcon($place);
                if ($icon !== null) {
                    $marker['icon'] = $icon;
                }

                return $marker;
<<<<<<< HEAD
            })
            ->all();
=======
            })->all();
>>>>>>> 19c8248 (.)
    }

    /**
     * Restituisce il centro della mappa.
     *
     * @return array{lat: float, lng: float}
     */
    protected function getMapCenter(): array
    {
        /** @var array<string, mixed> $config */
        $config = Config::get('maps', []);
        $defaultLat = 45.4642;
        $defaultLng = 9.1900;

        /** @var array<string, mixed>|null $centerConfig */
        $centerConfig = $config['center'] ?? null;

        return [
<<<<<<< HEAD
            'lat' => is_array($centerConfig) && is_numeric($centerConfig['lat'] ?? null)
                ? ((float) $centerConfig['lat'])
                : $defaultLat,
            'lng' => is_array($centerConfig) && is_numeric($centerConfig['lng'] ?? null)
                ? ((float) $centerConfig['lng'])
=======
            'lat' => is_array($centerConfig) && is_numeric($centerConfig['lat'] ?? null) 
                ? (float) $centerConfig['lat'] 
                : $defaultLat,
            'lng' => is_array($centerConfig) && is_numeric($centerConfig['lng'] ?? null) 
                ? (float) $centerConfig['lng'] 
>>>>>>> 19c8248 (.)
                : $defaultLng,
        ];
    }

    /**
     * Restituisce l'icona per un marker.
     *
     * @return array{url: string, scaledSize: array{width: int, height: int}}|null
     */
<<<<<<< HEAD
    protected function getMarkerIcon(Place $place): null|array
=======
    protected function getMarkerIcon(Place $place): ?array
>>>>>>> 19c8248 (.)
    {
        /** @var array{
         *     icons?: array<string, array{
         *         url: string,
         *         size: array{int, int}
         *     }>
         * } $config */
        $config = Config::get('maps.markers', []);

        $placeType = $place->placeType;
        if (!$placeType) {
            return null;
        }

        // Recupero slug in modo sicuro senza accesso diretto alla proprietà
        /** @var string|null $slug */
        $slug = data_get($placeType, 'slug');

        if (!is_string($slug) || !isset($config['icons'][$slug])) {
            return null;
        }

        /** @var array{url: string, size: array{int, int}} $icon */
        $icon = $config['icons'][$slug];

        if (!isset($icon['url']) || !is_string($icon['url'])) {
            return null;
        }

        return [
            'url' => asset($icon['url']),
            'scaledSize' => [
                'width' => (int) ($icon['size'][0] ?? 32),
                'height' => (int) ($icon['size'][1] ?? 32),
            ],
        ];
    }

    public function render(): View
    {
        /** @var view-string $viewName */
        $viewName = 'geo::filament.widgets.location-map-widget';
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        return ViewFacade::make($viewName, $this->getViewData());
    }
}
