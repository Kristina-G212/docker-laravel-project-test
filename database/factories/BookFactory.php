<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
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
    return [
      'genre_id' => Genre::factory(),
      'author_id' => Author::factory(),
      'title' => fake()->text(10),
      'description' => fake()->text(),
      'price' => fake()->numberBetween(50, 5000),
      'old_price' => fake()->numberBetween(50, 5000),
      'year' => fake()->year()
    ];
  }

  public function configure()
  {
    return $this->afterCreating(function (Book $book) {
      $url = 'https://loremflickr.com/1200/800';
      $book
        ->addMediaFromUrl($url)
        ->toMediaCollection('book-picture');
      $book
        ->addMediaFromUrl($url)
        ->toMediaCollection('book-picture');
      $book
        ->addMediaFromUrl($url)
        ->toMediaCollection('preview');
    });
  }
}
