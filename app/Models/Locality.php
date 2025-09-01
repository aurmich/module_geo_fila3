<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Filament\Forms\Get;
use Illuminate\Support\Arr;
<<<<<<< HEAD

use function Safe\json_decode;
=======
use function Safe\json_decode;
use Illuminate\Database\Eloquent\Model;
>>>>>>> 63c6dd4 (.)

/**
 * @property int|null $region_id
 * @property int|null $province_id
 * @property string|null $name
 * @property int $id
 * @property string|null $postal_code
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
<<<<<<< HEAD
 *
=======
>>>>>>> 63c6dd4 (.)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Locality whereRegionId($value)
<<<<<<< HEAD
 *
=======
>>>>>>> 63c6dd4 (.)
 * @mixin IdeHelperLocality
 * @mixin \Eloquent
 */
class Locality extends BaseModel
{
    use \Sushi\Sushi;

<<<<<<< HEAD
=======
    
>>>>>>> 63c6dd4 (.)
    protected array $schema = [
        'region_id' => 'integer',
        'province_id' => 'integer',
        'id' => 'integer',
        'name' => 'string',
        'postal_code' => 'json',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'region_id' => 'integer',
            'province_id' => 'integer',
            'id' => 'integer',
            'name' => 'string',
            'postal_code' => 'array',
        ];
    }
<<<<<<< HEAD

    public function getRows(): array
    {
        $rows = Comune::select('regione->codice as region_id', 'provincia->codice as province_id', 'nome as name', 'codice as id', 'cap as postal_code')
            ->distinct()
            ->orderBy('nome')
            ->get()
            ->map(function ($row) {
                /** @phpstan-ignore offsetAccess.nonOffsetAccessible, property.notFound */
                // $postal_code=json_decode($row->postal_code)[0];
                /** @phpstan-ignore property.notFound */
                // $row->postal_code=$postal_code;
                return $row;
            });

=======
    


    public function getRows(): array{
        $rows=Comune::select("regione->codice as region_id","provincia->codice as province_id","nome as name","codice as id","cap as postal_code")
            ->distinct()
            ->orderBy("nome")
            ->get()
            ->map(function($row){
                /** @phpstan-ignore offsetAccess.nonOffsetAccessible, property.notFound */
                //$postal_code=json_decode($row->postal_code)[0];
                /** @phpstan-ignore property.notFound */
                //$row->postal_code=$postal_code;
                return $row;
            });
            
       
>>>>>>> 63c6dd4 (.)
        return $rows->toArray();
    }

    public static function getOptions(Get $get): array
    {

        $region = $get('administrative_area_level_1') ?? $get('region');
<<<<<<< HEAD
        if (! $region) {
            return [];
        }
        $province = $get('administrative_area_level_2') ?? $get('province');
        if (! $province) {
=======
        if (!$region) {
            return [];
        }
        $province = $get('administrative_area_level_2') ?? $get('province');
        if (!$province) {
>>>>>>> 63c6dd4 (.)
            return [];
        }

        $city = $get('locality');
<<<<<<< HEAD
        $res = self::where('region_id', $region)
            ->where('province_id', $province)
            ->pluck('name', 'id')
            ->toArray();
=======
        $res=self::where('region_id', $region)
        ->where('province_id', $province)
        ->pluck("name", "id")
        ->toArray();
>>>>>>> 63c6dd4 (.)

        /*
        ->when($city !== null, fn($query) => $query->where('id', $city))
        ->select('postal_code')
        ->distinct()
        ->orderBy('postal_code')
        ->get()
        ->pluck('postal_code', 'postal_code')
        ->toArray();

<<<<<<< HEAD


                        return $res ?? [];
        */
        return $res;

=======
                        
                        
                        return $res ?? [];
        */
        return $res;
        
>>>>>>> 63c6dd4 (.)
    }

    public static function getPostalCodeOptions(Get $get): array
    {
        $region = $get('administrative_area_level_1') ?? $get('region');
<<<<<<< HEAD
        if (! $region) {
            return [];
        }
        $province = $get('administrative_area_level_2') ?? $get('province');
        if (! $province) {
=======
        if (!$region) {
            return [];
        }
        $province = $get('administrative_area_level_2') ?? $get('province');
        if (!$province) {
>>>>>>> 63c6dd4 (.)
            return [];
        }

        $city = $get('locality');
<<<<<<< HEAD
        $res = self::where('region_id', $region)
            ->where('province_id', $province)
            ->when($city !== null, fn ($query) => $query->where('id', $city))
            ->select('postal_code')
            ->distinct()
            ->orderBy('postal_code')
            ->get();
        // ->pluck('postal_code', 'postal_code')
        // ->toArray()
        /** @var array<int, array<string, mixed>> $arr */
        $arr = $res->toArray();
        $arr = Arr::mapWithKeys($arr, function (array $item) {
            if (! isset($item['postal_code']) || ! is_array($item['postal_code'])) {
=======
        $res=self::where('region_id', $region)
        ->where('province_id', $province)
        ->when($city !== null, fn($query) => $query->where('id', $city))
        ->select('postal_code')
        ->distinct()
        ->orderBy('postal_code')
        ->get()
        //->pluck('postal_code', 'postal_code')
        //->toArray()
        ;
        /** @var array<int, array<string, mixed>> $arr */
        $arr=$res->toArray();
        $arr=Arr::mapWithKeys($arr, function(array $item){
            if (!isset($item['postal_code']) || !is_array($item['postal_code'])) {
>>>>>>> 63c6dd4 (.)
                return [];
            }
            /** @var array<int, string> $postalCodes */
            $postalCodes = array_values((array) $item['postal_code']);
            /** @var array<string, string> $result */
            $result = array_combine($postalCodes, $postalCodes);
<<<<<<< HEAD

            return $result;
        });

        return $arr ?? [];
    }
}
=======
            return $result;
        });
                      
        return $arr ?? [];
    }
}
>>>>>>> 63c6dd4 (.)
