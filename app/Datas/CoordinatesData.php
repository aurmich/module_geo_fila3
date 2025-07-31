<?php

declare(strict_types=1);

namespace Modules\Geo\Datas;

use Spatie\LaravelData\Data;

class CoordinatesData extends Data
{
<<<<<<< HEAD
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
    ) {
    }
=======
    public float $latitude;

    public float $longitude;
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
}
