<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
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
        // $this->call([ 
        //     AuthorSeeder::class,
        //     BookSeeder::class,
        //     GenreSeeder::class,
        //     UserSeeder::class
        //     ]);

        User::factory()->count(10)->create();
        $author = Author::factory()->count(15)->create();
        $genre = Genre::factory()->count(3)->create();

        Book::factory()
            ->recycle($author)
            ->recycle($genre)
            ->count(30)
            ->create();
    }
}
