<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class productosModelFactory extends Factory
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
            'descripcion' => fake()->word,
            'precio' => fake()->numberBetween(10, 1000),
            'expiracion' => fake()->date(),
            'stock' => fake()->numberBetween(1, 100),
            'idProveedor' => fake()->numberBetween(1, 50),
        ];
    }
}
