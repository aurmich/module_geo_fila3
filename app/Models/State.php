<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
=======
=======
>>>>>>> 0e7ec50 (.)
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 *
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
 * @mixin \Eloquent
 */
class State extends Model
{
    protected $fillable = [
        'state',
        'state_code',
    ];
}
