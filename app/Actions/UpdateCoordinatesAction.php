<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Modules\Geo\Models\Place;

/**
 * Action per aggiornare le coordinate di un luogo.
 */
<<<<<<< HEAD
readonly class UpdateCoordinatesAction
{
    public function __construct(
        private  GetCoordinatesAction $getCoordinates,
    ) {}
=======
class UpdateCoordinatesAction
{
    public function __construct(
        private readonly GetCoordinatesAction $getCoordinates,
    ) {
    }
>>>>>>> 19c8248 (.)

    /**
     * Aggiorna le coordinate di un luogo usando il suo indirizzo.
     *
     * @throws \RuntimeException Se non è possibile ottenere le coordinate
     */
    public function execute(Place $place): void
    {
<<<<<<< HEAD
        if (!$place->address || !is_string($place->address->formatted_address)) {
=======
        if (! $place->address || ! is_string($place->address->formatted_address)) {
>>>>>>> 19c8248 (.)
            throw new \RuntimeException('Place address is required');
        }

        $location = $this->getCoordinates->execute($place->address->formatted_address);

<<<<<<< HEAD
        if (!$location) {
            throw new \RuntimeException('Could not get coordinates for address: ' . $place->address->formatted_address);
=======
        if (! $location) {
            throw new \RuntimeException('Could not get coordinates for address: '.$place->address->formatted_address);
>>>>>>> 19c8248 (.)
        }

        $place->update([
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
        ]);
    }
}
