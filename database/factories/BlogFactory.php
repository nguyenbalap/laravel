<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->text($maxNbChars = 200),
            "content" => $this->faker->text($maxNbChars = 10000),
            "image" => $this->faker->imageUrl(),
            "footer" => $this->faker->text($maxNbChars = 1000),
        ];
    }
}