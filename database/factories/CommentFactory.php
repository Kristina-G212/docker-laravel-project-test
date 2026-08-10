<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'user_id' => User::factory(),
      'book_id' => Book::factory(),
      'rating' => fake()->numberBetween(1, 5),
      'description' => fake()->text(),
      'plus' => fake()->text(100),
      'minus' => fake()->text(100),
      'anonymous' => rand(0, 1),
    ];
  }
}
