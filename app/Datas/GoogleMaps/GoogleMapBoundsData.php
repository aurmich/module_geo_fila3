<?php

declare(strict_types=1);

namespace Modules\Geo\Datas\GoogleMaps;

use Spatie\LaravelData\Data;

class GoogleMapBoundsData extends Data
{
    public function __construct(
        public GoogleMapLocationData $northeast,
        public GoogleMapLocationData $southwest,
<<<<<<< HEAD
    ) {
    }
=======
<<<<<<< HEAD
    ) {}
=======
    ) {
    }
>>>>>>> origin/dev
>>>>>>> 3404601 (.)
}
