<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
<<<<<<< HEAD
 *
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
 *
=======
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
>>>>>>> 63c6dd4 (.)
 * @mixin IdeHelperState
 * @mixin \Eloquent
 */
class State extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
<<<<<<< HEAD
=======
     *
     * @return \Modules\Geo\Database\Factories\StateFactory
>>>>>>> 63c6dd4 (.)
     */
    protected static function newFactory(): \Modules\Geo\Database\Factories\StateFactory
    {
        return \Modules\Geo\Database\Factories\StateFactory::new();
    }

    protected $fillable = [
        'state',
        'state_code',
    ];
}
