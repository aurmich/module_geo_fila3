<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Class ComponentFileData
 * 
 * Rappresenta i dati di un file componente.
 * 
 * @property string $name Nome del componente
 * @property string $class Classe del componente
 * @property string|null $module Nome del modulo (opzionale)
 * @property string|null $path Percorso del file (opzionale)
 * @property string|null $ns Namespace del componente (opzionale)
 */
class ComponentFileData extends Data
{
    public function __construct(
        public string $name,
        public string $class,
        public ?string $module = null,
        public ?string $path = null,
        public ?string $ns = null,
    ) {}

    /**
     * Crea una collezione di ComponentFileData.
     *
     * @param EloquentCollection|Collection|array<int|string,mixed> $data
     */
    public static function collection(EloquentCollection|Collection|array $data): DataCollection
    {
        return self::collect($data, DataCollection::class);
    }
}
