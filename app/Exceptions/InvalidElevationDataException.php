<?php

declare(strict_types=1);

namespace Modules\Geo\Exceptions;

class InvalidElevationDataException extends \Exception
{
<<<<<<< HEAD
    public function __construct(
        string $message = 'Invalid elevation data',
        int $code = 0,
        null|\Exception $previous = null,
    ) {
=======
    public function __construct(string $message = 'Invalid elevation data', int $code = 0, ?\Exception $previous = null)
    {
>>>>>>> 19c8248 (.)
        parent::__construct($message, $code, $previous);
    }
}
