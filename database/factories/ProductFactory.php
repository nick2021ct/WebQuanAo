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
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'gender' => 1,
            'price' => '10.9',
            'priceSale' => '12',
            'description' => 'day la description',
            'view' => 0,
            'idBrand' => 1,
            'idCategory' => 1
        ];
    }
}
