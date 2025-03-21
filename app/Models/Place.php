<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Modules\Geo\Database\Factories\PlaceFactory;

/**
 * Class Place.
 *
 * @property int             $id
 * @property string|null     $post_type
 * @property int|null        $post_id
 * @property string|null     $formatted_address
 * @property string|null     $latitude
 * @property string|null     $longitude
 * @property string|null     $premise
 * @property string|null     $locality
 * @property string|null     $postal_town
 * @property string|null     $administrative_area_level_3
 * @property string|null     $administrative_area_level_2
 * @property string|null     $administrative_area_level_1
 * @property string|null     $country
 * @property string|null     $street_number
 * @property string|null     $route
 * @property string|null     $postal_code
 * @property string|null     $googleplace_url
 * @property string|null     $point_of_interest
 * @property string|null     $political
 * @property string|null     $campground
 * @property string|null     $nearest_street
 * @property string|null     $created_by
 * @property string|null     $updated_by
 * @property string|null     $deleted_by
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 * @property string          $value
 * @property Model|\Eloquent $linked
 *
 * @method static PlaceFactory                                factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Place query()
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereLongitude($value)
 */
class Place extends BaseModel
{
    use HasFactory;

    /** @var array<string> */
    public static array $address_components = [
        'premise', 'locality', 'postal_town',
        'administrative_area_level_3', 'administrative_area_level_2', 'administrative_area_level_1',
        'country', 'street_number', 'route', 'postal_code',
        'googleplace_url', 'point_of_interest', 'political', 'campground',
    ];

    /** @var list<string> */
    protected $fillable = [
        'id', 'post_id', 'post_type', 'model_id', 'model_type',
        'premise', 'locality', 'postal_town', 'administrative_area_level_3',
        'administrative_area_level_2', 'administrative_area_level_1', 'country',
        'street_number', 'route', 'postal_code', 'googleplace_url',
        'point_of_interest', 'political', 'campground', 'locality_short',
        'administrative_area_level_2_short', 'administrative_area_level_1_short',
        'country_short', 'latlng', 'latitude', 'longitude', 'formatted_address',
        'nearest_street', 'address',
    ];

    /** @var list<string> */
    protected $appends = ['value'];

    /**
     * Accessor for the "value" attribute.
     */
    public function getValueAttribute(): string
    {
        return implode(', ', array_filter([
            $this->route,
            $this->street_number,
            $this->locality,
            $this->administrative_area_level_2,
            $this->country,
        ]));
    }

    /**
     * Morph relationship to the linked model.
     */
    public function linked(): MorphTo
    {
        return $this->morphTo('post');
    }

    // Add type declaration for $value parameter
    public function setLatlngAttribute(array $value): void
    {
        if (isset($value['lat'], $value['lng'])) {
            $this->attributes['latitude'] = (string) $value['lat'];
            $this->attributes['longitude'] = (string) $value['lng'];
        }
    }

    public function setAddressAttribute(string|array $value): void
    {
        if (is_string($value) && isJson($value)) {
            try {
                $json = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

                if (is_array($json)) {
                    if (isset($json['latlng']) && is_array($json['latlng'])) {
                        if (isset($json['latlng']['lat'], $json['latlng']['lng'])) {
                            $json['latitude'] = $json['latlng']['lat'];
                            $json['longitude'] = $json['latlng']['lng'];
                            unset($json['latlng'], $json['value']);
                        }
                    }

                    // Ensure we're merging arrays
                    $this->attributes = array_merge(
                        is_array($this->attributes) ? $this->attributes : [],
                        $json
                    );
                }
            } catch (\JsonException $e) {
                // Handle JSON decode error if needed
            }
        } elseif (is_array($value)) {
            $this->attributes['address'] = json_encode($value, JSON_THROW_ON_ERROR);
        } else {
            $this->attributes['address'] = $value;
        }
    }

    /**
     * Scope a query to filter by country.
     */
    public function scopeWhereCountry(Builder $query, string $country): Builder
    {
        return $query->where('country', $country);
    }

    /**
     * Scope a query to filter by locality.
     */
    public function scopeWhereLocality(Builder $query, string $locality): Builder
    {
        return $query->where('locality', $locality);
    }

    /**
     * Accessor for the "formatted_address" attribute.
     */
    public function getFormattedAddressAttribute(): string
    {
        return $this->attributes['formatted_address'] ?? $this->getValueAttribute();
    }

    /**
     * Mutator for the "formatted_address" attribute.
     */
    public function setFormattedAddressAttribute(string $value): void
    {
        $this->attributes['formatted_address'] = $value;
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return PlaceFactory::new();
    }

    /**
     * Check if the given coordinates match the Place.
     */
    public function matchesCoordinates(string $latitude, string $longitude): bool
    {
        return $this->latitude === $latitude && $this->longitude === $longitude;
    }

    /**
     * Determine if the Place is located within a specific country.
     */
    public function isInCountry(string $country): bool
    {
        return $this->country === $country;
    }

    /**
     * Determine if the Place has complete address information.
     */
    public function hasCompleteAddress(): bool
    {
        return ! empty($this->route) && ! empty($this->street_number) && ! empty($this->locality);
    }
}
