<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Class StoreAction
 * 
 * Gestisce il salvataggio di un modello e delle sue relazioni.
 */
class StoreAction
{
    use QueueableAction;

    /**
     * Salva un modello e le sue relazioni.
     *
     * @param Model $model Il modello da salvare
     * @param array<string, mixed> $data I dati da salvare
     * @param array<string, mixed> $rules Le regole di validazione
     * @return Model Il modello salvato
     * @throws \RuntimeException Se una action di relazione non è valida
     */
    public function execute(Model $model, array $data, array $rules): Model
    {
        // Gestione campi automatici
        if (! isset($data['lang']) && \in_array('lang', $model->getFillable(), true)) {
            $data['lang'] = app()->getLocale();
        }

        $data['updated_by'] = $this->getCurrentUserId();
        $data['created_by'] = $this->getCurrentUserId();

        // Validazione
        $validator = Validator::make($data, $rules);
        $validator->validate();

        // Salvataggio modello
        $model->fill($data);
        $model->save();

        // Gestione relazioni
        $relations = app(FilterRelationsAction::class)->execute($model, $data);
        foreach ($relations as $relation) {
            $this->handleRelation($model, $relation);
        }

        return $model;
    }

    /**
     * Gestisce una singola relazione.
     *
     * @param Model $model Il modello principale
     * @param object $relation La relazione da gestire
     * @throws \RuntimeException Se l'action non è valida
     */
    private function handleRelation(Model $model, object $relation): void
    {
        $actionClass = sprintf(
            '%s\\Store\\%sAction',
            __NAMESPACE__,
            $relation->relationship_type
        );

        if (!class_exists($actionClass)) {
            throw new \RuntimeException(
                sprintf('Action class [%s] not found', $actionClass)
            );
        }

        $action = app($actionClass);
        if (!method_exists($action, 'execute')) {
            throw new \RuntimeException(
                sprintf('Method [execute] not found in [%s]', $actionClass)
            );
        }

        $action->execute($model, $relation);
    }

    /**
     * Ottiene l'ID dell'utente corrente.
     *
     * @return int|null
     */
    private function getCurrentUserId(): ?int
    {
        return Auth::id();
    }
}
