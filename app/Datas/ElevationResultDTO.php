<?php

declare(strict_types=1);

namespace Modules\Geo\Datas;

<<<<<<< HEAD
readonly class ElevationResultDTO
{
    public function __construct(
        public  float $elevation,
        public  float $latitude,
        public  float $longitude,
    ) {}
=======
class ElevationResultDTO
{
    public function __construct(
        public readonly float $elevation,
        public readonly float $latitude,
        public readonly float $longitude,
    ) {
    }
>>>>>>> 19c8248 (.)
}
