<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;

>>>>>>> 63c6dd4 (.)
/**
 * @method static \Illuminate\Database\Eloquent\Builder|County newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County query()
<<<<<<< HEAD
 *
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
 *
=======
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
>>>>>>> 63c6dd4 (.)
 * @mixin IdeHelperCounty
 * @mixin \Eloquent
 */
class County extends BaseModel
{
    protected $fillable = [
        'state_id',
        'county',
        'state_index',
    ];
}
