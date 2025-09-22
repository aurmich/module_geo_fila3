<?php

declare(strict_types=1);

namespace Modules\Geo\Models\Traits;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Geo\Models\Address;
use Webmozart\Assert\Assert;

/**
 * Trait HasAddress
 *
 * Fornisce funzionalità per la gestione degli indirizzi nei modelli Eloquent.
 * Questo trait implementa la relazione polimorfica con il modello Address
 * e offre metodi di utilità per la gestione degli indirizzi.
 *
=======
use Webmozart\Assert\Assert;
use Modules\Geo\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasAddress
 * 
 * Fornisce funzionalità per la gestione degli indirizzi nei modelli Eloquent.
 * Questo trait implementa la relazione polimorfica con il modello Address
 * e offre metodi di utilità per la gestione degli indirizzi.
 * 
>>>>>>> 19c8248 (.)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geo\Models\Address> $addresses
 */
trait HasAddress
{
    /**
     * Ottiene gli indirizzi associati al modello.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'model');
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene indirizzo associato al modello.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'model');
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene l'indirizzo principale del modello.
     *
     * @return \Modules\Geo\Models\Address|null
     */
<<<<<<< HEAD
    public function primaryAddress(): null|Address
    {
        $res = $this->addresses()->where('is_primary', true)->first();
        if ($res === null) {
=======
    public function primaryAddress(): ?Address
    {
        $res= $this->addresses()->where('is_primary', true)->first();
        if($res==null){
>>>>>>> 19c8248 (.)
            return $res;
        }
        Assert::isInstanceOf($res, Address::class);
        return $res;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene l'indirizzo completo formattato.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getFullAddress(): null|string
=======
    public function getFullAddress(): ?string
>>>>>>> 19c8248 (.)
    {
        $address = $this->primaryAddress();
        return $address ? $address->getFullAddress() : null;
    }

<<<<<<< HEAD
    public function getFullAddressAttribute(null|string $value): null|string
    {
        if ($value) {
            return $value;
        }
        $address = $this->address()->first();
        if ($address === null) {
            return null;
        }
        Assert::isInstanceOf($address, Address::class);

        $locality = $address->getLocality();
        if ($locality === null) {
            return null;
        }

        return (
            $address->street_address .
            ', ' .
            $address->street_number .
            ' - ' .
            $address->postal_code .
            ' ' .
            $locality['nome'] .
            ' (' .
            $locality['provincia']['nome'] .
            ') '
        );
    }

=======

    public function getFullAddressAttribute(?string $value): ?string
    {
        if($value){
            return $value;
        }
        $address = $this->address()->first();
        if($address==null){
            return null;
        }
        Assert::isInstanceOf($address, Address::class);
        
        $locality=$address->getLocality();
        if($locality==null){
            return null;
        }
        
        return $address->street_address.', '.$address->street_number.' - '.$address->postal_code.' '.$locality['nome'].' ('.$locality['provincia']['nome'].') ';
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene la località dell'indirizzo principale.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getCity(): null|string
=======
    public function getCity(): ?string
>>>>>>> 19c8248 (.)
    {
        $address = $this->primaryAddress();
        return $address ? $address->locality : null;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene il CAP dell'indirizzo principale.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getPostalCode(): null|string
=======
    public function getPostalCode(): ?string
>>>>>>> 19c8248 (.)
    {
        $address = $this->primaryAddress();
        return $address ? $address->postal_code : null;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene la provincia dell'indirizzo principale.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getProvince(): null|string
=======
    public function getProvince(): ?string
>>>>>>> 19c8248 (.)
    {
        $address = $this->primaryAddress();
        return $address ? $address->administrative_area_level_3 : null;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene la regione dell'indirizzo principale.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getRegion(): null|string
=======
    public function getRegion(): ?string
>>>>>>> 19c8248 (.)
    {
        $address = $this->primaryAddress();
        return $address ? $address->administrative_area_level_2 : null;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene il paese dell'indirizzo principale.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getCountry(): null|string
=======
    public function getCountry(): ?string
>>>>>>> 19c8248 (.)
    {
        $address = $this->primaryAddress();
        return $address ? $address->country : null;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Imposta un indirizzo come principale e rimuove il flag da tutti gli altri.
     *
     * @param \Modules\Geo\Models\Address $address
     * @return bool
     */
    public function setAsPrimaryAddress(Address $address): bool
    {
        // Verifica che l'indirizzo appartenga a questo modello
<<<<<<< HEAD
        if ($address->model_id !== $this->id || $address->model_type !== get_class($this)) {
            return false;
        }

=======
        if ($address->model_id != $this->id || $address->model_type != get_class($this)) {
            return false;
        }
        
>>>>>>> 19c8248 (.)
        // Rimuovi il flag is_primary da tutti gli altri indirizzi
        $this->addresses()
            ->where('id', '!=', $address->id)
            ->where('is_primary', true)
            ->update(['is_primary' => false]);
<<<<<<< HEAD

        // Imposta questo indirizzo come principale
        return $address->update(['is_primary' => true]);
    }

=======
        
        // Imposta questo indirizzo come principale
        return $address->update(['is_primary' => true]);
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Ottiene gli indirizzi di un determinato tipo.
     *
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAddressesByType(string $type)
    {
        return $this->addresses()->where('type', $type)->get();
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Aggiunge un nuovo indirizzo al modello.
     *
     * @param array<string, mixed> $data
     * @param bool $setPrimary Se impostare questo indirizzo come principale
     * @return \Modules\Geo\Models\Address
     */
    public function addAddress(array $data, bool $setPrimary = false): Address
    {
        // Se è il primo indirizzo o è richiesto esplicitamente, impostalo come principale
        if ($setPrimary || $this->addresses()->count() === 0) {
            $data['is_primary'] = true;
<<<<<<< HEAD

=======
            
>>>>>>> 19c8248 (.)
            // Rimuovi il flag is_primary da tutti gli altri indirizzi
            if ($this->addresses()->count() > 0) {
                $this->addresses()->update(['is_primary' => false]);
            }
        }
        /** @phpstan-ignore return.type */
        return $this->addresses()->create($data);
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Aggiorna l'indirizzo principale.
     *
     * @param array<string, mixed> $data
     * @return \Modules\Geo\Models\Address|null
     */
<<<<<<< HEAD
    public function updatePrimaryAddress(array $data): null|Address
    {
        $primaryAddress = $this->primaryAddress();

        if (!$primaryAddress) {
            return $this->addAddress($data, true);
        }

        $primaryAddress->update($data);
        return $primaryAddress;
    }

=======
    public function updatePrimaryAddress(array $data): ?Address
    {
        $primaryAddress = $this->primaryAddress();
        
        if (!$primaryAddress) {
            return $this->addAddress($data, true);
        }
        
        $primaryAddress->update($data);
        return $primaryAddress;
    }
    
>>>>>>> 19c8248 (.)
    /**
     * Scope per filtrare i modelli in base alla città dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $city
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInCity($query, string $city)
    {
        return $query->whereHas('addresses', function ($q) use ($city) {
            $q->where('locality', $city);
        });
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Scope per filtrare i modelli in base alla provincia dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $province
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInProvince($query, string $province)
    {
        return $query->whereHas('addresses', function ($q) use ($province) {
            $q->where('administrative_area_level_3', $province);
        });
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Scope per filtrare i modelli in base alla regione dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $region
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInRegion($query, string $region)
    {
        return $query->whereHas('addresses', function ($q) use ($region) {
            $q->where('administrative_area_level_2', $region);
        });
    }
<<<<<<< HEAD

=======
    
>>>>>>> 19c8248 (.)
    /**
     * Scope per filtrare i modelli in base al CAP dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $postalCode
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInPostalCode($query, string $postalCode)
    {
        return $query->whereHas('addresses', function ($q) use ($postalCode) {
            $q->where('postal_code', $postalCode);
        });
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 19c8248 (.)
