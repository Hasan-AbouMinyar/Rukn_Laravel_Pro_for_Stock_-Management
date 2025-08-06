<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = \App\Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->colorName, // as like category
        ];
    }
}
