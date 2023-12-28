<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuestBorrow>
 */
class GuestBorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'card_id' => fake()->randomNumber(9, true),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'address' => fake()->address(),
            'birth_date' => fake()->date(),
            'gender' => fake()->randomElement(['m' , 'f']),
            'occupation' => fake()->jobTitle(),
            'phone_no' => fake()->phoneNumber(),
            'book_id' => fake()->numberBetween(1, 50),
        ];
    }
}
