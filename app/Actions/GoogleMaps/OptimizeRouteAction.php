<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\GoogleMaps;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\LocationData;
use Modules\Geo\Datas\RouteData;

/**
 * Action per ottimizzare un percorso utilizzando l'API di Google Maps.
 *
 * Questa action prende una lista di punti di partenza e destinazione e
 * restituisce il percorso ottimizzato che minimizza la distanza totale
 * o il tempo di percorrenza.
 */
class OptimizeRouteAction
{
    /**
     * Ottimizza il percorso tra i punti specificati.
     *
     * @param LocationData[] $locations   Lista di punti da visitare
     * @param LocationData   $origin      Punto di partenza
     * @param LocationData   $destination Punto di arrivo
     * @param string         $mode        Modalità di trasporto (driving, walking, bicycling, transit)
     * @param string         $optimize    Criterio di ottimizzazione (distance, time)
     *
     * @return RouteData[] Lista di percorsi ottimizzati
     */
    public function execute(
        array $locations,
        LocationData $origin,
        LocationData $destination,
        string $mode = 'driving',
        string $optimize = 'distance',
    ): array {
        if (empty($locations)) {
            return [];
        }

        $apiKey = config('services.google.maps.key');
<<<<<<< HEAD
        if (!$apiKey) {
=======
        if (! $apiKey) {
>>>>>>> 19c8248 (.)
            throw new \RuntimeException('Google Maps API key not found');
        }

        $waypoints = $this->formatWaypoints($locations);
        $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
            'origin' => $this->formatLocation($origin),
            'destination' => $this->formatLocation($destination),
<<<<<<< HEAD
            'waypoints' => 'optimize:true|' . implode('|', $waypoints),
=======
            'waypoints' => 'optimize:true|'.implode('|', $waypoints),
>>>>>>> 19c8248 (.)
            'mode' => $mode,
            'optimize' => $optimize,
            'key' => $apiKey,
        ]);

<<<<<<< HEAD
        if (!$response->successful()) {
=======
        if (! $response->successful()) {
>>>>>>> 19c8248 (.)
            throw new \RuntimeException('Failed to get directions from Google Maps API');
        }

        /** @var array{routes?: array<int, array{legs: array<int, array{distance: array{text: string, value: int}, duration: array{text: string, value: int}, start_location: array{lat: float, lng: float}, end_location: array{lat: float, lng: float}, steps: array<int, array{distance: array{text: string, value: int}, duration: array{text: string, value: int}, start_location: array{lat: float, lng: float}, end_location: array{lat: float, lng: float}, html_instructions: string, travel_mode: string}>}>, overview_polyline: array{points: string}, summary: string, warnings: array<int, string>, waypoint_order: array<int, int>}>} $data */
        $data = $response->json();
<<<<<<< HEAD
        if (!isset($data['routes'][0])) {
=======
        if (! isset($data['routes'][0])) {
>>>>>>> 19c8248 (.)
            return [];
        }

        return $this->parseRoutes($data['routes'], collect($locations));
    }

    /**
     * Formatta una lista di punti nel formato richiesto dall'API.
     *
     * @param LocationData[] $locations
     *
     * @return string[]
     */
    private function formatWaypoints(array $locations): array
    {
<<<<<<< HEAD
        return collect($locations)->map($this->formatLocation(...))->all();
=======
        return collect($locations)
            ->map(
                function (LocationData $location): string {
                    return $this->formatLocation($location);
                }
            )
            ->all();
>>>>>>> 19c8248 (.)
    }

    /**
     * Formatta una singola posizione nel formato richiesto dall'API.
     */
    private function formatLocation(LocationData $location): string
    {
        return sprintf('%f,%f', $location->latitude, $location->longitude);
    }

    /**
     * Analizza la risposta dell'API e restituisce i percorsi ottimizzati.
     *
     * @param array<int, array{
     *     legs: array<int, array{
     *         distance: array{text: string, value: int},
     *         duration: array{text: string, value: int},
     *         start_location: array{lat: float, lng: float},
     *         end_location: array{lat: float, lng: float},
     *         steps: array<int, array{
     *             distance: array{text: string, value: int},
     *             duration: array{text: string, value: int},
     *             start_location: array{lat: float, lng: float},
     *             end_location: array{lat: float, lng: float},
     *             html_instructions: string,
     *             travel_mode: string
     *         }>
     *     }>,
     *     overview_polyline: array{points: string},
     *     summary: string,
     *     warnings: array<int, string>,
     *     waypoint_order: array<int, int>
     * }> $routes
     * @param Collection<int, LocationData> $originalLocations
     *
     * @return RouteData[]
     */
    private function parseRoutes(array $routes, Collection $originalLocations): array
    {
        return array_map(
            function (array $route) use ($originalLocations): RouteData {
                $waypoints = collect();
                $steps = [];
                $totalDistance = 0;
                $totalDuration = 0;

                foreach ($route['legs'] as $leg) {
                    $waypoints->push(new LocationData(
                        latitude: $leg['start_location']['lat'],
                        longitude: $leg['start_location']['lng'],
<<<<<<< HEAD
                        address: null,
=======
                        address: null
>>>>>>> 19c8248 (.)
                    ));

                    $totalDistance += $leg['distance']['value'];
                    $totalDuration += $leg['duration']['value'];

                    foreach ($leg['steps'] as $step) {
                        $steps[] = [
                            'distance' => [
                                'text' => $step['distance']['text'],
                                'value' => $step['distance']['value'],
                            ],
                            'duration' => [
                                'text' => $step['duration']['text'],
                                'value' => $step['duration']['value'],
                            ],
                            'instructions' => $step['html_instructions'],
                        ];
                    }
                }

                // Aggiungi l'ultima posizione
<<<<<<< HEAD
                if (!empty($route['legs'])) {
=======
                if (! empty($route['legs'])) {
>>>>>>> 19c8248 (.)
                    $lastLeg = end($route['legs']);
                    $waypoints->push(new LocationData(
                        latitude: $lastLeg['end_location']['lat'],
                        longitude: $lastLeg['end_location']['lng'],
<<<<<<< HEAD
                        address: null,
=======
                        address: null
>>>>>>> 19c8248 (.)
                    ));
                }

                return new RouteData(
                    waypoints: $waypoints,
                    originalWaypoints: $originalLocations,
                    totalDistance: $totalDistance,
                    totalDuration: $totalDuration,
<<<<<<< HEAD
                    steps: $steps,
                );
            },
            $routes,
=======
                    steps: $steps
                );
            },
            $routes
>>>>>>> 19c8248 (.)
        );
    }
}
