<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Geo\Contracts\HasGeolocation;
use Modules\Geo\Enums\AddressTypeEnum;

/**
 * Class Address
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> 19c8248 (.)
 * Implementazione di Schema.org PostalAddress
 *
 * @property int $id
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $route
 * @property string|null $street_number
 * @property string|null $locality
 * @property string|null $administrative_area_level_3
 * @property string|null $administrative_area_level_2
 * @property string|null $administrative_area_level_1
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $formatted_address
 * @property string|null $place_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $type
 * @property bool $is_primary
 * @property array|null $extra_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * // implements HasGeolocation
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $addressable
 * @property-read \Modules\User\Models\Profile|null $creator
 * @property-read string $full_address
 * @property-read string $street_address
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $model
 * @property-read \Modules\User\Models\Profile|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address nearby(float $latitude, float $longitude, float $radiusKm = '10')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address ofType($type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address primary()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAdministrativeAreaLevel3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereExtraData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedBy($value)
 * @mixin IdeHelperAddress
 * @mixin \Eloquent
 */
<<<<<<< HEAD
class Address extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
=======
class Address extends BaseModel 
{
        
    /** @var list<string> */
   protected $fillable = [
>>>>>>> 19c8248 (.)
        'model_type',
        'model_id',
        'name',
        'description',
        'route',
        'street_number',
        'locality',
        'administrative_area_level_3', // comune
        'administrative_area_level_2', // provincia
        'administrative_area_level_1', // regione
<<<<<<< HEAD
        'country', // Stato/Paese
=======
        'country',// Stato/Paese
>>>>>>> 19c8248 (.)
        'postal_code',
        'formatted_address',
        'place_id',
        'latitude',
        'longitude',
        'type',
        'is_primary',
        'extra_data',
    ];
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
<<<<<<< HEAD
    #[\Override]
=======
>>>>>>> 19c8248 (.)
    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'is_primary' => 'boolean',
            'extra_data' => 'array',
            'type' => AddressTypeEnum::class,
        ];
    }
<<<<<<< HEAD

=======
    
    
>>>>>>> 19c8248 (.)
    /**
     * Get the parent model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Relazione polimorfica (alternativa con nome più descrittivo)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo('model');
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /*
     * Get the city relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
<<<<<<< HEAD
     *
     * public function city(): BelongsTo
     * {
     * return $this->belongsTo(City::class, 'locality', 'name');
     * }
     */
=======
     
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'locality', 'name');
    }
    */
>>>>>>> 19c8248 (.)
    /*
     * Get the province relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
<<<<<<< HEAD
     *
     * public function provincia(): BelongsTo
     * {
     * return $this->belongsTo(Provincia::class, 'administrative_area_level_2', 'name');
     * }
     */
=======
     
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'administrative_area_level_2', 'name');
    }
    */
>>>>>>> 19c8248 (.)
    /*
     * Get the region relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
<<<<<<< HEAD
     *
     * public function regione(): BelongsTo
     * {
     * return $this->belongsTo(Regione::class, 'administrative_area_level_1', 'name');
     * }
     */
    public function getRegione(): null|array
    {
        /** @phpstan-ignore method.unresolvableReturnType */
        $res = Comune::select('regione')
            ->distinct()
            ->orderBy('regione->nome')
            ->where('regione->codice', $this->administrative_area_level_1)
            ->get()
            /** @phpstan-ignore argument.unresolvableType */
            ->map(function ($item) {
                $regione = $item->regione;
                if (!is_array($regione) || !isset($regione['codice'], $regione['nome'])) {
                    return null;
                }
                return ['codice' => $regione['codice'], 'nome' => $regione['nome']];
            })
            ->filter();

        return $res->first();
    }

    public function getProvincia(): null|array
    {
        /** @phpstan-ignore method.unresolvableReturnType */
        $res = Comune::select('provincia')
            ->distinct()
            ->orderBy('provincia->nome')
            ->where('provincia->codice', $this->administrative_area_level_2)
            ->get()
            /** @phpstan-ignore argument.unresolvableType */
            ->map(fn ($item) => [
                    /** @phpstan-ignore offsetAccess.notFound */
                    'codice' => $item->provincia['codice'],
                    /** @phpstan-ignore offsetAccess.notFound */
                    'nome' => $item->provincia['nome'],
                ]);
        return $res->first();
    }

    public function getLocality(): null|array
    {
        /** @phpstan-ignore-next-line */
        $res = Comune::where('codice', $this->locality)
            ->distinct()
            ->first()
            ?->toArray();
        return $res;
    }

=======
     
    public function regione(): BelongsTo
    {
        return $this->belongsTo(Regione::class, 'administrative_area_level_1', 'name');
    }
     */
    public function getRegione():?array{
        /** @phpstan-ignore method.unresolvableReturnType */
        $res= Comune::select('regione')
        ->distinct()
        ->orderBy('regione->nome')
        ->where('regione->codice', $this->administrative_area_level_1)
        ->get()
        /** @phpstan-ignore argument.unresolvableType */
        ->map(function($item){
            /** @phpstan-ignore offsetAccess.notFound, offsetAccess.notFound */
            return ['codice'=>$item->regione['codice'],'nome'=>$item->regione['nome']];
        })
        ;
        
        
        return $res->first();
    }

    public function getProvincia():?array{
        /** @phpstan-ignore method.unresolvableReturnType */
        $res= Comune::select('provincia')
        ->distinct()
        ->orderBy('provincia->nome')
        ->where('provincia->codice', $this->administrative_area_level_2)
        ->get()
        /** @phpstan-ignore argument.unresolvableType */
        ->map(function($item){
            /** @phpstan-ignore-next-line */
            return [
                /** @phpstan-ignore offsetAccess.notFound */
                'codice'=>$item->provincia['codice'],
                /** @phpstan-ignore offsetAccess.notFound */
                'nome'=>$item->provincia['nome']
            ];
        })
        ;
        return $res->first();
    }


    public function getLocality():?array{
        /** @phpstan-ignore-next-line */
        $res= Comune::where('codice', $this->locality)
        ->distinct()
        ->first()
        ?->toArray()
        ;
        return $res;
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Getter per l'indirizzo completo in formato italiano
     *
     * @return string
     */
    public function getFullAddressAttribute(): string
    {
<<<<<<< HEAD
        $parts = array_filter([
            $this->route . ($this->street_number ? (' ' . $this->street_number) : ''),
=======
        
        $parts = array_filter([
            $this->route . ($this->street_number ? ' ' . $this->street_number : ''),
>>>>>>> 19c8248 (.)
            $this->locality,
            $this->administrative_area_level_3, // Provincia
            $this->administrative_area_level_2, // Regione
            $this->postal_code,
<<<<<<< HEAD
            $this->country,
=======
            $this->country
>>>>>>> 19c8248 (.)
        ]);

        return implode(', ', $parts);
    }

<<<<<<< HEAD
    public function getFullAddress(): null|string
    {
        $parts = array_filter([
            $this->route . ($this->street_number ? (' ' . $this->street_number) : ''),
=======

    public function getFullAddress(): ?string
    {
        $parts = array_filter([
            $this->route . ($this->street_number ? ' ' . $this->street_number : ''),
>>>>>>> 19c8248 (.)
            $this->locality,
            $this->administrative_area_level_3, // Provincia
            $this->administrative_area_level_2, // Regione
            $this->postal_code,
<<<<<<< HEAD
            $this->country,
=======
            $this->country
>>>>>>> 19c8248 (.)
        ]);

        return implode(', ', $parts);
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Getter per l'indirizzo strada completo
     *
     * @return string
     */
    public function getStreetAddressAttribute(): string
    {
        return trim(($this->route ?? '') . ' ' . ($this->street_number ?? ''));
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Get the formatted address.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getFormattedAddressAttribute(null|string $value): null|string
=======
    public function getFormattedAddressAttribute(?string $value): ?string
>>>>>>> 19c8248 (.)
    {
        if ($value) {
            return $value;
        }
<<<<<<< HEAD

        $parts = [];

=======
        
        $parts = [];
        
>>>>>>> 19c8248 (.)
        // Indirizzo stradale
        if ($this->route) {
            $parts[] = $this->getStreetAddressAttribute();
        }
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        // Località e provincia (formato italiano)
        $localityParts = [];
        if ($this->postal_code) {
            $localityParts[] = $this->postal_code;
        }
<<<<<<< HEAD

        if ($this->locality) {
            $localityParts[] = $this->locality;

=======
        
        if ($this->locality) {
            $localityParts[] = $this->locality;
            
>>>>>>> 19c8248 (.)
            // Per indirizzi italiani, aggiungiamo la sigla provincia
            if ($this->country === 'IT' && $this->administrative_area_level_3) {
                // Se è un'implementazione reale, potremmo derivare la sigla dalla provincia
                $provinciaSigla = $this->extra_data['provincia_sigla'] ?? null;
                if ($provinciaSigla) {
                    $localityParts[] = "({$provinciaSigla})";
                }
            }
        }
<<<<<<< HEAD

        if (!empty($localityParts)) {
            $parts[] = implode(' ', $localityParts);
        }

=======
        
        if (!empty($localityParts)) {
            $parts[] = implode(' ', $localityParts);
        }
        
>>>>>>> 19c8248 (.)
        // Regione
        if ($this->administrative_area_level_2) {
            $parts[] = $this->administrative_area_level_2;
        }
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        // Paese
        if ($this->country) {
            $countryName = $this->administrative_area_level_1 ?? $this->country;
            $parts[] = strtoupper($countryName);
        }
<<<<<<< HEAD

        return implode("\n", $parts);
    }

=======
        
        return implode("\n", $parts);
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Get the latitude of the address.
     *
     * @return float|null
     */
<<<<<<< HEAD
    public function getLatitude(): null|float
    {
        return $this->latitude;
    }

=======
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Get the longitude of the address.
     *
     * @return float|null
     */
<<<<<<< HEAD
    public function getLongitude(): null|float
    {
        return $this->longitude;
    }

=======
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Get the formatted address required by HasGeolocation interface.
     *
     * @return string
     */
    public function getFormattedAddress(): string
    {
        return $this->formatted_address ?? '';
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Restituisce i dati in formato Schema.org PostalAddress
     *
     * @return array<string, mixed>
     */
    public function toSchemaOrg(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'PostalAddress',
            'name' => $this->name,
            'description' => $this->description,
            'streetAddress' => $this->getStreetAddressAttribute(),
            'addressLocality' => $this->locality,
            'addressSubregion' => $this->administrative_area_level_3, // Provincia
            'addressRegion' => $this->administrative_area_level_2, // Regione
            'addressCountry' => $this->country,
            'postalCode' => $this->postal_code,
        ];
    }
<<<<<<< HEAD

=======
    
   
>>>>>>> 19c8248 (.)
    /**
     * Scope per cercare indirizzi nelle vicinanze
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $latitude
     * @param float $longitude
     * @param float $radiusKm
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNearby($query, float $latitude, float $longitude, float $radiusKm = 10)
    {
<<<<<<< HEAD
        return $query
            ->selectRaw('
            *,
            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
        ', [$latitude, $longitude, $latitude])
            ->having('distance', '<', $radiusKm)
            ->orderBy('distance');
    }

=======
        return $query->selectRaw("
            *,
            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
        ", [$latitude, $longitude, $latitude])
        ->having('distance', '<', $radiusKm)
        ->orderBy('distance');
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Scope a query to only include primary addresses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Scope a query to filter by address type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|AddressTypeEnum $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
<<<<<<< HEAD
        return $query->where('type', ($type instanceof AddressTypeEnum) ? $type->value : $type);
=======
        return $query->where('type', $type instanceof AddressTypeEnum ? $type->value : $type);
>>>>>>> 19c8248 (.)
    }
}
