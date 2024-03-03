<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class clientesModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name,
            'apellidoPaterno' => fake()->lastName(),
            'apellidoMaterno' => fake()->lastName(),
            'rfc' => fake()->word(),
            'telefono' => fake()->phoneNumber(),
            'correo' => fake()->unique()->email(),
            'direccion' => fake()->address(),
            'idProducto' => fake()->numberBetween(1, 50),
        ];
    }
}
