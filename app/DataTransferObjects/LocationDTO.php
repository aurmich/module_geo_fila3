<?php

declare(strict_types=1);

namespace Modules\Geo\DataTransferObjects;

use Modules\Geo\Datas\LocationData;

/**
 * Data Transfer Object per le posizioni geografiche.
 */
class LocationDTO
{
    /**
<<<<<<< HEAD
     * @param float       $latitude  Latitudine in gradi decimali
     * @param float       $longitude Longitudine in gradi decimali
     * @param string|null $name      Nome opzionale della posizione
=======
<<<<<<< HEAD
     * @param  float  $latitude  Latitudine in gradi decimali
     * @param  float  $longitude  Longitudine in gradi decimali
     * @param  string|null  $name  Nome opzionale della posizione
=======
     * @param float       $latitude  Latitudine in gradi decimali
     * @param float       $longitude Longitudine in gradi decimali
     * @param string|null $name      Nome opzionale della posizione
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
     */
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly ?string $name = null,
<<<<<<< HEAD
    ) {
    }
=======
<<<<<<< HEAD
    ) {}
=======
    ) {
    }
>>>>>>> origin/dev
>>>>>>> 3404601 (.)

    /**
     * Crea una nuova istanza da un oggetto LocationData.
     */
    public static function fromLocationData(LocationData $data): self
    {
        return new self(
            latitude: $data->latitude,
            longitude: $data->longitude,
            name: $data->name,
        );
    }

    /**
     * Converte l'oggetto in un'istanza di LocationData.
     */
    public function toLocationData(): LocationData
    {
        return new LocationData(
            latitude: $this->latitude,
            longitude: $this->longitude,
            name: $this->name,
        );
    }
}
