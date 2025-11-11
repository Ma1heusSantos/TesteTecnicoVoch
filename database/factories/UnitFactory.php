<?php

namespace Database\Factories;

use App\Models\Flag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_fantasia' => $this->faker->company, 
            'razao_social' => $this->faker->company, 
            'cnpj' => $this->generateCnpj(),
            'flag_id' => Flag::inRandomOrder()->first()->id, 
        ];
    }

    private function generateCnpj()
    {
        $cnpj = $this->faker->numerify('########0001##');
        return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    }
}