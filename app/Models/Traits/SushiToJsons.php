<?php

declare(strict_types=1);

namespace Modules\Geo\Models\Traits;

<<<<<<< HEAD
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
=======
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
>>>>>>> 63c6dd4 (.)
use Sushi\Sushi;

trait SushiToJsons
{
    use Sushi;

    /**
     * Carica i dati dal file JSON
     */
    public function getSushiRows(): array
    {
        return Cache::remember(
            $this->getCacheKey(),
            $this->getCacheDuration(),
            fn () => $this->loadFromJson()
        );
    }

    /**
     * Carica i dati dal file JSON
     */
    protected function loadFromJson(): array
    {
        $path = $this->getJsonFile();
<<<<<<< HEAD

        if (! File::exists($path)) {
=======
        
        if (!File::exists($path)) {
>>>>>>> 63c6dd4 (.)
            return [];
        }

        $data = json_decode(File::get($path), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
<<<<<<< HEAD
            throw new \RuntimeException('Errore nel parsing del file JSON: '.json_last_error_msg());
=======
            throw new \RuntimeException('Errore nel parsing del file JSON: ' . json_last_error_msg());
>>>>>>> 63c6dd4 (.)
        }

        return $data;
    }

    /**
     * Ottiene il percorso del file JSON
     */
    public function getJsonFile(): string
    {
        return base_path('database/content/comuni.json');
    }

    /**
     * Ottiene la chiave di cache
     */
    protected function getCacheKey(): string
    {
<<<<<<< HEAD
        return 'sushi_'.class_basename($this).'_data';
=======
        return 'sushi_' . class_basename($this) . '_data';
>>>>>>> 63c6dd4 (.)
    }

    /**
     * Ottiene la durata della cache in secondi
     */
    protected function getCacheDuration(): int
    {
        return 60 * 24 * 7; // 7 giorni
    }

    /**
     * Salva i dati nel file JSON
     */
    public function saveToJson(array $data): bool
    {
        $path = $this->getJsonFile();
<<<<<<< HEAD

        try {
            File::put($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            Cache::forget($this->getCacheKey());

            return true;
        } catch (\Exception $e) {
            report($e);

=======
        
        try {
            File::put($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            Cache::forget($this->getCacheKey());
            return true;
        } catch (\Exception $e) {
            report($e);
>>>>>>> 63c6dd4 (.)
            return false;
        }
    }

    /**
     * Crea un nuovo record
     */
    public function create(array $attributes = []): static
    {
        $data = $this->loadFromJson();
        $attributes['id'] = $this->generateId();
        $attributes['created_at'] = now();
        $attributes['updated_at'] = now();
<<<<<<< HEAD

        $data[] = $attributes;

        if ($this->saveToJson($data)) {
            return $this->newInstance($attributes);
        }

=======
        
        $data[] = $attributes;
        
        if ($this->saveToJson($data)) {
            return $this->newInstance($attributes);
        }
        
>>>>>>> 63c6dd4 (.)
        throw new \RuntimeException('Impossibile salvare il record');
    }

    /**
     * Aggiorna un record esistente
     */
    public function update(array $attributes = []): bool
    {
        $data = $this->loadFromJson();
        $index = $this->findIndex($this->getKey());
<<<<<<< HEAD

        if ($index === null) {
            return false;
        }

        $attributes['updated_at'] = now();
        $data[$index] = array_merge($data[$index], $attributes);

=======
        
        if ($index === null) {
            return false;
        }
        
        $attributes['updated_at'] = now();
        $data[$index] = array_merge($data[$index], $attributes);
        
>>>>>>> 63c6dd4 (.)
        return $this->saveToJson($data);
    }

    /**
     * Elimina un record
     */
    public function delete(): bool
    {
        $data = $this->loadFromJson();
        $index = $this->findIndex($this->getKey());
<<<<<<< HEAD

        if ($index === null) {
            return false;
        }

        array_splice($data, $index, 1);

=======
        
        if ($index === null) {
            return false;
        }
        
        array_splice($data, $index, 1);
        
>>>>>>> 63c6dd4 (.)
        return $this->saveToJson($data);
    }

    /**
     * Trova l'indice di un record
     */
    protected function findIndex($id): ?int
    {
        $data = $this->loadFromJson();
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        foreach ($data as $index => $item) {
            if ($item['id'] === $id) {
                return $index;
            }
        }
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        return null;
    }

    /**
     * Genera un nuovo ID
     */
    protected function generateId(): string
    {
        return uniqid('comune_', true);
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> 63c6dd4 (.)
