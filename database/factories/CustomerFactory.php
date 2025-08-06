<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = \App\Customer::class;

    public function definition(): array
    {
        return [
            'c_name' => $this->faker->name,
            'company_name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->e164PhoneNumber,
            'address'=> $this->faker->address,
        ];
    }
}
