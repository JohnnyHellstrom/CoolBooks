<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use App\Models\Role;
use App\Models\Genre;
use App\Models\LikedReview;
use App\Models\Review;
use App\Models\Comment;
use App\Models\SubComment;

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
            'description' => 'funny stuff',
            'is_deleted' => 0,
        ]);

        Genre::create([
            'name' => 'horror',
            'description' => 'scary stuff',
            'is_deleted' => 0,
        ]);

        Author::create([
            'first_name' => 'Peter',
            'last_name' => 'Strömberg',
            'biography' => 'är inte ett arsle',
            'is_deleted' => 0
        ]);
        Author::create([
            'first_name' => 'Johnny',
            'last_name' => 'Hellström',
            'biography' => 'är inte ett arsle',
            'is_deleted' => 0
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
            'rating' => 3,
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

        LikedReview::create([
            'user_id' => 1,
            'review_id' => 2,
            'liked' => 1
        ]);
        LikedReview::create([
            'user_id' => 2,
            'review_id' => 1,
            'liked' => 0
        ]);

        Comment::create([
            'review_id' => 1,
            'user_id' => 1,
            'comment' => 'johnny is an ass',
            'is_deleted' => 0
        ]); 
        Comment::create([
            'review_id' => 1,
            'user_id' => 1,
            'comment' => 'erik is an ass',
            'is_deleted' => 0
        ]);

        Subcomment::create([
            'comment_id' => 1,
            'user_id' => 1,
            'subcomment' => 'johnny is an ass',
            'is_deleted' => 0
        ]);
        Subcomment::create([
            'comment_id' => 2,
            'user_id' => 2,
            'subcomment' => 'johnny is an ass',
            'is_deleted' => 0
        ]);

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
