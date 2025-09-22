<?php

declare(strict_types=1);

namespace Modules\Geo\Enums;

/**
 * Enum per i tipi di indirizzi
 */
enum AddressTypeEnum: string
{
    case HOME = 'home';
    case WORK = 'work';
    case BILLING = 'billing';
    case SHIPPING = 'shipping';
    case LEGAL = 'legal';
    case OTHER = 'other';
<<<<<<< HEAD

    /**
     * Get the label for the enum value.
     *
=======
    
    /**
     * Get the label for the enum value.
     * 
>>>>>>> 19c8248 (.)
     * @return string
     */
    public function label(): string
    {
<<<<<<< HEAD
        return match ($this) {
=======
        return match($this) {
>>>>>>> 19c8248 (.)
            self::HOME => 'Casa',
            self::WORK => 'Lavoro',
            self::BILLING => 'Fatturazione',
            self::SHIPPING => 'Spedizione',
            self::LEGAL => 'Sede legale',
            self::OTHER => 'Altro',
        };
    }
<<<<<<< HEAD

    /**
     * Get all the options as key-value pairs.
     *
=======
    
    /**
     * Get all the options as key-value pairs.
     * 
>>>>>>> 19c8248 (.)
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::HOME->value => self::HOME->label(),
            self::WORK->value => self::WORK->label(),
            self::BILLING->value => self::BILLING->label(),
            self::SHIPPING->value => self::SHIPPING->label(),
            self::LEGAL->value => self::LEGAL->label(),
            self::OTHER->value => self::OTHER->label(),
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 19c8248 (.)
