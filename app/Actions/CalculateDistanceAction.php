<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Illuminate\Support\Collection;
use Modules\Geo\Actions\GoogleMaps\CalculateDistanceMatrixAction;
use Modules\Geo\Datas\LocationData;
use Modules\Geo\Exceptions\DistanceCalculationException;

/**
 * Classe per calcolare la distanza tra due punti geografici.
 *
 * Questa classe utilizza il servizio Google Maps Distance Matrix per calcolare:
 * - La distanza effettiva tra due punti considerando le strade
 * - Il tempo di percorrenza stimato
 * - Lo stato della richiesta
 *
 * @see https://developers.google.com/maps/documentation/distance-matrix
 */
class CalculateDistanceAction
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> aurmich/dev
=======
>>>>>>> a3e28eb (.)
=======
>>>>>>> ac8dd0e (.)
     * @param  CalculateDistanceMatrixAction  $distanceMatrixAction  Servizio per il calcolo delle distanze
     */
    public function __construct(
        private readonly CalculateDistanceMatrixAction $distanceMatrixAction,
    ) {}
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> a3e28eb (.)
=======
     * @param CalculateDistanceMatrixAction $distanceMatrixAction Servizio per il calcolo delle distanze
     */
    public function __construct(
        private readonly CalculateDistanceMatrixAction $distanceMatrixAction,
    ) {
    }
>>>>>>> 294f04a (.)
<<<<<<< HEAD
>>>>>>> aurmich/dev
=======
>>>>>>> a3e28eb (.)
=======
>>>>>>> ac8dd0e (.)

    /**
     * Calcola la distanza e il tempo di percorrenza tra due punti.
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  LocationData  $origin  Punto di origine con coordinate valide
     * @param  LocationData  $destination  Punto di destinazione con coordinate valide
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  LocationData  $origin  Punto di origine con coordinate valide
     * @param  LocationData  $destination  Punto di destinazione con coordinate valide
=======
=======
>>>>>>> a3e28eb (.)
     * @param LocationData $origin      Punto di origine con coordinate valide
     * @param LocationData $destination Punto di destinazione con coordinate valide
     *
     * @throws DistanceCalculationException Se il calcolo della distanza fallisce o restituisce dati non validi
     * @throws \InvalidArgumentException    Se le coordinate non sono valide
     *
>>>>>>> 294f04a (.)
<<<<<<< HEAD
>>>>>>> aurmich/dev
=======
>>>>>>> a3e28eb (.)
=======
     * @param  LocationData  $origin  Punto di origine con coordinate valide
     * @param  LocationData  $destination  Punto di destinazione con coordinate valide
>>>>>>> ac8dd0e (.)
     * @return array{
     *     distance: array{text: string, value: int},
     *     duration: array{text: string, value: int},
     *     status: string
     * } Array con distanza, durata e stato
<<<<<<< HEAD
<<<<<<< HEAD
     *
     * @throws DistanceCalculationException Se il calcolo della distanza fallisce o restituisce dati non validi
     * @throws \InvalidArgumentException Se le coordinate non sono valide
=======
<<<<<<< HEAD
<<<<<<< HEAD
     *
     * @throws DistanceCalculationException Se il calcolo della distanza fallisce o restituisce dati non validi
     * @throws \InvalidArgumentException Se le coordinate non sono valide
=======
>>>>>>> 294f04a (.)
>>>>>>> aurmich/dev
=======
>>>>>>> 294f04a (.)
>>>>>>> a3e28eb (.)
=======
     *
     * @throws DistanceCalculationException Se il calcolo della distanza fallisce o restituisce dati non validi
     * @throws \InvalidArgumentException Se le coordinate non sono valide
>>>>>>> ac8dd0e (.)
     */
    public function execute(LocationData $origin, LocationData $destination): array
    {
        $this->validateCoordinates($origin);
        $this->validateCoordinates($destination);

        try {
            $response = $this->distanceMatrixAction->execute(
                new Collection([$origin]),
                new Collection([$destination])
            );

            if (empty($response) || empty($response[0]) || empty($response[0][0])) {
                throw DistanceCalculationException::invalidResponse();
            }

            return $response[0][0];
        } catch (\Throwable $e) {
            throw DistanceCalculationException::calculationError('Errore nel calcolo della distanza: '.$e->getMessage(), $e);
        }
    }

    /**
     * Formatta la distanza in metri in una stringa leggibile.
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  int  $meters  Distanza in metri
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  int  $meters  Distanza in metri
=======
     * @param int $meters Distanza in metri
>>>>>>> 294f04a (.)
>>>>>>> aurmich/dev
=======
     * @param int $meters Distanza in metri
>>>>>>> 294f04a (.)
>>>>>>> a3e28eb (.)
=======
     * @param  int  $meters  Distanza in metri
>>>>>>> ac8dd0e (.)
     *
     * @throws \InvalidArgumentException Se il valore in metri è negativo
     */
    public function formatDistance(int $meters): string
    {
        if ($meters < 0) {
            throw new \InvalidArgumentException('La distanza non può essere negativa');
        }

        if ($meters < 1000) {
            return sprintf('%d m', $meters);
        }

        $kilometers = round($meters / 1000, 1);

        return sprintf('%.1f km', $kilometers);
    }

    /**
     * Valida le coordinate di una posizione.
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  LocationData  $location  Posizione da validare
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  LocationData  $location  Posizione da validare
=======
     * @param LocationData $location Posizione da validare
>>>>>>> 294f04a (.)
>>>>>>> aurmich/dev
=======
     * @param LocationData $location Posizione da validare
>>>>>>> 294f04a (.)
>>>>>>> a3e28eb (.)
=======
     * @param  LocationData  $location  Posizione da validare
>>>>>>> ac8dd0e (.)
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
