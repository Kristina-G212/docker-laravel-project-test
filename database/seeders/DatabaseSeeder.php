<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $users = User::factory()
      ->count(10)
      ->create();

    $authors = Author::factory()
      ->count(15)
      ->create();
    $genres = Genre::factory()
      ->count(3)
      ->create();

    $books = Book::factory()
      ->recycle($authors)
      ->recycle($genres)
      ->count(30)
      ->create();

    foreach ($users as $user) {
      $favoriteBooks = $books->random(rand(0, 10));

      foreach ($favoriteBooks as $favoriteBook) {
        Favorite::factory()
          ->create([
            'user_id' => $user->id,
            'book_id' => $favoriteBook->id
          ]);
      }

      Comment::factory()
        ->count(rand(0, 5))
        ->create([
          'user_id' => $user->id,
          'book_id' => $books->random()->id
        ]);
    }
  }
}
