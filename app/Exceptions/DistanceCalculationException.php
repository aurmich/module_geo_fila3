<?php

declare(strict_types=1);

namespace Modules\Geo\Exceptions;

/**
 * Eccezione lanciata quando si verificano errori durante il calcolo della distanza.
 */
class DistanceCalculationException extends \RuntimeException
{
    /**
     * Crea una nuova istanza per risposta non valida.
     */
<<<<<<< HEAD
    public static function invalidResponse(string $message = 'Risposta non valida dal servizio di calcolo distanze'): self {
=======
    public static function invalidResponse(string $message = 'Risposta non valida dal servizio di calcolo distanze'): self
    {
>>>>>>> 19c8248 (.)
        return new self($message);
    }

    /**
     * Crea una nuova istanza per coordinate non valide.
     */
    public static function invalidCoordinates(string $message = 'Coordinate non valide'): self
    {
        return new self($message);
    }

    /**
     * Crea una nuova istanza per errore di calcolo.
     */
<<<<<<< HEAD
    public static function calculationError(string $message, null|\Throwable $previous = null): self
=======
    public static function calculationError(string $message, ?\Throwable $previous = null): self
>>>>>>> 19c8248 (.)
    {
        return new self($message, 0, $previous);
    }
}
