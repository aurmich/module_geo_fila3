<?php

declare(strict_types=1);

namespace Modules\Geo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Geo\Models\Location;

/**
 * Location Factory
<<<<<<< HEAD
 *
 * Factory for creating Location model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating Location model instances for testing and seeding.
 * 
>>>>>>> 19c8248 (.)
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 19c8248 (.)
     * @var class-string<Location>
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $italianCities = [
<<<<<<< HEAD
            'Roma',
            'Milano',
            'Napoli',
            'Torino',
            'Palermo',
            'Genova',
            'Bologna',
            'Firenze',
            'Bari',
            'Catania',
            'Venezia',
            'Verona',
        ];

        $italianStreets = [
            'Via Roma',
            'Via Milano',
            'Via Garibaldi',
            'Via Mazzini',
            'Via Dante',
            'Via Verdi',
            'Corso Italia',
            'Piazza Duomo',
        ];

        $italianRegions = [
            'Lazio',
            'Lombardia',
            'Campania',
            'Piemonte',
            'Sicilia',
            'Liguria',
            'Emilia-Romagna',
            'Toscana',
=======
            'Roma', 'Milano', 'Napoli', 'Torino', 'Palermo', 'Genova', 
            'Bologna', 'Firenze', 'Bari', 'Catania', 'Venezia', 'Verona'
        ];

        $italianStreets = [
            'Via Roma', 'Via Milano', 'Via Garibaldi', 'Via Mazzini', 
            'Via Dante', 'Via Verdi', 'Corso Italia', 'Piazza Duomo'
        ];

        $italianRegions = [
            'Lazio', 'Lombardia', 'Campania', 'Piemonte', 'Sicilia', 
            'Liguria', 'Emilia-Romagna', 'Toscana'
>>>>>>> 19c8248 (.)
        ];

        /** @var string $city */
        $city = (string) $this->faker->randomElement($italianCities);
        /** @var string $street */
        $street = (string) $this->faker->randomElement($italianStreets);
        /** @var string $state */
        $state = (string) $this->faker->randomElement($italianRegions);

        return [
<<<<<<< HEAD
            'name' => $this->faker->optional()->words(2, true) ?? null,
            'lat' => $this->faker->latitude(35.0, 47.0), // Italy bounds
            'lng' => $this->faker->longitude(6.0, 19.0),
            'street' => $street . ' ' . ((string) $this->faker->numberBetween(1, 999)),
=======
            'name' => ($this->faker->optional()->words(2, true)) ?? null,
            'lat' => $this->faker->latitude(35.0, 47.0), // Italy bounds
            'lng' => $this->faker->longitude(6.0, 19.0),
            'street' => $street . ' ' . (string) $this->faker->numberBetween(1, 999),
>>>>>>> 19c8248 (.)
            'city' => $city,
            'state' => $state,
            'zip' => (string) $this->faker->regexify('[0-9]{5}'), // Italian ZIP code
            'formatted_address' => sprintf('%s, %s, %s, Italia', $street, $city, $state),
<<<<<<< HEAD
            'description' => $this->faker->optional()->sentence() ?? null,
=======
            'description' => ($this->faker->optional()->sentence()) ?? null,
>>>>>>> 19c8248 (.)
            'processed' => $this->faker->boolean(80), // 80% processed
        ];
    }

    /**
     * Create an unprocessed location.
     *
     * @return static
     */
    public function unprocessed(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> 19c8248 (.)
            'processed' => false,
        ]);
    }

    /**
     * Create a processed location.
     *
     * @return static
     */
    public function processed(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> 19c8248 (.)
            'processed' => true,
        ]);
    }

    /**
     * Create location in specific city.
     *
     * @param string $city
     * @param string|null $state
     * @return static
     */
<<<<<<< HEAD
    public function inCity(string $city, null|string $state = null): static
    {
        return $this->state(fn(array $attributes): array => [
            'city' => $city,
            'state' => $state ?? ((string) ($attributes['state'] ?? 'Lazio')),
            'formatted_address' => sprintf(
                '%s, %s, %s, Italia',
                (string) ($attributes['street'] ?? 'Via Roma 1'),
                $city,
                $state ?? ((string) ($attributes['state'] ?? 'Lazio')),
=======
    public function inCity(string $city, ?string $state = null): static
    {
        return $this->state(fn (array $attributes): array => [
            'city' => $city,
            'state' => $state ?? (string) ($attributes['state'] ?? 'Lazio'),
            'formatted_address' => sprintf('%s, %s, %s, Italia', 
                (string) ($attributes['street'] ?? 'Via Roma 1'), 
                $city, 
                $state ?? (string) ($attributes['state'] ?? 'Lazio')
>>>>>>> 19c8248 (.)
            ),
        ]);
    }

    /**
     * Create location with specific coordinates.
     *
     * @param float $latitude
     * @param float $longitude
     * @return static
     */
    public function withCoordinates(float $latitude, float $longitude): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> 19c8248 (.)
            'lat' => $latitude,
            'lng' => $longitude,
        ]);
    }

    /**
     * Create location in Rome.
     *
     * @return static
     */
    public function inRome(): static
    {
<<<<<<< HEAD
        return $this->inCity('Roma', 'Lazio')->withCoordinates(41.9028, 12.4964);
=======
        return $this->inCity('Roma', 'Lazio')
            ->withCoordinates(41.9028, 12.4964);
>>>>>>> 19c8248 (.)
    }

    /**
     * Create location in Milan.
     *
     * @return static
     */
    public function inMilan(): static
    {
<<<<<<< HEAD
        return $this->inCity('Milano', 'Lombardia')->withCoordinates(45.4642, 9.1900);
    }
}
=======
        return $this->inCity('Milano', 'Lombardia')
            ->withCoordinates(45.4642, 9.1900);
    }
}
>>>>>>> 19c8248 (.)
