<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $name = $this->faker->sentence();

        return [
            'name' =>           $name,
            'description' =>    $this->faker->sentences(rand(5, 9), true),
            'image' =>          $this->faker->imageUrl(),
            'slug' =>           Str::slug($name),
            'price' =>          rand(1000, 99000),
            'active' =>         $this->faker->boolean(90),
        ];
    }
}
