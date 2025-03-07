<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\ModelClass;

use Illuminate\Database\Eloquent\Model;
use Webmozart\Assert\Assert;

/**
 * Class CountAction
 * 
 * Conta i record di un modello.
 */
class CountAction
{
    /**
     * Conta i record di un modello.
     *
     * @param class-string<Model> $modelClass Nome della classe modello
     * @return int Numero di record
     * @throws \InvalidArgumentException Se la classe modello non è valida
     */
    public static function execute(string $modelClass): int
    {
        Assert::classExists($modelClass);
        Assert::subclassOf($modelClass, Model::class);

        /** @var Model $model */
        $model = new $modelClass();
        
        return $model->query()->count();
    }
}
