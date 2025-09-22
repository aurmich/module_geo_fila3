<?php

declare(strict_types=1);

return [
    /*
<<<<<<< HEAD
     * |--------------------------------------------------------------------------
     * | API Keys
     * |--------------------------------------------------------------------------
     * |
     * | Chiavi API per i vari servizi di mappe utilizzati dal modulo.
     * |
     */
=======
    |--------------------------------------------------------------------------
    | API Keys
    |--------------------------------------------------------------------------
    |
    | Chiavi API per i vari servizi di mappe utilizzati dal modulo.
    |
    */
>>>>>>> 19c8248 (.)
    'api_keys' => [
        'google_maps' => env('GOOGLE_MAPS_API_KEY'),
        'bing_maps' => env('BING_MAPS_API_KEY'),
        'mapbox' => env('MAPBOX_API_KEY'),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Rate Limiting
     * |--------------------------------------------------------------------------
     * |
     * | Configurazione per il rate limiting delle chiamate API.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Configurazione per il rate limiting delle chiamate API.
    |
    */
>>>>>>> 19c8248 (.)
    'rate_limits' => [
        'google_maps' => [
            'requests_per_second' => 50,
            'burst' => 100,
        ],
        'bing_maps' => [
            'requests_per_second' => 50,
            'burst' => 100,
        ],
        'mapbox' => [
            'requests_per_second' => 50,
            'burst' => 100,
        ],
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Cache
     * |--------------------------------------------------------------------------
     * |
     * | Configurazione per la cache dei risultati.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Configurazione per la cache dei risultati.
    |
    */
>>>>>>> 19c8248 (.)
    'cache' => [
        'enabled' => true,
        'ttl' => 86400, // 24 ore
        'prefix' => 'geo_',
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Timeout & Retry
     * |--------------------------------------------------------------------------
     * |
     * | Configurazione per timeout e retry delle chiamate API.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Timeout & Retry
    |--------------------------------------------------------------------------
    |
    | Configurazione per timeout e retry delle chiamate API.
    |
    */
>>>>>>> 19c8248 (.)
    'http_client' => [
        'timeout' => 5.0,
        'retry' => [
            'times' => 3,
            'sleep' => 100,
            'when' => [
                'ConnectionException',
                'RequestException',
            ],
        ],
    ],
];
