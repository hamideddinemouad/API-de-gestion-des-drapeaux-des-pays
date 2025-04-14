<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->country(),
            'region' =>fake()->
                       randomElement(['Asia', 'Europe', 'Africa', 'South America', 'North America', 'Australia']),
            'capital' =>fake()->city(),
            'population' => fake()->numberBetween('100000', '10000000')
            //
        ];
    }
}
