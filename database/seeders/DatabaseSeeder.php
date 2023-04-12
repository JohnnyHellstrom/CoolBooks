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
        
        Genre::create([
            'name' => 'horror',
            'description' => 'scary stuff'
        ]);

        $author = Author::create([
            'first_name' => 'Peter',
            'last_name' => 'Strömberg',
        ]);

        $role = Role::create([
            'name' => 'admin'
        ]);

        $user = User::create([
            'role_id' => 1,
            'user_name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.se',
            'phone' => '555-555-555',
            'password' => '12345',
            'is_deleted' => 0,
        ]);

        $book = Book::factory(9)->create();

        $review = Review::create([
            'book_id' => 1,
            'user_id' => 1,
            'headline' => 'my review',
            'review_text' => 'bla idafwrf lorem ipsum',
            'rating' => 4,
            'is_deleted' => 0
        ]);

        $author_book = AuthorBook::create([
            'author_id' => 1,
            'book_id' => 1
        ]);



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
