<?php

namespace Database\Factories;

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
        return [
            'genre_id' => $this->faker->randomElement([1, 2]),
            'user_id' => $this->faker->randomElement([1, 2]),
            'title' => $this->faker->unique()->word(2),
            'genre_id' => 1,
            'user_id' => 1,
            'title' => $this->faker->unique()->sentence(2),
            'ISBN' => $this->faker->regexify('[0-9]{3}-[0-9]{5}-[0-9]{3}-[0-9]{4}'),
            'tags' => 'horror,scary,funnny',
            'description' => $this->faker->sentence(5),
            'is_deleted' => 0
        ];
    }
}
