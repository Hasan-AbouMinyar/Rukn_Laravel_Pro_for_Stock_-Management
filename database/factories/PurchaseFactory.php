<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Purchase>
 */
class PurchaseFactory extends Factory
{
    protected $model = \App\Purchase::class;

    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(3, 20),
            'supplier_id' => $this->faker->numberBetween(3, 20),
            'product_quantity' => $this->faker->numberBetween(25, 600),
            'retail_price' => $this->faker->randomFloat(2, 100.00, 1000.00),
            'sale_price' => $this->faker->randomFloat(2, 100.00, 1000.00),
        ];
    }
}
