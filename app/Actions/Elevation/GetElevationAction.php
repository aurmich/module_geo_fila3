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
     * @param  GoogleMapsService  $googleMapsService  Servizio per le richieste a Google Maps
     */
    public function __construct(
        private readonly GoogleMapsService $googleMapsService,
    ) {}
=======
     * @param GoogleMapsService $googleMapsService Servizio per le richieste a Google Maps
     */
    public function __construct(
        private readonly GoogleMapsService $googleMapsService,
    ) {
    }
>>>>>>> 63c6dd4 (.)

    /**
     * Ottiene l'elevazione per una posizione geografica.
     *
<<<<<<< HEAD
     * @param  LocationData  $location  La posizione di cui ottenere l'elevazione
     * @return float L'elevazione in metri sul livello del mare
     *
     * @throws ElevationException Se il recupero dell'elevazione fallisce
     * @throws \InvalidArgumentException Se le coordinate non sono valide
=======
     * @param LocationData $location La posizione di cui ottenere l'elevazione
     *
     * @throws ElevationException        Se il recupero dell'elevazione fallisce
     * @throws \InvalidArgumentException Se le coordinate non sono valide
     *
     * @return float L'elevazione in metri sul livello del mare
>>>>>>> 63c6dd4 (.)
     */
    public function execute(LocationData $location): float
    {
        $this->validateCoordinates($location);

        try {
            /** @var array<string, mixed> $response */
            $response = $this->googleMapsService->getElevation(
                $location->latitude,
                $location->longitude
            );

<<<<<<< HEAD
            if (! isset($response['results']) || ! is_array($response['results']) || empty($response['results'])) {
=======
            if (!isset($response['results']) || !is_array($response['results']) || empty($response['results'])) {
>>>>>>> 63c6dd4 (.)
                throw ElevationException::invalidResponse();
            }

            $firstResult = $response['results'][0] ?? null;
<<<<<<< HEAD
            if (! is_array($firstResult) || ! isset($firstResult['elevation'])) {
=======
            if (!is_array($firstResult) || !isset($firstResult['elevation'])) {
>>>>>>> 63c6dd4 (.)
                throw ElevationException::invalidResponse();
            }

            return (float) $firstResult['elevation'];
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
     * @param  float  $meters  Elevazione in metri
=======
     * @param float $meters Elevazione in metri
     *
>>>>>>> 63c6dd4 (.)
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
     * @param  LocationData  $location  Posizione da validare
=======
     * @param LocationData $location Posizione da validare
>>>>>>> 63c6dd4 (.)
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
