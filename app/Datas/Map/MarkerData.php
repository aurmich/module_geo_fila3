<?php

declare(strict_types=1);

namespace Modules\Geo\Datas\Map;

use Spatie\LaravelData\Data;

class MarkerData extends Data
{
    public function __construct(
        public PositionData $position,
<<<<<<< HEAD
        public null|string $title = null,
        public null|IconData $icon = null,
    ) {}
=======
        public ?string $title = null,
        public ?IconData $icon = null,
    ) {
    }
>>>>>>> 19c8248 (.)
}
