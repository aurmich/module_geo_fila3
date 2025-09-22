<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Photon;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Modules\Geo\Datas\AddressData;
use Modules\Geo\Datas\Photon\PhotonAddressData;
<<<<<<< HEAD
use Webmozart\Assert\Assert;

use function Safe\json_decode;

=======

use function Safe\json_decode;

use Webmozart\Assert\Assert;

>>>>>>> 19c8248 (.)
/**
 * Action per ottenere l'indirizzo e le coordinate tramite Photon.
 *
 * Questa classe utilizza l'API Photon per convertire
 * un indirizzo in coordinate geografiche e dettagli dell'indirizzo.
 */
<<<<<<< HEAD
readonly class GetAddressFromPhotonAction
=======
class GetAddressFromPhotonAction
>>>>>>> 19c8248 (.)
{
    private const API_URL = 'https://photon.komoot.io/api';

    public function __construct(
<<<<<<< HEAD
        private  Client $client,
    ) {}
=======
        private readonly Client $client,
    ) {
    }
>>>>>>> 19c8248 (.)

    /**
     * Ottiene i dettagli dell'indirizzo utilizzando Photon.
     */
<<<<<<< HEAD
    public function execute(string $address): null|AddressData
=======
    public function execute(string $address): ?AddressData
>>>>>>> 19c8248 (.)
    {
        $this->validateInput($address);

        try {
            $response = $this->makeApiRequest($address);
            /** @var array{features: array<array{properties: array<string, mixed>, geometry: array{coordinates: array<float>}}>} $data */
            $data = json_decode($response, true);

            if (empty($data['features'][0])) {
                return null;
            }

            $photonData = PhotonAddressData::fromPhotonFeature($data['features'][0]);

            return new AddressData(
                latitude: $photonData->coordinates['latitude'],
                longitude: $photonData->coordinates['longitude'],
                country: $photonData->country,
                city: $photonData->city,
                postal_code: (int) ($photonData->postcode ?: 0),
                street: $photonData->street,
<<<<<<< HEAD
                street_number: $photonData->housenumber,
=======
                street_number: $photonData->housenumber
>>>>>>> 19c8248 (.)
            );
        } catch (\Exception $e) {
            Log::error('Exception during Photon API request', [
                'exception' => $e->getMessage(),
                'address' => $address,
            ]);

            return null;
        }
    }

    /**
     * Valida i dati di input.
     */
    private function validateInput(string $address): void
    {
        Assert::notEmpty($address, 'Address cannot be empty');
        Assert::maxLength($address, 200, 'Address is too long');
    }

    /**
     * Effettua la richiesta all'API di Photon.
     *
     * @throws GuzzleException Se la richiesta fallisce
     */
    private function makeApiRequest(string $address): string
    {
        $response = $this->client->get(self::API_URL, [
            'query' => [
                'q' => $address,
                'limit' => 1,
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
