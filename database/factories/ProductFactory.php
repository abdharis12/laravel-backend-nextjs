<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition(): array
    {
        return [
            //
            'category_id' => Category::factory(),
            'name' => $name = $this->faker->sentence(),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(25),
            'price' => rand(111111, 999999),
        ];
    }
}
