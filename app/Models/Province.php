<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 19c8248 (.)

/**
 * @property int|null $region_id
 * @property int $id
 * @property string|null $name
<<<<<<< HEAD
 * @property-read \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geo\Models\Locality> $localities
 * @property-read int|null $localities_count
 * @property-read \Modules\Geo\Models\Region|null $region
 * @property-read \Modules\Xot\Contracts\ProfileContract|null $updater
=======
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geo\Models\Locality> $localities
 * @property-read int|null $localities_count
 * @property-read \Modules\Geo\Models\Region|null $region
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
>>>>>>> 19c8248 (.)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereRegionId($value)
 * @mixin IdeHelperProvince
 * @mixin \Eloquent
 */
class Province extends BaseModel
{
    use HasFactory;
    use \Sushi\Sushi;

    protected array $schema = [
        'region_id' => 'integer',
        'id' => 'integer',
        'name' => 'string',
    ];

<<<<<<< HEAD
    public function getRows(): array
    {
        $rows = Comune::select('regione->codice as region_id', 'provincia->codice as id', 'provincia->nome as name')
            ->distinct()
            ->orderBy('provincia->nome')
            ->get();

=======

    public function getRows(): array{
        $rows=Comune::select("regione->codice as region_id","provincia->codice as id","provincia->nome as name")
            ->distinct()
            ->orderBy("provincia->nome")
            ->get();
       
>>>>>>> 19c8248 (.)
        return $rows->toArray();
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class);
    }

    public static function getOptions(Get $get): array
    {
<<<<<<< HEAD
        $region = $get('administrative_area_level_1') ?? $get('region');
        return self::where('region_id', $region)
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
=======
        $region=$get('administrative_area_level_1') ?? $get('region');
        return self::where('region_id',$region)
            ->orderBy('name')
            ->get()
            ->pluck("name", "id")
            ->toArray();

            
    }
}
>>>>>>> 19c8248 (.)
