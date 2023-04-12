<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use App\Models\Role;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Genre::create([
            'name' => 'comedy',
            'description' => 'funny stuff'
        ]);
<<<<<<< HEAD
=======
        
>>>>>>> 99ee436404a62adbbf5711760a72b5e4208d1922
        Genre::create([
            'name' => 'horror',
            'description' => 'scary stuff'
        ]);

        Author::create([
            'first_name' => 'Peter',
            'last_name' => 'Strömberg',
        ]);
        Author::create([
            'first_name' => 'Johnny',
            'last_name' => 'Hellström',
        ]);

        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'user'
        ]);

        User::create([
            'role_id' => 1,
            'user_name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@coolbooks.se',
            'phone' => '555-555-555',
            'password' => '12345',
            'is_deleted' => 0,
        ]);
        User::create([
            'role_id' => 2,
            'user_name' => 'user',
            'name' => 'user',
            'email' => 'user@coolbooks.se',
            'phone' => '666-666-666',
            'password' => '98765',
            'is_deleted' => 0,
        ]);

        $book = Book::factory(9)->create();

        Review::create([
            'book_id' => 1,
            'user_id' => 1,
            'headline' => 'my review',
            'review_text' => 'bla idafwrf lorem ipsum',
            'rating' => 4,
            'is_deleted' => 0
        ]);
        Review::create([
            'book_id' => 2,
            'user_id' => 2,
            'headline' => 'my opinion',
            'review_text' => 'this is good stuff',
            'rating' => 4,
            'is_deleted' => 0
        ]);

        $author_book = AuthorBook::factory(2)->create();
        // AuthorBook::create([
        //     'author_id' => 1,
        //     'book_id' => 1
        // ]);



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
