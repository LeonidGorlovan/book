<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
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
        $genre = [
            'Fantasy',
            'Fiction',
            'Detectives',
            'Love Affairs',
            'Psychology',
            'History',
            'Horrors',
            'Adventures',
            'Poetry',
            'Erotica',
            'Thrillers'
        ];

        $genre = collect($genre)->random();

        return [
            'title' => fake()->text(80),
            'publisher' => fake()->company(),
            'author' => fake()->name(),
            'genre' => $genre,
            'publication' => fake()->date(),
            'amount_words_book' => fake()->numberBetween(100, 1000),
            'price' => fake()->randomFloat(4, 1, 1000),
        ];
    }
}
