<?php

declare(strict_types=1);

namespace Modules\Geo\Contracts;

/**
 * Interfaccia per modelli che supportano la geolocalizzazione.
 */
interface HasGeolocation
{
    /**
     * Ottiene la latitudine.
     */
<<<<<<< HEAD
    public function getLatitude(): null|float;
=======
    public function getLatitude(): ?float;
>>>>>>> 19c8248 (.)

    /**
     * Ottiene la longitudine.
     */
<<<<<<< HEAD
    public function getLongitude(): null|float;
=======
    public function getLongitude(): ?float;
>>>>>>> 19c8248 (.)

    /**
     * Ottiene l'indirizzo formattato.
     */
<<<<<<< HEAD
    public function getFormattedAddress(): null|string;
=======
    public function getFormattedAddress(): ?string;
>>>>>>> 19c8248 (.)

    /**
     * Verifica se le coordinate sono valide.
     */
    public function hasValidCoordinates(): bool;

    /**
     * Ottiene il tipo di luogo.
     */
<<<<<<< HEAD
    public function getLocationType(): null|string;
=======
    public function getLocationType(): ?string;
>>>>>>> 19c8248 (.)

    /**
     * Ottiene l'icona per la mappa.
     */
<<<<<<< HEAD
    public function getMapIcon(): null|string;
=======
    public function getMapIcon(): ?string;
>>>>>>> 19c8248 (.)
}
