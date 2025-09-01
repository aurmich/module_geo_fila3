<?php

declare(strict_types=1);

namespace Modules\Geo\Services;

<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
>>>>>>> 63c6dd4 (.)
use Modules\Geo\Exceptions\GoogleMaps\GoogleMapsApiException;

/**
 * Servizio per le interazioni con l'API di Google Maps.
 */
class GoogleMapsService extends BaseGeoService
{
    private const GEOCODING_URL = 'https://maps.googleapis.com/maps/api/geocode/json';

    private const DISTANCE_MATRIX_URL = 'https://maps.googleapis.com/maps/api/distancematrix/json';

    private const ELEVATION_URL = 'https://maps.googleapis.com/maps/api/elevation/json';

    protected function getServiceName(): string
    {
        return 'google_maps';
    }

    /**
     * Esegue una richiesta di geocodifica inversa.
     *
<<<<<<< HEAD
     *
     * @return array<string, mixed>
     *
     * @throws GoogleMapsApiException Se la richiesta fallisce
=======
     * @throws GoogleMapsApiException Se la richiesta fallisce
     *
     * @return array<string, mixed>
>>>>>>> 63c6dd4 (.)
     */
    public function reverseGeocode(float $latitude, float $longitude): array
    {
        try {
            return $this->makeRequest('GET', self::GEOCODING_URL, [
                'latlng' => "{$latitude},{$longitude}",
                'key' => $this->getApiKey(),
                'language' => 'it',
            ]);
        } catch (\Throwable $e) {
            throw GoogleMapsApiException::requestFailed($e->getMessage());
        }
    }

    /**
     * Calcola la matrice delle distanze.
     *
<<<<<<< HEAD
     * @param  array<string>  $origins  Punti di origine (formato: "lat,lng|lat,lng|...")
     * @param  array<string>  $destinations  Punti di destinazione (formato: "lat,lng|lat,lng|...")
     * @return array<string, mixed>
     *
     * @throws GoogleMapsApiException Se la richiesta fallisce
=======
     * @param array<string> $origins      Punti di origine (formato: "lat,lng|lat,lng|...")
     * @param array<string> $destinations Punti di destinazione (formato: "lat,lng|lat,lng|...")
     *
     * @throws GoogleMapsApiException Se la richiesta fallisce
     *
     * @return array<string, mixed>
>>>>>>> 63c6dd4 (.)
     */
    public function getDistanceMatrix(array $origins, array $destinations): array
    {
        try {
            return $this->makeRequest('GET', self::DISTANCE_MATRIX_URL, [
                'origins' => implode('|', $origins),
                'destinations' => implode('|', $destinations),
                'key' => $this->getApiKey(),
                'language' => 'it',
                'units' => 'metric',
            ]);
        } catch (\Throwable $e) {
            throw GoogleMapsApiException::requestFailed($e->getMessage());
        }
    }

    /**
     * Ottiene l'elevazione per un punto.
     *
<<<<<<< HEAD
     *
     * @return array<string, mixed>
     *
     * @throws GoogleMapsApiException Se la richiesta fallisce
=======
     * @throws GoogleMapsApiException Se la richiesta fallisce
     *
     * @return array<string, mixed>
>>>>>>> 63c6dd4 (.)
     */
    public function getElevation(float $latitude, float $longitude): array
    {
        try {
            return $this->makeRequest('GET', self::ELEVATION_URL, [
                'locations' => "{$latitude},{$longitude}",
                'key' => $this->getApiKey(),
            ]);
        } catch (\Throwable $e) {
            throw GoogleMapsApiException::requestFailed($e->getMessage());
        }
    }
<<<<<<< HEAD
=======






>>>>>>> 63c6dd4 (.)
}
