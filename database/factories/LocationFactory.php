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
>>>>>>> 63c6dd4 (.)
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
>>>>>>> 63c6dd4 (.)
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
            'Roma', 'Milano', 'Napoli', 'Torino', 'Palermo', 'Genova',
            'Bologna', 'Firenze', 'Bari', 'Catania', 'Venezia', 'Verona',
        ];

        $italianStreets = [
            'Via Roma', 'Via Milano', 'Via Garibaldi', 'Via Mazzini',
            'Via Dante', 'Via Verdi', 'Corso Italia', 'Piazza Duomo',
        ];

        $italianRegions = [
            'Lazio', 'Lombardia', 'Campania', 'Piemonte', 'Sicilia',
            'Liguria', 'Emilia-Romagna', 'Toscana',
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
>>>>>>> 63c6dd4 (.)
        ];

        /** @var string $city */
        $city = (string) $this->faker->randomElement($italianCities);
        /** @var string $street */
        $street = (string) $this->faker->randomElement($italianStreets);
        /** @var string $state */
        $state = (string) $this->faker->randomElement($italianRegions);

        return [
            'name' => ($this->faker->optional()->words(2, true)) ?? null,
            'lat' => $this->faker->latitude(35.0, 47.0), // Italy bounds
            'lng' => $this->faker->longitude(6.0, 19.0),
<<<<<<< HEAD
            'street' => $street.' '.(string) $this->faker->numberBetween(1, 999),
=======
            'street' => $street . ' ' . (string) $this->faker->numberBetween(1, 999),
>>>>>>> 63c6dd4 (.)
            'city' => $city,
            'state' => $state,
            'zip' => (string) $this->faker->regexify('[0-9]{5}'), // Italian ZIP code
            'formatted_address' => sprintf('%s, %s, %s, Italia', $street, $city, $state),
            'description' => ($this->faker->optional()->sentence()) ?? null,
            'processed' => $this->faker->boolean(80), // 80% processed
        ];
    }

    /**
     * Create an unprocessed location.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 63c6dd4 (.)
     */
    public function unprocessed(): static
    {
        return $this->state(fn (array $attributes): array => [
            'processed' => false,
        ]);
    }

    /**
     * Create a processed location.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 63c6dd4 (.)
     */
    public function processed(): static
    {
        return $this->state(fn (array $attributes): array => [
            'processed' => true,
        ]);
    }

    /**
     * Create location in specific city.
<<<<<<< HEAD
=======
     *
     * @param string $city
     * @param string|null $state
     * @return static
>>>>>>> 63c6dd4 (.)
     */
    public function inCity(string $city, ?string $state = null): static
    {
        return $this->state(fn (array $attributes): array => [
            'city' => $city,
            'state' => $state ?? (string) ($attributes['state'] ?? 'Lazio'),
<<<<<<< HEAD
            'formatted_address' => sprintf('%s, %s, %s, Italia',
                (string) ($attributes['street'] ?? 'Via Roma 1'),
                $city,
=======
            'formatted_address' => sprintf('%s, %s, %s, Italia', 
                (string) ($attributes['street'] ?? 'Via Roma 1'), 
                $city, 
>>>>>>> 63c6dd4 (.)
                $state ?? (string) ($attributes['state'] ?? 'Lazio')
            ),
        ]);
    }

    /**
     * Create location with specific coordinates.
<<<<<<< HEAD
=======
     *
     * @param float $latitude
     * @param float $longitude
     * @return static
>>>>>>> 63c6dd4 (.)
     */
    public function withCoordinates(float $latitude, float $longitude): static
    {
        return $this->state(fn (array $attributes): array => [
            'lat' => $latitude,
            'lng' => $longitude,
        ]);
    }

    /**
     * Create location in Rome.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 63c6dd4 (.)
     */
    public function inRome(): static
    {
        return $this->inCity('Roma', 'Lazio')
            ->withCoordinates(41.9028, 12.4964);
    }

    /**
     * Create location in Milan.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 63c6dd4 (.)
     */
    public function inMilan(): static
    {
        return $this->inCity('Milano', 'Lombardia')
            ->withCoordinates(45.4642, 9.1900);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 63c6dd4 (.)
