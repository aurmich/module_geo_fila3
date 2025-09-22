<?php

declare(strict_types=1);

namespace Modules\Geo\Datas\Photon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PhotonResponseData extends Data
{
    public function __construct(
        #[DataCollectionOf(PhotonFeatureData::class)]
<<<<<<< HEAD
        public null|DataCollection $features,
    ) {}
=======
        public ?DataCollection $features,
    ) {
    }
>>>>>>> 19c8248 (.)
}
