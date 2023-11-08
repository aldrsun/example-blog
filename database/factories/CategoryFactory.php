<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_name_words = rand(1,3);
        $category_name = fake()->words($category_name_words, true);
        return [
            'slug' => Str::slug($category_name),
            'name' => $category_name
        ];
    }
}
