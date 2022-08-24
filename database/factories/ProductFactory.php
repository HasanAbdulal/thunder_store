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
            'name' =>           $this->faker->sentence(),
            'description' =>    $this->faker->sentence(rand(5, 9), true),
            'image' =>          $this->faker->imageUrl(),
            'price' =>          rand(1000, 990000),
            'active' =>         $this->faker->boolean(90),
        ];
    }
}
