<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Override;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'first_name' => fake()->firstName(),
      'last_name' => fake()->lastName(),
      'middle_name' => fake()->firstName(),
      'nickname' => fake()->userName()
    ];
  }

  /**
   * Configure the model factory
   * 
   * @return $this
   */
  #[Override]
  public function configure()
  {
    return $this->afterCreating(function (Author $author) {
      $url = 'https://loremflickr.com/1200/800';
      $author->addMediaFromUrl($url)->toMediaCollection('author-photo');
    });
  }
}
