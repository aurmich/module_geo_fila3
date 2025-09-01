<?php

declare(strict_types=1);

namespace Modules\Geo\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
<<<<<<< HEAD

=======
>>>>>>> 63c6dd4 (.)
use function Safe\json_decode;

/**
 * Servizio per la gestione dei dati geografici.
<<<<<<< HEAD
 *
 * Questo servizio fornisce metodi per accedere e manipolare i dati geografici
 * memorizzati nel file JSON.
 *
=======
 * 
 * Questo servizio fornisce metodi per accedere e manipolare i dati geografici
 * memorizzati nel file JSON.
 * 
>>>>>>> 63c6dd4 (.)
 * @see \Modules\Geo\docs\json-database.md
 */
class GeoDataService
{
    /**
     * Chiavi di cache.
     */
    private const CACHE_KEY_REGIONS = 'geo.regions';
<<<<<<< HEAD

    private const CACHE_KEY_PROVINCES = 'geo.provinces.%s';

    private const CACHE_KEY_CITIES = 'geo.cities.%s';

=======
    private const CACHE_KEY_PROVINCES = 'geo.provinces.%s';
    private const CACHE_KEY_CITIES = 'geo.cities.%s';
>>>>>>> 63c6dd4 (.)
    private const CACHE_KEY_CAP = 'geo.cap.%s.%s';

    /**
     * Tempo di cache in secondi (24 ore).
     */
    private const CACHE_TTL = 86400;

    /**
     * Percorso del file JSON.
     */
    private const JSON_PATH = 'Modules/Geo/resources/json/comuni.json';

    /**
     * Validatore dei dati.
     */
    private GeoDataValidator $validator;

    /**
     * Costruttore.
     */
    public function __construct()
    {
<<<<<<< HEAD
        $this->validator = new GeoDataValidator;
=======
        $this->validator = new GeoDataValidator();
>>>>>>> 63c6dd4 (.)
    }

    /**
     * Ottiene tutte le regioni.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 63c6dd4 (.)
     * @return Collection<int, array{name: string, code: string}>
     */
    public function getRegions(): Collection
    {
        /** @var Collection<int, array{name: string, code: string}> $result */
        $result = Cache::remember(
            self::CACHE_KEY_REGIONS,
            self::CACHE_TTL,
            fn (): Collection => $this->loadData()->pluck('name', 'code')
        );

        return $result;
    }

    /**
     * Ottiene le province di una regione.
<<<<<<< HEAD
     *
     * @param  string  $regionCode  Codice della regione
=======
     * 
     * @param string $regionCode Codice della regione
>>>>>>> 63c6dd4 (.)
     * @return Collection<int, array{name: string, code: string}>
     */
    public function getProvinces(string $regionCode): Collection
    {
        $cacheKey = sprintf(self::CACHE_KEY_PROVINCES, $regionCode);

        /** @var Collection<int, array{name: string, code: string}> $result */
        $result = Cache::remember(
            $cacheKey,
            self::CACHE_TTL,
            function () use ($regionCode): Collection {
                /** @var array<string, mixed>|null $region */
                $region = $this->loadData()->firstWhere('code', $regionCode);
<<<<<<< HEAD

                if (! $region || ! is_array($region) || ! isset($region['provinces']) || ! is_array($region['provinces'])) {
                    /** @var Collection<int, array{name: string, code: string}> */
                    return new Collection;
                }

                /** @var array<int, array<string, mixed>> $provinces */
                $provinces = $region['provinces'];

=======
                
                if (!$region || !is_array($region) || !isset($region['provinces']) || !is_array($region['provinces'])) {
                    /** @var Collection<int, array{name: string, code: string}> */
                    return new Collection();
                }
                
                /** @var array<int, array<string, mixed>> $provinces */
                $provinces = $region['provinces'];
                
>>>>>>> 63c6dd4 (.)
                /** @var Collection<int, array{name: string, code: string}> */
                return (new Collection($provinces))->pluck('name', 'code');
            }
        );

        return $result;
    }

    /**
     * Ottiene le città di una provincia.
<<<<<<< HEAD
     *
     * @param  string  $provinceCode  Codice della provincia
=======
     * 
     * @param string $provinceCode Codice della provincia
>>>>>>> 63c6dd4 (.)
     * @return Collection<int, array{name: string, code: string}>
     */
    public function getCities(string $provinceCode): Collection
    {
        $cacheKey = sprintf(self::CACHE_KEY_CITIES, $provinceCode);

        /** @var Collection<int, array{name: string, code: string}> $result */
        $result = Cache::remember(
            $cacheKey,
            self::CACHE_TTL,
            function () use ($provinceCode): Collection {
                /** @var array<string, mixed>|null $province */
                $province = $this->loadData()
                    ->flatMap(fn (array $region): array => is_array($region['provinces'] ?? null) ? $region['provinces'] : [])
                    ->firstWhere('code', $provinceCode);

<<<<<<< HEAD
                if (! $province || ! is_array($province) || ! isset($province['cities']) || ! is_array($province['cities'])) {
                    /** @var Collection<int, array{name: string, code: string}> */
                    return new Collection;
=======
                if (!$province || !is_array($province) || !isset($province['cities']) || !is_array($province['cities'])) {
                    /** @var Collection<int, array{name: string, code: string}> */
                    return new Collection();
>>>>>>> 63c6dd4 (.)
                }

                /** @var array<int, array<string, mixed>> $cities */
                $cities = $province['cities'];

                /** @var Collection<int, array{name: string, code: string}> */
                return (new Collection($cities))->pluck('name', 'code');
            }
        );

        return $result;
    }

    /**
     * Ottiene il CAP di una città.
<<<<<<< HEAD
     *
     * @param  string  $provinceCode  Codice della provincia
     * @param  string  $cityCode  Codice della città
=======
     * 
     * @param string $provinceCode Codice della provincia
     * @param string $cityCode Codice della città
     * @return string|null
>>>>>>> 63c6dd4 (.)
     */
    public function getCap(string $provinceCode, string $cityCode): ?string
    {
        $cacheKey = sprintf(self::CACHE_KEY_CAP, $provinceCode, $cityCode);

        /** @var string|null $result */
        $result = Cache::remember(
            $cacheKey,
            self::CACHE_TTL,
            function () use ($provinceCode, $cityCode): ?string {
                /** @var array<string, mixed>|null $province */
                $province = $this->loadData()
                    ->flatMap(fn (array $region): array => is_array($region['provinces'] ?? null) ? $region['provinces'] : [])
                    ->firstWhere('code', $provinceCode);

<<<<<<< HEAD
                if (! $province || ! is_array($province) || ! isset($province['cities']) || ! is_array($province['cities'])) {
=======
                if (!$province || !is_array($province) || !isset($province['cities']) || !is_array($province['cities'])) {
>>>>>>> 63c6dd4 (.)
                    return null;
                }

                /** @var array<int, array<string, mixed>> $cities */
                $cities = $province['cities'];

                /** @var Collection<int, array<string, mixed>> $cityCollection */
                $cityCollection = new Collection($cities);

                /** @var array<string, mixed>|null $city */
                $city = $cityCollection->firstWhere('code', $cityCode);

                return is_array($city) && isset($city['cap']) && is_string($city['cap']) ? $city['cap'] : null;
            }
        );

        return $result;
    }

    /**
     * Carica i dati dal file JSON.
<<<<<<< HEAD
     *
     * @return Collection<int, array>
     *
=======
     * 
     * @return Collection<int, array>
>>>>>>> 63c6dd4 (.)
     * @throws \RuntimeException Se il file non esiste o non è valido
     */
    private function loadData(): Collection
    {
<<<<<<< HEAD
        if (! File::exists(base_path(self::JSON_PATH))) {
=======
        if (!File::exists(base_path(self::JSON_PATH))) {
>>>>>>> 63c6dd4 (.)
            throw new \RuntimeException('Il file JSON dei comuni non esiste');
        }

        /** @var array $data */
        $data = json_decode(File::get(base_path(self::JSON_PATH)), true);

<<<<<<< HEAD
        if (! $this->validator->checkIntegrity($data)) {
=======
        if (!$this->validator->checkIntegrity($data)) {
>>>>>>> 63c6dd4 (.)
            throw new \RuntimeException('Il file JSON dei comuni non è valido');
        }

        /** @var Collection<int, array> $result */
        $result = new Collection($data['regions']);

        return $result;
    }

    /**
     * Pulisce la cache.
<<<<<<< HEAD
=======
     * 
     * @return void
>>>>>>> 63c6dd4 (.)
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY_REGIONS);
        // Nota: forgetPattern non esiste in Laravel Cache, usiamo forget per le chiavi specifiche
        // In un'implementazione reale, dovremmo mantenere traccia delle chiavi create
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> 63c6dd4 (.)
