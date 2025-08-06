<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Sales>
 */
class SalesFactory extends Factory
{
    protected $model = \App\Sales::class;

    public function definition(): array
    {
        return [
            'purchases_id' => $this->faker->numberBetween(3, 20),
            'customer_id' => $this->faker->numberBetween(3, 20),
            'quantity' => $this->faker->numberBetween(25, 600),
            't_price' => $this->faker->randomFloat(2, 100.00, 1000.00),
        ];
    }
}
