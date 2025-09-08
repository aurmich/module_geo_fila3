<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string|null $name
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geo\Models\Province> $provinces
 * @property-read int|null $provinces_count
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereName($value)
 *
 * @mixin IdeHelperRegion
 *
 * @method static \Modules\Geo\Database\Factories\RegionFactory factory($count = null, $state = [])
 * @method static Region|null first()
 * @method static \Illuminate\Database\Eloquent\Collection<int, Region> get()
 * @method static Region create(array $attributes = [])
 * @method static Region firstOrCreate(array $attributes = [], array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region where(string|\Closure $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereNotNull(string|\Illuminate\Contracts\Database\Query\Expression $columns)
 * @method static int count(string $columns = '*')
 *
 * @mixin \Eloquent
 */
class Region extends BaseModel
{
    use HasFactory;
    use \Sushi\Sushi;

    /**
     * The factory class for this model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Factories\Factory>
     */
    protected static $factory = \Modules\Geo\Database\Factories\RegionFactory::class;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    protected array $schema = [
        'id' => 'integer',
        'name' => 'string',
    ];

    public function getRows(): array
    {
        $rows = Comune::select('regione->codice as id', 'regione->nome as name')
            ->distinct()
            ->orderBy('regione->nome')
            ->get();

        return $rows->toArray();
    }

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }

    public static function getOptions(Get $get): array
    {
        return self::orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
