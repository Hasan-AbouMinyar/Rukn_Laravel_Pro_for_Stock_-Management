<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Customer;
use App\Category;
use App\Product;
use App\Supplier;
use App\Purchase;
use App\Sales;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        Customer::factory()->count(40)->create();
        Category::factory()->count(25)->create();
        Product::factory()->count(35)->create();
        Supplier::factory()->count(30)->create();
        Purchase::factory()->count(20)->create();
        Sales::factory()->count(20)->create();
    }
}
