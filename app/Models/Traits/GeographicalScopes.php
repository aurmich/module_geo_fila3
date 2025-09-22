<?php

declare(strict_types=1);

namespace Modules\Geo\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

trait GeographicalScopes
{
    /**
     * Scope per calcolare la distanza tra due punti.
     */
    public function scopeWithDistance(Builder $query, float $latitude, float $longitude): Builder
    {
        return $query->select('*', $this->getDistanceExpression($latitude, $longitude, 'distance'));
    }

    /**
     * Scope per ordinare i risultati per distanza.
     */
    public function scopeOrderByDistance(Builder $query, float $latitude, float $longitude): Builder
    {
        return $query->orderBy($this->getDistanceExpression($latitude, $longitude));
    }

<<<<<<< HEAD
    public function getDistanceExpression(
        float $latitude,
        float $longitude,
        null|string $alias = null,
    ): Expression|\Illuminate\Contracts\Database\Query\Expression {
        $sql = "
            (6371 * acos(
                cos(radians({$latitude})) *
                cos(radians(latitude)) *
                cos(radians(longitude) - radians({$longitude})) +
                sin(radians({$latitude})) *
=======
    public function getDistanceExpression(float $latitude, float $longitude, ?string $alias = null): Expression
    {
        $sql = "
            (6371 * acos(
                cos(radians($latitude)) *
                cos(radians(latitude)) *
                cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) *
>>>>>>> 19c8248 (.)
                sin(radians(latitude))
            ))
        ";
        if (null !== $alias) {
<<<<<<< HEAD
            $sql .= " AS {$alias}";
        }

        return new \Illuminate\Database\Query\Expression($sql);

=======
            $sql .= " AS $alias";
        }

        return \DB::raw($sql);
>>>>>>> 19c8248 (.)
        // AS distance
    }
}
