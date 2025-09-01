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
>>>>>>> 63c6dd4 (.)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geo\Models\Address> $addresses
 */
trait HasAddress
{
    /**
     * Ottiene gli indirizzi associati al modello.
<<<<<<< HEAD
=======
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
>>>>>>> 63c6dd4 (.)
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'model');
    }
<<<<<<< HEAD

    /**
     * Ottiene indirizzo associato al modello.
=======
    
    /**
     * Ottiene indirizzo associato al modello.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
>>>>>>> 63c6dd4 (.)
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'model');
    }
<<<<<<< HEAD

    /**
     * Ottiene l'indirizzo principale del modello.
     */
    public function primaryAddress(): ?Address
    {
        $res = $this->addresses()->where('is_primary', true)->first();
        if ($res == null) {
            return $res;
        }
        Assert::isInstanceOf($res, Address::class);

        return $res;
    }

    /**
     * Ottiene l'indirizzo completo formattato.
=======
    
    /**
     * Ottiene l'indirizzo principale del modello.
     *
     * @return \Modules\Geo\Models\Address|null
     */
    public function primaryAddress(): ?Address
    {
        $res= $this->addresses()->where('is_primary', true)->first();
        if($res==null){
            return $res;
        }
        Assert::isInstanceOf($res, Address::class);
        return $res;
    }
    
    /**
     * Ottiene l'indirizzo completo formattato.
     *
     * @return string|null
>>>>>>> 63c6dd4 (.)
     */
    public function getFullAddress(): ?string
    {
        $address = $this->primaryAddress();
<<<<<<< HEAD

        return $address ? $address->getFullAddress() : null;
    }

    public function getFullAddressAttribute(?string $value): ?string
    {
        if ($value) {
            return $value;
        }
        $address = $this->address()->first();
        if ($address == null) {
            return null;
        }
        Assert::isInstanceOf($address, Address::class);

        $locality = $address->getLocality();
        if ($locality == null) {
            return null;
        }

        return $address->street_address.', '.$address->street_number.' - '.$address->postal_code.' '.$locality['nome'].' ('.$locality['provincia']['nome'].') ';
    }

    /**
     * Ottiene la località dell'indirizzo principale.
=======
        return $address ? $address->getFullAddress() : null;
    }


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
    
    /**
     * Ottiene la località dell'indirizzo principale.
     *
     * @return string|null
>>>>>>> 63c6dd4 (.)
     */
    public function getCity(): ?string
    {
        $address = $this->primaryAddress();
<<<<<<< HEAD

        return $address ? $address->locality : null;
    }

    /**
     * Ottiene il CAP dell'indirizzo principale.
=======
        return $address ? $address->locality : null;
    }
    
    /**
     * Ottiene il CAP dell'indirizzo principale.
     *
     * @return string|null
>>>>>>> 63c6dd4 (.)
     */
    public function getPostalCode(): ?string
    {
        $address = $this->primaryAddress();
<<<<<<< HEAD

        return $address ? $address->postal_code : null;
    }

    /**
     * Ottiene la provincia dell'indirizzo principale.
=======
        return $address ? $address->postal_code : null;
    }
    
    /**
     * Ottiene la provincia dell'indirizzo principale.
     *
     * @return string|null
>>>>>>> 63c6dd4 (.)
     */
    public function getProvince(): ?string
    {
        $address = $this->primaryAddress();
<<<<<<< HEAD

        return $address ? $address->administrative_area_level_3 : null;
    }

    /**
     * Ottiene la regione dell'indirizzo principale.
=======
        return $address ? $address->administrative_area_level_3 : null;
    }
    
    /**
     * Ottiene la regione dell'indirizzo principale.
     *
     * @return string|null
>>>>>>> 63c6dd4 (.)
     */
    public function getRegion(): ?string
    {
        $address = $this->primaryAddress();
<<<<<<< HEAD

        return $address ? $address->administrative_area_level_2 : null;
    }

    /**
     * Ottiene il paese dell'indirizzo principale.
=======
        return $address ? $address->administrative_area_level_2 : null;
    }
    
    /**
     * Ottiene il paese dell'indirizzo principale.
     *
     * @return string|null
>>>>>>> 63c6dd4 (.)
     */
    public function getCountry(): ?string
    {
        $address = $this->primaryAddress();
<<<<<<< HEAD

        return $address ? $address->country : null;
    }

    /**
     * Imposta un indirizzo come principale e rimuove il flag da tutti gli altri.
=======
        return $address ? $address->country : null;
    }
    
    /**
     * Imposta un indirizzo come principale e rimuove il flag da tutti gli altri.
     *
     * @param \Modules\Geo\Models\Address $address
     * @return bool
>>>>>>> 63c6dd4 (.)
     */
    public function setAsPrimaryAddress(Address $address): bool
    {
        // Verifica che l'indirizzo appartenga a questo modello
        if ($address->model_id != $this->id || $address->model_type != get_class($this)) {
            return false;
        }
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        // Rimuovi il flag is_primary da tutti gli altri indirizzi
        $this->addresses()
            ->where('id', '!=', $address->id)
            ->where('is_primary', true)
            ->update(['is_primary' => false]);
<<<<<<< HEAD

        // Imposta questo indirizzo come principale
        return $address->update(['is_primary' => true]);
    }

    /**
     * Ottiene gli indirizzi di un determinato tipo.
     *
=======
        
        // Imposta questo indirizzo come principale
        return $address->update(['is_primary' => true]);
    }
    
    /**
     * Ottiene gli indirizzi di un determinato tipo.
     *
     * @param string $type
>>>>>>> 63c6dd4 (.)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAddressesByType(string $type)
    {
        return $this->addresses()->where('type', $type)->get();
    }
<<<<<<< HEAD

    /**
     * Aggiunge un nuovo indirizzo al modello.
     *
     * @param  array<string, mixed>  $data
     * @param  bool  $setPrimary  Se impostare questo indirizzo come principale
=======
    
    /**
     * Aggiunge un nuovo indirizzo al modello.
     *
     * @param array<string, mixed> $data
     * @param bool $setPrimary Se impostare questo indirizzo come principale
     * @return \Modules\Geo\Models\Address
>>>>>>> 63c6dd4 (.)
     */
    public function addAddress(array $data, bool $setPrimary = false): Address
    {
        // Se è il primo indirizzo o è richiesto esplicitamente, impostalo come principale
        if ($setPrimary || $this->addresses()->count() === 0) {
            $data['is_primary'] = true;
<<<<<<< HEAD

=======
            
>>>>>>> 63c6dd4 (.)
            // Rimuovi il flag is_primary da tutti gli altri indirizzi
            if ($this->addresses()->count() > 0) {
                $this->addresses()->update(['is_primary' => false]);
            }
        }
<<<<<<< HEAD

        /** @phpstan-ignore return.type */
        return $this->addresses()->create($data);
    }

    /**
     * Aggiorna l'indirizzo principale.
     *
     * @param  array<string, mixed>  $data
=======
        /** @phpstan-ignore return.type */
        return $this->addresses()->create($data);
    }
    
    /**
     * Aggiorna l'indirizzo principale.
     *
     * @param array<string, mixed> $data
     * @return \Modules\Geo\Models\Address|null
>>>>>>> 63c6dd4 (.)
     */
    public function updatePrimaryAddress(array $data): ?Address
    {
        $primaryAddress = $this->primaryAddress();
<<<<<<< HEAD

        if (! $primaryAddress) {
            return $this->addAddress($data, true);
        }

        $primaryAddress->update($data);

        return $primaryAddress;
    }

    /**
     * Scope per filtrare i modelli in base alla città dell'indirizzo.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
=======
        
        if (!$primaryAddress) {
            return $this->addAddress($data, true);
        }
        
        $primaryAddress->update($data);
        return $primaryAddress;
    }
    
    /**
     * Scope per filtrare i modelli in base alla città dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $city
>>>>>>> 63c6dd4 (.)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInCity($query, string $city)
    {
        return $query->whereHas('addresses', function ($q) use ($city) {
            $q->where('locality', $city);
        });
    }
<<<<<<< HEAD

    /**
     * Scope per filtrare i modelli in base alla provincia dell'indirizzo.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
=======
    
    /**
     * Scope per filtrare i modelli in base alla provincia dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $province
>>>>>>> 63c6dd4 (.)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInProvince($query, string $province)
    {
        return $query->whereHas('addresses', function ($q) use ($province) {
            $q->where('administrative_area_level_3', $province);
        });
    }
<<<<<<< HEAD

    /**
     * Scope per filtrare i modelli in base alla regione dell'indirizzo.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
=======
    
    /**
     * Scope per filtrare i modelli in base alla regione dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $region
>>>>>>> 63c6dd4 (.)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInRegion($query, string $region)
    {
        return $query->whereHas('addresses', function ($q) use ($region) {
            $q->where('administrative_area_level_2', $region);
        });
    }
<<<<<<< HEAD

    /**
     * Scope per filtrare i modelli in base al CAP dell'indirizzo.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
=======
    
    /**
     * Scope per filtrare i modelli in base al CAP dell'indirizzo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $postalCode
>>>>>>> 63c6dd4 (.)
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
>>>>>>> 63c6dd4 (.)
