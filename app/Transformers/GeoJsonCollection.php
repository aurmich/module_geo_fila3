<?php

declare(strict_types=1);

namespace Modules\Geo\Transformers;

/*
<<<<<<< HEAD
 *  GEOJSON e' uno standard
 * https://it.wikipedia.org/wiki/GeoJSON
 */
=======
*  GEOJSON e' uno standard
* https://it.wikipedia.org/wiki/GeoJSON
*/
>>>>>>> 19c8248 (.)
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class GeoJsonCollection.
 */
class GeoJsonCollection extends ResourceCollection
{
    /**
     * Undocumented variable.
     *
     * @var string
     */
    public $collects = GeoJsonResource::class;

    public function toArray(Request $request): array
    {
        return [
            'type' => 'FeatureCollection',
            'features' => $this->collection,
            /*'links' => [
<<<<<<< HEAD
             * 'self' => 'link-value',
             * ],*/
=======
                'self' => 'link-value',
            ],*/
>>>>>>> 19c8248 (.)
        ];
    }
}
