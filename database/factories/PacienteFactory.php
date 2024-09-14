<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'ci' => $this->faker->unique()->numerify('##########'),
            'nro_seguro' => $this->faker->unique()->numerify('########'),
            'fecha_nacimiento' => $this->faker->date('y-m-d', 'now'),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'celular' => $this->faker->phoneNumber,
            'correo' => $this->faker->unique()->safeEmail,
            'direccion' => $this->faker->address,
            'grupo_sanguineo' => $this->faker->randomElement(['A+','A-', 'B+', 'B-', 'O+', 'O-']),
            'alergias' => $this->faker->words(3,true),
            'contacto_emergencia' => $this->faker->phoneNumber,
            'observaciones' => $this->faker->words(3, true),
        ];
    }
}
