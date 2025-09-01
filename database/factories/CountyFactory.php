<?php

declare(strict_types=1);

namespace Modules\Geo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Geo\Models\County;

/**
 * County Factory
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> 63c6dd4 (.)
 * @extends Factory<County>
 */
class CountyFactory extends Factory
{
    protected $model = County::class;

    public function definition(): array
    {
        $italianCounties = [
            'Provincia di Milano', 'Provincia di Roma', 'Provincia di Napoli',
            'Provincia di Torino', 'Provincia di Palermo', 'Provincia di Genova',
            'Provincia di Bologna', 'Provincia di Firenze', 'Provincia di Bari',
<<<<<<< HEAD
            'Provincia di Catania', 'Provincia di Venezia', 'Provincia di Verona',
=======
            'Provincia di Catania', 'Provincia di Venezia', 'Provincia di Verona'
>>>>>>> 63c6dd4 (.)
        ];

        return [
            'state_id' => $this->faker->numberBetween(1, 20),
            'county' => $this->faker->randomElement($italianCounties),
            'state_index' => $this->faker->numberBetween(1, 110),
        ];
    }

    public function lombardia(): static
    {
        return $this->state(fn (array $attributes): array => [
            'county' => $this->faker->randomElement([
                'Provincia di Milano', 'Provincia di Brescia', 'Provincia di Bergamo',
<<<<<<< HEAD
                'Provincia di Como', 'Provincia di Varese', 'Provincia di Pavia',
=======
                'Provincia di Como', 'Provincia di Varese', 'Provincia di Pavia'
>>>>>>> 63c6dd4 (.)
            ]),
        ]);
    }
}
