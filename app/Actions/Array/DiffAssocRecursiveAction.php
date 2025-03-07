<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Array;

use Spatie\QueueableAction\QueueableAction;
use InvalidArgumentException;
use function Safe\json_encode;

/**
 * Class DiffAssocRecursiveAction
 * 
 * Calcola la differenza ricorsiva tra due array associativi.
 */
class DiffAssocRecursiveAction
{
    use QueueableAction;

    /**
     * Corregge i tipi dei valori nell'array.
     * 
     * @param array<int|string,array<string,mixed>> $data
     * @return array<int|string,array<string,mixed>>
     * @throws InvalidArgumentException Se un elemento non è un array
     */
    public static function fixType(array $data): array
    {
        $collection = collect($data)
            ->map(
                static function ($item) {
                    if (! is_array($item)) {
                        throw new InvalidArgumentException('Ogni elemento deve essere un array');
                    }

                    return collect($item)
                        ->map(
                            static function ($item0) {
                                if (is_numeric($item0)) {
                                    $item0 *= 1;
                                }

                                return $item0;
                            }
                        )->all();
                }
            );

        return $collection->all();
    }

    /**
     * Calcola la differenza tra due array.
     * 
     * @param array<int|string,array<string,mixed>> $arr_1 Primo array
     * @param array<int|string,array<string,mixed>> $arr_2 Secondo array
     * @return array<int|string,array<string,mixed>> Array contenente gli elementi presenti in $arr_1 ma non in $arr_2
     * @throws InvalidArgumentException Se c'è un errore durante il confronto
     */
    public function execute(array $arr_1, array $arr_2): array
    {
        $coll_1 = collect(self::fixType($arr_1));
        $arr_2 = self::fixType($arr_2);

        $ris = $coll_1->filter(
            static function ($value, $key) use ($arr_2) {
                try {
                    return ! \in_array($value, $arr_2, false);
                } catch (\Exception $exception) {
                    throw new InvalidArgumentException(
                        sprintf(
                            'Errore durante il confronto degli array: %s [value: %s, key: %s]',
                            $exception->getMessage(),
                            json_encode($value) ?: 'non codificabile',
                            $key
                        )
                    );
                }
            }
        );

        return $ris->all();
    }
}
