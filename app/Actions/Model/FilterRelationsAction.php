<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Webmozart\Assert\Assert;

/**
 * Class FilterRelationsAction
 * 
 * Filtra e valida le relazioni di un modello.
 */
class FilterRelationsAction
{
    /**
     * Filtra e valida le relazioni.
     *
     * @param Model $model Il modello principale
     * @param array<string, mixed> $data I dati delle relazioni
     * @return array<string, object> Le relazioni filtrate e validate
     * @throws \InvalidArgumentException Se una relazione non è valida
     */
    public function execute(Model $model, array $data): array
    {
        $filtered = [];

        foreach ($data as $name => $value) {
            if (!is_array($value) || !isset($value['relationship_type'])) {
                continue;
            }

            $relation = $this->validateRelation($model, $name, $value);
            if ($relation !== null) {
                $filtered[$name] = $relation;
            }
        }

        return $filtered;
    }

    /**
     * Valida una singola relazione.
     *
     * @param Model $model Il modello principale
     * @param string $name Il nome della relazione
     * @param array<string, mixed> $data I dati della relazione
     * @return object|null La relazione validata o null se non valida
     * @throws \InvalidArgumentException Se la relazione non è valida
     */
    private function validateRelation(Model $model, string $name, array $data): ?object
    {
        if (!method_exists($model, $name)) {
            return null;
        }

        $relation = $model->{$name}();
        if (!$relation instanceof Relation) {
            return null;
        }

        $relationData = (object) [
            'name' => $name,
            'relationship_type' => $data['relationship_type'],
            'data' => $data['data'] ?? [],
            'relation' => $relation
        ];

        return $relationData;
    }
}
