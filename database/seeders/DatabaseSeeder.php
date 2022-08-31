<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *  Magical techniques that prevent loops
     *  Each of the ten users you create using the method "has," which has a link with orders, will have three orders.
     *  When we have a child who belongs to a "many to many" connection, I employ the approach "hasAttached."
     *  Then I make five products with a total price between one and nine euros and a total quantity between one and three.
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)
        ->has(
            Order::factory()->count(3)
                ->hasAttached(
                    Product::factory()->count(5),
                    ['total_price' => rand(100, 900), 'total_quantity' => rand(1, 3)]
                )
        )->create();
    }
}
