<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $number = fake()->numberBetween(30, 100);
        return [
            'ISBN' => fake()->unique()->randomNumber(9, true),
            'DDC' => fake()->word() . fake()->randomNumber(3, true),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'author_id' => fake()->numberBetween(1, 50),
            'published_at' => fake()->date(),
            'copies_no' => $number,
            'available' => $number,
        ];
    }
}
