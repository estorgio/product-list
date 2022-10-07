<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->words(2, true),
            'price' => fake()->randomFloat(2, 1, 300),
            'quantity' => fake()->randomNumber(2),
            'barcode' => fake()->unique()->randomNumber(8, true),
        ];
    }
}
