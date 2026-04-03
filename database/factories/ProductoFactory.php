<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
// En ProductoFactory.php
public function definition(): array
{
    return [
        'nombre' => fake()->unique()->word(), // Agrega ->unique() aquí
        'categoria_id' => Categoria::factory(),
        'precio' => fake()->randomFloat(2, 10, 100),
        'stock' => fake()->numberBetween(1, 100),
    ];
}
}