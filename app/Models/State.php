<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;

/**
<<<<<<< HEAD
 * 
 *
=======
>>>>>>> 70c8c33 (.)
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @mixin \Eloquent
 */
class State extends Model
{
    protected $fillable = [
        'state',
        'state_code',
    ];
}
