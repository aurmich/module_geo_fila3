<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Illuminate\Support\Collection;
use Modules\Geo\Datas\LocationData;

/**
 * Action per ottimizzare l'ordine di un percorso minimizzando la distanza totale.
 */
<<<<<<< HEAD
readonly class OptimizeRouteAction
{
    public function __construct(
        private  CalculateDistanceAction $calculateDistance,
    ) {}
=======
class OptimizeRouteAction
{
    public function __construct(
        private readonly CalculateDistanceAction $calculateDistance,
    ) {
    }
>>>>>>> 19c8248 (.)

    /**
     * Ottimizza l'ordine dei punti minimizzando la distanza totale.
     *
     * @param Collection<int, LocationData> $locations
     *
     * @return Collection<int, LocationData>
     */
    public function execute(Collection $locations): Collection
    {
        if ($locations->count() <= 2) {
            return $locations;
        }

        /** @var LocationData $firstLocation */
        $firstLocation = $locations->first();
        $optimizedLocations = collect([$firstLocation]);
        $remainingLocations = $locations->slice(1);

        while ($remainingLocations->isNotEmpty()) {
            /** @var LocationData $currentLocation */
            $currentLocation = $optimizedLocations->last();
            $nearestLocation = $this->findNearestLocation($currentLocation, $remainingLocations);

            if (null === $nearestLocation) {
                break;
            }

            $optimizedLocations->push($nearestLocation);
<<<<<<< HEAD
            $remainingLocations = $remainingLocations->reject(
                fn(LocationData $location) => $location === $nearestLocation,
            );
=======
            $remainingLocations = $remainingLocations->reject(fn (LocationData $location) => $location === $nearestLocation);
>>>>>>> 19c8248 (.)
        }

        return $optimizedLocations;
    }

    /**
     * Trova il punto più vicino a quello corrente.
     *
     * @param Collection<int, LocationData> $locations
     */
<<<<<<< HEAD
    private function findNearestLocation(LocationData $currentLocation, Collection $locations): null|LocationData
=======
    private function findNearestLocation(LocationData $currentLocation, Collection $locations): ?LocationData
>>>>>>> 19c8248 (.)
    {
        $nearestLocation = null;
        $shortestDistance = PHP_FLOAT_MAX;

        foreach ($locations as $location) {
            $distanceResult = $this->calculateDistance->execute(
                origin: $currentLocation,
<<<<<<< HEAD
                destination: $location,
=======
                destination: $location
>>>>>>> 19c8248 (.)
            );

            // Estrai il valore numerico della distanza
            $distance = (float) ($distanceResult['distance']['value'] ?? PHP_FLOAT_MAX);

            if ($distance < $shortestDistance) {
                $shortestDistance = $distance;
                $nearestLocation = $location;
            }
        }

        return $nearestLocation;
    }
}
