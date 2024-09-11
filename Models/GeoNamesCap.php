<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
// //use Laravel\Scout\Searchable;
use Modules\Xot\Traits\Updater;

/**
 * Modules\Geo\Models\GeoNamesCap.
 *
 * @method static Builder|GeoNamesCap newModelQuery()
 * @method static Builder|GeoNamesCap newQuery()
 * @method static Builder|GeoNamesCap query()
 *
 * @property \Modules\Fixcity\Models\Profile|null $creator
 * @property \Modules\Fixcity\Models\Profile|null $updater
 *
 * @mixin \Eloquent
 */
class GeoNamesCap extends Model
{
    // use Searchable;
    use Updater;

    /** @var string */
    protected $table = 'geonames_cap';
    // protected $connection = 'geo';

    /*
     * { function_description }
     *
     */
    /*
    function __construct(){
        $this->setConnection('liveuser_general');
        parent::__construct();
    }//end construct
    */
}
