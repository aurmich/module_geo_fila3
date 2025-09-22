<?php

declare(strict_types=1);

namespace Modules\Geo\Datas\Map;

use Spatie\LaravelData\Data;

class IconData extends Data
{
    public function __construct(
        public string $url,
        public SizeData $scaledSize,
<<<<<<< HEAD
    ) {}
=======
    ) {
    }
>>>>>>> 19c8248 (.)
}
