<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->colorName,
            'cat_name' => $this->faker->colorName, // as like category name
            'code' => $this->faker->ean8, // as like product code
            'description' => $this->faker->text(80),
        ];
    }
}
