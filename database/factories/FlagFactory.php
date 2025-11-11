<?php

namespace Database\Factories;

use App\Models\EconomicGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flag>
 */
class FlagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word, 
            'economic_group_id' => EconomicGroup::inRandomOrder()->first()->id,
        ];
    }
}