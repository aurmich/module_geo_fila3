<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array $location
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 *
 * @property int                             $id
 * @property string|null                     $model_type
 * @property string|null                     $model_id
 * @property string|null                     $name
 * @property string|null                     $lat
 * @property string|null                     $lng
 * @property string|null                     $street
 * @property string|null                     $city
 * @property string|null                     $state
 * @property string|null                     $zip
 * @property string|null                     $formatted_address
 * @property string|null                     $description
 * @property bool|null                       $processed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property string|null                     $deleted_at
 * @property string|null                     $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereZip($value)
 *
 * @property \Modules\Fixcity\Models\Profile|null $creator
 * @property \Modules\Fixcity\Models\Profile|null $updater
 *
 * @mixin \Eloquent
 */
class Location extends BaseModel
{
    protected $fillable = [
        'name',
        'lat',
        'lng',
        'street',
        'city',
        'state',
        'zip',
        'formatted_address',
        'processed',
        'location',
        'description',
    ];

    protected $appends = [
        'location',
    ];

    protected $casts = [
        'processed' => 'bool',
    ];

    /**
     * The following code was generated for use with Filament Google Maps.
     *
     * php artisan fgm:model-code Location --lat=lat --lng=lng --location=location --terse
     */
    public function getLocationAttribute(): array
    {
        return [
            'lat' => (float) $this->lat,
            'lng' => (float) $this->lng,
        ];
    }

    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['lat'] = $location['lat'];
            $this->attributes['lng'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'lat',
            'lng' => 'lng',
        ];
    }

    public static function getComputedLocation(): string
    {
        return 'location';
    }
}
