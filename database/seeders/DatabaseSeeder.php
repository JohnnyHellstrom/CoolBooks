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
        Genre::create([
            'name' => 'romance',
            'description' => 'even scarier than horror',
            'is_deleted' => 0,
        ]);

        Author::create([
            'first_name' => 'Peter',
            'last_name' => 'Strömberg',
            'biography' => 'Bor i Lilla Edet',
            'is_deleted' => 0
        ]);
        Author::create([
            'first_name' => 'Johnny',
            'last_name' => 'Hellström',
            'biography' => 'Bor i Uddevalla',
            'is_deleted' => 0
        ]);
        Author::create([
            'first_name' => 'Erik',
            'last_name' => 'Melin',
            'biography' => 'Bor i Hamburgsund',
            'is_deleted' => 0
        ]);

        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'user'
        ]);
        Role::create([
            'name' => 'moderator'
        ]);

        User::create([
            'role_id' => 1,
            'user_name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@coolbooks.se',
            'phone' => '555-555-555',
            'password' => bcrypt('12345'),
            'is_deleted' => 0,            
        ]);
        User::create([
            'role_id' => 2,
            'user_name' => 'user',
            'name' => 'user',
            'email' => 'user@coolbooks.se',
            'phone' => '666-666-666',
            'password' => bcrypt('987654'),
            'is_deleted' => 0,
        ]);
        User::create([
            'role_id' => 3,
            'user_name' => 'new_admin',
            'name' => 'new admin',
            'email' => 'new_admin@coolbooks.se',
            'phone' => '777-7777-777',
            'password' => bcrypt('password'),
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
        Review::create([
            'book_id' => 3,
            'user_id' => 2,
            'headline' => 'crap',
            'review_text' => 'this i not good',
            'rating' => 1,
            'is_deleted' => 0
        ]);

        // $author_book = AuthorBook::factory(2)->create();
        AuthorBook::create([
            'author_id' => 1,
            'book_id' => 1,
        ]);
        AuthorBook::create([
            'author_id' => 2,
            'book_id' => 2,
        ]);
        AuthorBook::create([
            'author_id' => 1,
            'book_id' => 3,
        ]);
        AuthorBook::create([
            'author_id' => 2,
            'book_id' => 4,
        ]);
        AuthorBook::create([
            'author_id' => 1,
            'book_id' => 5,
        ]);
        AuthorBook::create([
            'author_id' => 2,
            'book_id' => 6,
        ]);
        AuthorBook::create([
            'author_id' => 1,
            'book_id' => 7,
        ]);
        AuthorBook::create([
            'author_id' => 2,
            'book_id' => 8,
        ]);
        AuthorBook::create([
            'author_id' => 1,
            'book_id' => 9,
        ]);

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
            'comment' => 'Comment to review 1 (book 1) by user 1',
            'is_deleted' => 0
        ]); 
        Comment::create([
            'review_id' => 1,
            'user_id' => 2,
            'comment' => 'Comment to review 1 (book 1) by user 2',
            'is_deleted' => 0
        ]);
        Comment::create([
            'review_id' => 2,
            'user_id' => 2,
            'comment' => 'Comment to review 2 (book 2) by user 2',
            'is_deleted' => 0
        ]);

        Subcomment::create([
            'comment_id' => 1,
            'user_id' => 2,
            'subcomment' => 'Subcomment to comment 1, review 1 (book 1) by user 2',
            'is_deleted' => 0
        ]);
        Subcomment::create([
            'comment_id' => 2,
            'user_id' => 2,
            'subcomment' => 'Subcomment to comment 2, review 1 (book 1) by user 2',
            'is_deleted' => 0
        ]);
        Subcomment::create([
            'comment_id' => 3,
            'user_id' => 1,
            'subcomment' => 'Subcomment to comment 3, review 2 (book 2) by user 1',
            'is_deleted' => 0
        ]);
    }
}
