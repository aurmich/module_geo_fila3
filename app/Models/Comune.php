<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

<<<<<<< HEAD
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Modules\Tenant\Models\Traits\SushiToJson;
use Sushi\Sushi;

/**
 * Modello per i comuni italiani con Sushi.
 *
=======
use Sushi\Sushi;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\Tenant\Models\Traits\SushiToJson;

/**
 * Modello per i comuni italiani con Sushi.
 * 
>>>>>>> 63c6dd4 (.)
 * Implementa il pattern Facade per fornire un'interfaccia unificata a tutti i dati geografici:
 * regioni, province, città, CAP, codici ISTAT, ecc.
 * Tutti i dati sono estratti da file JSON e gestiti tramite Sushi.
 *
 * @property int $id
 * @property string $nome
 * @property string $codice
 * @property string $regione
 * @property string $provincia
 * @property string $sigla_provincia
 * @property string $cap
 * @property string $codice_catastale
 * @property int $popolazione
 * @property string $zona_altimetrica
 * @property int $altitudine
 * @property float $superficie
 * @property float $lat
 * @property float $lng
 * @property array<array-key, mixed>|null $zona
 * @property string|null $sigla
 * @property string|null $codiceCatastale
 * @property-read \Modules\User\Models\Profile|null $creator
 * @property-read \Modules\User\Models\Profile|null $updater
<<<<<<< HEAD
 *
=======
>>>>>>> 63c6dd4 (.)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereCodice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereCodiceCatastale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune wherePopolazione($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereRegione($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereSigla($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comune whereZona($value)
<<<<<<< HEAD
 *
=======
>>>>>>> 63c6dd4 (.)
 * @mixin IdeHelperComune
 * @mixin \Eloquent
 */
class Comune extends BaseModel
{
<<<<<<< HEAD
    use SushiToJson;

    public string $jsonDirectory = '';
=======

    use SushiToJson;

    public string $jsonDirectory='';
>>>>>>> 63c6dd4 (.)

    /** @var array<int, string> */
    public $translatable = [
    ];
<<<<<<< HEAD

=======
    
>>>>>>> 63c6dd4 (.)
    /** @var list<string> */
    protected $fillable = [
        'id',
        'codice',
        'nome',
        'regione',
        'provincia',
        'sigla_provincia',
        'cap',
        'codice_catastale',
        'popolazione',
        'zona_altimetrica',
        'altitudine',
        'superficie',
        'lat',
        'lng',
    ];

    protected array $schema = [
        'id' => 'integer',
        'title' => 'json',
        'slug' => 'string',
        'content' => 'string',

        'zona' => 'json',
        'provincia' => 'json',
        'regione' => 'json',
        'cap' => 'json',

        'created_at' => 'datetime',
        'updated_at' => 'datetime',

        'created_by' => 'string',
        'updated_by' => 'string',
    ];

    public function getJsonFile(): string
    {
        return module_path('Geo', 'resources/json/comuni.json');
    }

    public function getRows(): array
    {
        return $this->getSushiRows();
    }

    /** @return array<string, string>     */
    protected function casts(): array
    {
        return [
            'regione' => 'array',
            'zona' => 'array',
            'provincia' => 'array',
            'cap' => 'array',
        ];
    }

    /**
     * Get all regions
     *
     * @return Collection<string>
     */
    public static function getRegioni(): Collection
    {
        /** @phpstan-ignore return.type */
        return static::all()->pluck('regione')->unique()->sort()->values();
    }

    /**
     * Get all provinces for a region
     *
<<<<<<< HEAD
=======
     * @param string $regione
>>>>>>> 63c6dd4 (.)
     * @return Collection<string>
     */
    public static function getProvinceByRegione(string $regione): Collection
    {
        /** @phpstan-ignore return.type */
        return static::where('regione', $regione)
            ->pluck('provincia')
            ->unique()
            ->sort()
            ->values();
    }

    /**
     * Get all comuni for a province
     *
<<<<<<< HEAD
=======
     * @param string $provincia
>>>>>>> 63c6dd4 (.)
     * @return Collection<static>
     */
    public static function getComuniByProvincia(string $provincia): Collection
    {
        /** @phpstan-ignore return.type */
        return static::where('provincia', $provincia)
            ->orderBy('nome')
            ->get();
    }

    /**
     * Find a comune by name (case insensitive)
     *
<<<<<<< HEAD
     * @param  string  $nome  The name of the comune to find (case insensitive)
=======
     * @param string $nome The name of the comune to find (case insensitive)
>>>>>>> 63c6dd4 (.)
     * @return static|null The found comune or null if not found
     */
    public static function findByNome(string $nome): ?self
    {
        /** @phpstan-ignore return.type */
        return static::all()->first(function ($comune) use ($nome) {
            return strtolower($comune->nome) === strtolower($nome);
        });
    }

    /**
     * Find comuni by CAP code (partial match supported)
     *
<<<<<<< HEAD
     * @param  string  $cap  The CAP code to search for
=======
     * @param string $cap The CAP code to search for
>>>>>>> 63c6dd4 (.)
     * @return Collection<static> Collection of matching comuni
     */
    public static function findByCap(string $cap): Collection
    {
        /** @phpstan-ignore return.type */
        return static::where('cap', 'like', "%{$cap}%")->get();
    }

    /**
     * Find a city by ID
<<<<<<< HEAD
     *
=======
     * 
     * @param int $id
>>>>>>> 63c6dd4 (.)
     * @return array{id: int, nome: string, provincia: string, regione: string, cap: string, codice_catastale: string, popolazione: int, altitudine: int, superficie: float, lat: float, lng: float, zona_altimetrica: string}|null
     */
    public static function findComune(int $id): ?array
    {
        $comune = static::query()->where('id', $id)->first();
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        /** @phpstan-ignore return.type */
        return $comune ? $comune->toArray() : null;
    }

    /**
     * Get the directory where Comune JSON files are stored.
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 63c6dd4 (.)
     */
    public function getJsonDirectory(): string
    {
        return $this->jsonDirectory;
    }

    /**
     * Set the directory where Comune JSON files are stored.
<<<<<<< HEAD
=======
     *
     * @param string $directory
     * @return void
>>>>>>> 63c6dd4 (.)
     */
    public function setJsonDirectory(string $directory): void
    {
        $this->jsonDirectory = $directory;
    }
}
