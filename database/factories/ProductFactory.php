<?php

namespace Database\Factories;

use App\Enums\ProductEnumType;
use App\Models\Producer;
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
            "name" => $this->faker->bothify('Product ##??'),
            "price" => $this->faker->numberBetween($min = 10000, $max = 100000),
            "description" => $this->faker->text($maxNbChars = 200),
            "image" => $this->faker->imageUrl(),
            "type" => $this->faker->randomElement(ProductEnumType::asArray()),
            "producer_id" => Producer::inRandomOrder()->value('id'),
        ];
    }
}