<?php

declare(strict_types=1);

namespace Modules\Geo\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Geo\Enums\AddressTypeEnum;
use Modules\Geo\Models\Address;

/**
 * Trait HasAddresses
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> 19c8248 (.)
 * Questo trait fornisce funzionalità per gestire indirizzi multipli su qualsiasi modello.
 */
trait HasAddresses
{
    /**
     * Relazione a tutti gli indirizzi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'model');
    }

    /**
     * Relazione all'indirizzo principale.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function primaryAddress(): MorphOne
    {
<<<<<<< HEAD
        return $this->morphOne(Address::class, 'model')->where('is_primary', true);
=======
        return $this->morphOne(Address::class, 'model')
            ->where('is_primary', true);
>>>>>>> 19c8248 (.)
    }

    /**
     * Relazione all'indirizzo di casa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function homeAddress(): MorphOne
    {
<<<<<<< HEAD
        return $this->morphOne(Address::class, 'model')->where('type', AddressTypeEnum::HOME->value);
=======
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::HOME->value);
>>>>>>> 19c8248 (.)
    }

    /**
     * Relazione all'indirizzo di lavoro.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function workAddress(): MorphOne
    {
<<<<<<< HEAD
        return $this->morphOne(Address::class, 'model')->where('type', AddressTypeEnum::WORK->value);
=======
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::WORK->value);
>>>>>>> 19c8248 (.)
    }

    /**
     * Relazione all'indirizzo di fatturazione.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function billingAddress(): MorphOne
    {
<<<<<<< HEAD
        return $this->morphOne(Address::class, 'model')->where('type', AddressTypeEnum::BILLING->value);
=======
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::BILLING->value);
>>>>>>> 19c8248 (.)
    }

    /**
     * Relazione all'indirizzo di spedizione.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function shippingAddress(): MorphOne
    {
<<<<<<< HEAD
        return $this->morphOne(Address::class, 'model')->where('type', AddressTypeEnum::SHIPPING->value);
=======
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::SHIPPING->value);
>>>>>>> 19c8248 (.)
    }

    /**
     * Imposta un indirizzo come principale.
     *
     * @param \Modules\Geo\Models\Address $address
     * @return void
     */
    public function setPrimaryAddress(Address $address): void
    {
        // Assicurati che l'indirizzo appartenga a questo modello
        if ($address->model_id !== $this->id || $address->model_type !== get_class($this)) {
            throw new \InvalidArgumentException('L\'indirizzo non appartiene a questo modello.');
        }

        // Rimuovi lo stato primario da tutti gli altri indirizzi
        $this->addresses()->update(['is_primary' => false]);

        // Imposta questo indirizzo come primario
        $address->is_primary = true;
        $address->save();
    }

    /**
     * Aggiunge un nuovo indirizzo.
     *
     * @param array<string, mixed> $data
     * @param bool $isPrimary
     * @return \Modules\Geo\Models\Address
     */
    public function addAddress(array $data, bool $isPrimary = false): Address
    {
        // Se l'indirizzo deve essere primario, rimuovi lo stato primario dagli altri
        if ($isPrimary) {
            $this->addresses()->update(['is_primary' => false]);
        }

        // Crea il nuovo indirizzo
        $data['is_primary'] = $isPrimary;
        return $this->addresses()->create($data);
    }

    /**
     * Ottiene gli indirizzi per tipo.
     *
     * @param \Modules\Geo\Enums\AddressTypeEnum|string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAddressesByType($type)
    {
<<<<<<< HEAD
        $typeValue = ($type instanceof AddressTypeEnum) ? $type->value : $type;
        return $this->addresses()->where('type', $typeValue)->get();
    }
}
=======
        $typeValue = $type instanceof AddressTypeEnum ? $type->value : $type;
        return $this->addresses()->where('type', $typeValue)->get();
    }
}
>>>>>>> 19c8248 (.)
