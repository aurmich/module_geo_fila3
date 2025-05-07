<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\IPGeolocation;

use Modules\Geo\Datas\IPLocationData;

/**
 * Classe per ottenere la posizione da un indirizzo IP.
 */
class GetLocationFromIPAction
{
    public function __construct(
        private readonly FetchIPLocationAction $fetchIPLocationAction,
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
     * Ottiene i dati di geolocalizzazione per un indirizzo IP.
     *
<<<<<<< HEAD
     * @param string $ip Indirizzo IP
     *
=======
<<<<<<< HEAD
     * @param  string  $ip  Indirizzo IP
=======
     * @param string $ip Indirizzo IP
     *
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
     * @return IPLocationData|null Dati di geolocalizzazione o null se non disponibili
     */
    public function execute(string $ip): ?IPLocationData
    {
        return $this->fetchIPLocationAction->execute($ip);
    }
}
