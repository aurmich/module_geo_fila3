<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Xot\Actions;

use Illuminate\Support\Str;
use Modules\Xot\Contracts\ModelContract;
use Spatie\QueueableAction\QueueableAction;

/**
 * Class GetModelTypeByModelAction
 * 
 * Converte un'istanza di ModelContract nel suo tipo stringa corrispondente.
 */
class GetModelTypeByModelAction
{
    use QueueableAction;

    /**
     * Esegue l'azione di conversione.
     * 
     * @param ModelContract $modelContract Il modello da convertire
     * @return string Il tipo del modello in formato snake_case
     */
    public function execute(ModelContract $modelContract): string
    {
        return Str::snake(class_basename($modelContract));
    }
}
