<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\IPGeolocation;

use Modules\Geo\Datas\IPLocationData;

/**
 * Classe per ottenere la posizione da un indirizzo IP.
 */
<<<<<<< HEAD
readonly class GetLocationFromIPAction
{
    public function __construct(
        private  FetchIPLocationAction $fetchIPLocationAction,
    ) {}
=======
class GetLocationFromIPAction
{
    public function __construct(
        private readonly FetchIPLocationAction $fetchIPLocationAction,
    ) {
    }
>>>>>>> 19c8248 (.)

    /**
     * Ottiene i dati di geolocalizzazione per un indirizzo IP.
     *
     * @param string $ip Indirizzo IP
     *
     * @return IPLocationData|null Dati di geolocalizzazione o null se non disponibili
     */
<<<<<<< HEAD
    public function execute(string $ip): null|IPLocationData
=======
    public function execute(string $ip): ?IPLocationData
>>>>>>> 19c8248 (.)
    {
        return $this->fetchIPLocationAction->execute($ip);
    }
}
