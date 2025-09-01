<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\CoordinatesData;

class GetCoordinatesByAddressAction
{
    public function execute(string $address): ?CoordinatesData
    {
        // Prova con Google Maps
        $coordinates = $this->getFromGoogle($address);

        if (! $coordinates) {
            // Prova con Bing Maps
            $coordinates = $this->getFromBing($address);
        }

        if (! $coordinates) {
            // Prova con OpenCage
            $coordinates = $this->getFromOpenCage($address);
        }

        if (! $coordinates) {
            // Prova con OpenStreetMap Nominatim
            $coordinates = $this->getFromNominatim($address);
        }

        if (! $coordinates) {
            // Prova con OpenAPI Geocoding
            $coordinates = $this->getFromOpenApi($address);
        }

        if (! $coordinates) {
            Notification::make()
                ->title('Error')
                ->body('Failed to fetch coordinates from all providers.')
                ->danger()
                ->persistent()
                ->send();
        }

        return $coordinates;
    }

    /**
     * Ottiene la risposta dall'API di Google Maps.
     *
     * @return array{results: array<int, array{geometry: array{location: array{lat: float, lng: float}}}>}
     */
    private function getGoogleResponse(string $address): array
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $address,
            'key' => config('services.google.maps_api_key'),
        ]);

        if (! $response->successful()) {
            return ['results' => []];
        }

        /** @var array{results?: array<int, array{geometry: array{location: array{lat: float, lng: float}}}>} $data */
        $data = $response->json() ?? [];
<<<<<<< HEAD

        if (! isset($data['results'])) {
            return ['results' => []];
        }

=======
        
        if (!isset($data['results'])) {
            return ['results' => []];
        }
        
>>>>>>> 63c6dd4 (.)
        return ['results' => $data['results']];
    }

    private function getFromGoogle(string $address): ?CoordinatesData
    {
        $data = $this->getGoogleResponse($address);

        if (empty($data['results'])) {
            return null;
        }

        $firstResult = $data['results'][0] ?? [];
        $location = $firstResult['geometry']['location'] ?? null;

<<<<<<< HEAD
        if (! is_array($location) || ! isset($location['lat'], $location['lng'])) {
=======
        if (!is_array($location) || !isset($location['lat'], $location['lng'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        return CoordinatesData::from([
            'latitude' => (float) $location['lat'],
<<<<<<< HEAD
            'longitude' => (float) $location['lng'],
=======
            'longitude' => (float) $location['lng']
>>>>>>> 63c6dd4 (.)
        ]);
    }

    /**
     * Ottiene la risposta dall'API di Bing Maps.
     *
     * @return array<string, mixed>
     */
    private function getBingResponse(string $address, string $apiKey): array
    {
        $response = Http::get('http://dev.virtualearth.net/REST/v1/Locations', [
            'q' => $address,
            'key' => $apiKey,
        ]);

        if (! $response->successful()) {
            return [];
        }

        $data = $response->json();
<<<<<<< HEAD

        if (! is_array($data) || ! isset($data['resourceSets'])) {
            return ['resourceSets' => []];
        }

=======
        
        if (!is_array($data) || !isset($data['resourceSets'])) {
            return ['resourceSets' => []];
        }
        
>>>>>>> 63c6dd4 (.)
        return ['resourceSets' => $data['resourceSets']];
    }

    private function getFromBing(string $address): ?CoordinatesData
    {
        $apiKey = config('services.bing.maps_api_key');
<<<<<<< HEAD
        if (! is_string($apiKey) || $apiKey === '') {
=======
        if (!is_string($apiKey) || $apiKey === '') {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $data = $this->getBingResponse($address, $apiKey);

        // Type-safe navigation attraverso la struttura Bing response
<<<<<<< HEAD
        if (! isset($data['resourceSets']) || ! is_array($data['resourceSets'])) {
=======
        if (!isset($data['resourceSets']) || !is_array($data['resourceSets'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $resourceSets = $data['resourceSets'];
<<<<<<< HEAD
        if (empty($resourceSets[0]) || ! is_array($resourceSets[0])) {
=======
        if (empty($resourceSets[0]) || !is_array($resourceSets[0])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $firstResourceSet = $resourceSets[0];
<<<<<<< HEAD
        if (! isset($firstResourceSet['resources']) || ! is_array($firstResourceSet['resources'])) {
=======
        if (!isset($firstResourceSet['resources']) || !is_array($firstResourceSet['resources'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $resources = $firstResourceSet['resources'];
<<<<<<< HEAD
        if (empty($resources[0]) || ! is_array($resources[0])) {
=======
        if (empty($resources[0]) || !is_array($resources[0])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $firstResource = $resources[0];
<<<<<<< HEAD
        if (! isset($firstResource['point']) || ! is_array($firstResource['point'])) {
=======
        if (!isset($firstResource['point']) || !is_array($firstResource['point'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $point = $firstResource['point'];
<<<<<<< HEAD
        if (! isset($point['coordinates']) || ! is_array($point['coordinates'])) {
=======
        if (!isset($point['coordinates']) || !is_array($point['coordinates'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $coordinates = $point['coordinates'];
        if (count($coordinates) < 2) {
            return null;
        }

        return new CoordinatesData(
            latitude: (float) ($coordinates[0] ?? 0),
            longitude: (float) ($coordinates[1] ?? 0)
        );
    }

    /**
     * Ottiene la risposta dall'API di OpenCage.
     *
     * @return array{results: array<int, array{geometry: array{lat: float, lng: float}}>}
     */
    private function getOpenCageResponse(string $address, string $apiKey): array
    {
        $response = Http::get('https://api.opencagedata.com/geocode/v1/json', [
            'q' => $address,
            'key' => $apiKey,
        ]);

        if (! $response->successful()) {
            return ['results' => []];
        }

        /** @var array{results?: array<int, array{geometry: array{lat: float, lng: float}}>} $data */
        $data = $response->json();
<<<<<<< HEAD

        if (! is_array($data) || ! isset($data['results'])) {
            return ['results' => []];
        }

=======
        
        if (!is_array($data) || !isset($data['results'])) {
            return ['results' => []];
        }
        
>>>>>>> 63c6dd4 (.)
        return ['results' => $data['results']];
    }

    private function getFromOpenCage(string $address): ?CoordinatesData
    {
        $apiKey = config('services.opencage.api_key');
<<<<<<< HEAD
        if (! is_string($apiKey) || $apiKey === '') {
=======
        if (!is_string($apiKey) || $apiKey === '') {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        $data = $this->getOpenCageResponse($address, $apiKey);

        if (empty($data['results'])) {
            return null;
        }

        $location = $data['results'][0]['geometry'] ?? [];

<<<<<<< HEAD
        if (! isset($location['lat'], $location['lng'])) {
=======
        if (!isset($location['lat'], $location['lng'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        return CoordinatesData::from([
            'latitude' => (float) $location['lat'],
<<<<<<< HEAD
            'longitude' => (float) $location['lng'],
=======
            'longitude' => (float) $location['lng']
>>>>>>> 63c6dd4 (.)
        ]);
    }

    /**
     * @return array<int, array{lat: string, lon: string}>
     */
    private function getNominatimResponse(string $address): array
    {
        $response = Http::get('https://nominatim.openstreetmap.org/search', [
            'q' => $address,
            'format' => 'json',
            'limit' => 1,
        ]);

        if (! $response->successful()) {
            return [];
        }

        /** @var array<int, array{lat: string, lon: string}>|null $data */
        $data = $response->json();
<<<<<<< HEAD

=======
>>>>>>> 63c6dd4 (.)
        return is_array($data) ? array_values(array_filter($data, 'is_array')) : [];
    }

    private function getFromNominatim(string $address): ?CoordinatesData
    {
        $data = $this->getNominatimResponse($address);

        if (empty($data[0])) {
            return null;
        }

        $location = $data[0];

<<<<<<< HEAD
        if (! isset($location['lat'], $location['lon'])) {
=======
        if (!isset($location['lat'], $location['lon'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        return CoordinatesData::from([
            'latitude' => (float) $location['lat'],
<<<<<<< HEAD
            'longitude' => (float) $location['lon'],
=======
            'longitude' => (float) $location['lon']
>>>>>>> 63c6dd4 (.)
        ]);
    }

    /**
     * @return array{results: array<int, array{latitude: float, longitude: float}>}
     */
    private function getOpenApiResponse(string $address): array
    {
        $response = Http::get('https://api.open-meteo.com/v1/geocoding', [
            'name' => $address,
            'count' => 1,
        ]);

        if (! $response->successful()) {
            return ['results' => []];
        }

        /** @var array{results?: array<int, array{latitude: float, longitude: float}>} $data */
        $data = $response->json() ?? [];
<<<<<<< HEAD

        if (! isset($data['results'])) {
            return ['results' => []];
        }

=======
        
        if (!isset($data['results'])) {
            return ['results' => []];
        }
        
>>>>>>> 63c6dd4 (.)
        return ['results' => $data['results']];
    }

    private function getFromOpenApi(string $address): ?CoordinatesData
    {
        $data = $this->getOpenApiResponse($address);

        if (empty($data['results'])) {
            return null;
        }

        $firstResult = $data['results'][0] ?? [];

<<<<<<< HEAD
        if (! isset($firstResult['latitude'], $firstResult['longitude'])) {
=======
        if (!isset($firstResult['latitude'], $firstResult['longitude'])) {
>>>>>>> 63c6dd4 (.)
            return null;
        }

        return CoordinatesData::from([
            'latitude' => (float) $firstResult['latitude'],
<<<<<<< HEAD
            'longitude' => (float) $firstResult['longitude'],
=======
            'longitude' => (float) $firstResult['longitude']
>>>>>>> 63c6dd4 (.)
        ]);
    }
}
