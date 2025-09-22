<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Forms\Components;

use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Modules\Geo\Filament\Resources\AddressResource;
use Webmozart\Assert\Assert;
=======
use Webmozart\Assert\Assert;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Modules\Geo\Filament\Resources\AddressResource;
>>>>>>> 19c8248 (.)

// use Squire\Models\Country;

class AddressField extends Forms\Components\Section
{
<<<<<<< HEAD
=======
    
>>>>>>> 19c8248 (.)
    //protected string $view = 'filament-forms::components.group';

    protected bool $disableLiveUpdates = false;

    protected function setUp(): void
    {
        parent::setUp();
        $this->schema($this->getAddressFormSchema());
        $this->columns(2);
    }

    /**
     * Disabilita gli aggiornamenti live per evitare loop infiniti nei wizard di creazione
     */
    public function disableLiveUpdates(bool $disable = true): static
    {
        $this->disableLiveUpdates = $disable;
        return $this;
    }

    protected function getAddressFormSchema(): array
    {
        $baseSchema = AddressResource::getFormSchema();
<<<<<<< HEAD

        // Rimuovi campi non necessari per relazioni semplici
        unset($baseSchema['name']);
        unset($baseSchema['is_primary']);

=======
        
        // Rimuovi campi non necessari per relazioni semplici
        unset($baseSchema['name']);
        unset($baseSchema['is_primary']);
        
>>>>>>> 19c8248 (.)
        // Se i live updates sono disabilitati, rimuovi la reattività
        if ($this->disableLiveUpdates) {
            $baseSchema = $this->removeReactivityFromSchema($baseSchema);
        }
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        return $baseSchema;
    }

    /**
     * Rimuove tutti i pattern reattivi dai campi per prevenire loop infiniti
     *
     * @param array<string, mixed> $schema
     * @return array<string, mixed>
     */
    protected function removeReactivityFromSchema(array $schema): array
    {
        foreach ($schema as $key => $field) {
            /** @phpstan-ignore argument.type */
            if (method_exists($field, 'live')) {
                // Rimuovi reattività live
                /** @phpstan-ignore method.nonObject */
                $field->live(false);
            }
<<<<<<< HEAD

=======
            
>>>>>>> 19c8248 (.)
            /** @phpstan-ignore argument.type */
            if (method_exists($field, 'afterStateUpdated')) {
                // Rimuovi callback afterStateUpdated
                /** @phpstan-ignore method.nonObject */
                $field->afterStateUpdated(null);
            }
<<<<<<< HEAD

=======
            
>>>>>>> 19c8248 (.)
            /** @phpstan-ignore argument.type */
            if (method_exists($field, 'disabled')) {
                // Rimuovi condizioni disabled dinamiche
                /** @phpstan-ignore method.nonObject */
                $field->disabled(false);
            }
<<<<<<< HEAD

            $schema[$key] = $field;
        }

        return $schema;
    }

    /*
     * public function saveRelationships(): void
     * {
     *
     * $state = $this->getState();
     * $record = $this->getRecord();
     * $relationship = $record->{$this->getRelationship()}();
     *
     * if (null === $relationship) {
     * return;
     * }
     * if ($address = $relationship->first()) {
     * $address->update($state);
     * } else {
     * $relationship->updateOrCreate($state);
     * }
     *
     * $record->touch();
     * }
     */
=======
            
            $schema[$key] = $field;
        }
        
        return $schema;
    }

    
    /*
    public function saveRelationships(): void
    {
        
        $state = $this->getState();
        $record = $this->getRecord();
        $relationship = $record->{$this->getRelationship()}();

        if (null === $relationship) {
            return;
        }
        if ($address = $relationship->first()) {
            $address->update($state);
        } else {
            $relationship->updateOrCreate($state);
        }

        $record->touch();
    }
    */
    
>>>>>>> 19c8248 (.)
}
