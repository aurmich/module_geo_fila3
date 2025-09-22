<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Nominatim;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Modules\Geo\Datas\LocationData;

use function Safe\json_decode;

/**
 * Action per cercare luoghi usando Nominatim.
 */
class SearchPlacesAction
{
    private const API_URL = 'https://nominatim.openstreetmap.org/search';

    private Client $client;

    private string $userAgent;

    public function __construct(string $userAgent)
    {
        $this->client = new Client();
<<<<<<< HEAD
        $this->userAgent = $userAgent . ' Application';
=======
        $this->userAgent = $userAgent.' Application';
>>>>>>> 19c8248 (.)
    }

    /**
     * Cerca luoghi usando una query di ricerca.
     *
     * @throws \RuntimeException Se la richiesta fallisce
     *
     * @return Collection<int, LocationData>
     */
<<<<<<< HEAD
    public function execute(string $query, null|string $country = null, int $limit = 10): Collection
=======
    public function execute(string $query, ?string $country = null, int $limit = 10): Collection
>>>>>>> 19c8248 (.)
    {
        try {
            $response = $this->makeApiRequest($query, $country, $limit);

            return $this->parseResponse($response);
        } catch (GuzzleException $e) {
<<<<<<< HEAD
            throw new \RuntimeException('Failed to search places: ' . $e->getMessage());
=======
            throw new \RuntimeException('Failed to search places: '.$e->getMessage());
>>>>>>> 19c8248 (.)
        }
    }

    /**
     * @throws GuzzleException
     */
<<<<<<< HEAD
    private function makeApiRequest(string $query, null|string $country = null, int $limit = 10): string
=======
    private function makeApiRequest(string $query, ?string $country = null, int $limit = 10): string
>>>>>>> 19c8248 (.)
    {
        $params = [
            'q' => $query,
            'format' => 'json',
            'addressdetails' => 1,
            'limit' => $limit,
            'accept-language' => 'it',
        ];

        if ($country) {
            $params['countrycodes'] = $country;
        }

        $response = $this->client->get(self::API_URL, [
            'query' => $params,
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @throws \RuntimeException Se la risposta non è nel formato atteso
     *
     * @return Collection<int, LocationData>
     */
    private function parseResponse(string $response): Collection
    {
        /** @var array<array{
         *     display_name: string,
         *     lat: string,
         *     lon: string,
         *     type: string,
         *     importance: float,
         *     address: array
         * }> $data */
        $data = json_decode($response, true);

        if (empty($data)) {
            throw new \RuntimeException('No results found for query');
        }

<<<<<<< HEAD
        return collect($data)->map(fn (array $place): LocationData => new LocationData(
                latitude: (float) $place['lat'],
                longitude: (float) $place['lon'],
                address: $place['display_name'],
            ));
=======
        return collect($data)->map(function (array $place): LocationData {
            return new LocationData(
                latitude: (float) $place['lat'],
                longitude: (float) $place['lon'],
                address: $place['display_name']
            );
        });
>>>>>>> 19c8248 (.)
    }
}
