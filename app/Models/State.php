<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

=======
use Illuminate\Database\Eloquent\Model;

use Modules\Xot\Contracts\ProfileContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

>>>>>>> 5650494 (.)
/**
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
<<<<<<< HEAD
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
 * @mixin IdeHelperState
=======
 * @property-read ProfileContract|null $creator
 * @property-read ProfileContract|null $updater
 * @mixin IdeHelperState
 * @method static \Modules\Geo\Database\Factories\StateFactory factory($count = null, $state = [])
>>>>>>> 5650494 (.)
 * @mixin \Eloquent
 */
class State extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Modules\Geo\Database\Factories\StateFactory
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
