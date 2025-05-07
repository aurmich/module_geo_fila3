<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Elevation;

use Modules\Geo\Datas\LocationData;
use Modules\Geo\Exceptions\ElevationException;
use Modules\Geo\Services\GoogleMapsService;

/**
 * Classe per ottenere l'elevazione di un punto geografico.
 *
 * Questa classe utilizza il servizio Google Maps Elevation per ottenere:
 * - L'elevazione in metri sul livello del mare
 * - La risoluzione dell'elevazione
 *
 * @see https://developers.google.com/maps/documentation/elevation
 */
class GetElevationAction
{
    /**
<<<<<<< HEAD
=======
<<<<<<< HEAD
     * @param  GoogleMapsService  $googleMapsService  Servizio per le richieste a Google Maps
     */
    public function __construct(
        private readonly GoogleMapsService $googleMapsService,
    ) {}
=======
>>>>>>> 3404601 (.)
     * @param GoogleMapsService $googleMapsService Servizio per le richieste a Google Maps
     */
    public function __construct(
        private readonly GoogleMapsService $googleMapsService,
    ) {
    }
<<<<<<< HEAD
=======
>>>>>>> origin/dev
>>>>>>> 3404601 (.)

    /**
     * Ottiene l'elevazione per una posizione geografica.
     *
<<<<<<< HEAD
=======
<<<<<<< HEAD
     * @param  LocationData  $location  La posizione di cui ottenere l'elevazione
     * @return float L'elevazione in metri sul livello del mare
     *
     * @throws ElevationException Se il recupero dell'elevazione fallisce
     * @throws \InvalidArgumentException Se le coordinate non sono valide
=======
>>>>>>> 3404601 (.)
     * @param LocationData $location La posizione di cui ottenere l'elevazione
     *
     * @throws ElevationException        Se il recupero dell'elevazione fallisce
     * @throws \InvalidArgumentException Se le coordinate non sono valide
     *
     * @return float L'elevazione in metri sul livello del mare
<<<<<<< HEAD
=======
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
     */
    public function execute(LocationData $location): float
    {
        $this->validateCoordinates($location);

        try {
            $response = $this->googleMapsService->getElevation(
                $location->latitude,
                $location->longitude
            );

            if (empty($response['results']) || ! isset($response['results'][0]['elevation'])) {
                throw ElevationException::invalidResponse();
            }

            return (float) $response['results'][0]['elevation'];
        } catch (\Throwable $e) {
            if ($e instanceof ElevationException) {
                throw $e;
            }

            throw ElevationException::serviceError('Errore nel recupero dell\'elevazione: '.$e->getMessage(), $e);
        }
    }

    /**
     * Formatta l'elevazione in una stringa leggibile.
     *
<<<<<<< HEAD
     * @param float $meters Elevazione in metri
     *
=======
<<<<<<< HEAD
     * @param  float  $meters  Elevazione in metri
=======
     * @param float $meters Elevazione in metri
     *
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
     * @return string Elevazione formattata con unità di misura
     */
    public function formatElevation(float $meters): string
    {
        return sprintf('%.1f m s.l.m.', $meters);
    }

    /**
     * Valida le coordinate di una posizione.
     *
<<<<<<< HEAD
     * @param LocationData $location Posizione da validare
=======
<<<<<<< HEAD
     * @param  LocationData  $location  Posizione da validare
=======
     * @param LocationData $location Posizione da validare
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
     *
     * @throws \InvalidArgumentException Se le coordinate non sono valide
     */
    private function validateCoordinates(LocationData $location): void
    {
        if ($location->latitude < -90 || $location->latitude > 90) {
            throw new \InvalidArgumentException(sprintf('Latitudine non valida: %f', $location->latitude));
        }

        if ($location->longitude < -180 || $location->longitude > 180) {
            throw new \InvalidArgumentException(sprintf('Longitudine non valida: %f', $location->longitude));
        }
    }
}
