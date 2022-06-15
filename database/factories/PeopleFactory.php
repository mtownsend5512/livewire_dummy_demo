<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => ucwords($this->faker->word()),
            'last_name' => ucwords($this->faker->word()),
            'age' => $this->faker->numberBetween(18, 65),
        ];
    }
}
