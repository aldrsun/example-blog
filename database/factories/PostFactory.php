<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title_words = rand(2, 5);
        $title = fake()->words($title_words, true);
        $content_sentences = rand(10,70);
        $updated_at = fake()->dateTime();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->text(100),
            'content' => fake()->paragraph($content_sentences), // password
            'updated_at' => $updated_at,
            'created_at' => fake()->dateTime($updated_at, null)
        ];
    }
}
