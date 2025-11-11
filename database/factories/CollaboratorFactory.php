<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaborator>
 */
class CollaboratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name, 
            'email' => $this->faker->unique()->safeEmail, 
            'cpf' => $this->generateCpf(), 
            'unit_id' => Unit::inRandomOrder()->first()->id, 
        ];
    }

    private function generateCpf()
    {
        $cpf = $this->faker->numerify('###########');
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
}