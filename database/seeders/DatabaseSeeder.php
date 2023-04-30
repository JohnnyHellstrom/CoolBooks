<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use App\Models\Book;
use App\Models\Role;
use App\Models\Genre;
use App\Models\Quote;
use App\Models\Author;
use App\Models\Review;
use App\Models\Comment;
use App\Models\AuthorBook;

use App\Models\GenreQuote;
use App\Models\SubComment;
use App\Models\LikedReview;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genre = [
            'Fantasy', 'Comedy', 'Horror', 'Romance', 'Adventure', 'Mystery', 'Dystopian', 'Thriller',
            'Science Fiction', 'Drama', 'LGBTQ+', 'Fiction', 'Childrens', 'History'
        ];
        $description = [
            'This book genre is characterized by elements of magic or the supernatural and is often inspired by mythology or folklore.',

            'Laugh-out-loud memoirs by the funniest celebs, satirical essays from the likes of David Sedaris, or gag gifts like How to Adult — all the books in this rib-tickling genre are written with one thing in mind: making readers laugh!',

            'What unites the books in this genre is not theme, plot, or setting, but the feeling they inspire in the reader: your pulse quickens, and your skin prickles as you turn the page with bated breath.',

            'Romance is so frequently used as a subplot that it can sometimes be tricky to know whether or not you’re writing in this genre. The key thing to remember is that the romantic relationship must be the center point of the plot. (Other giveaways include a “happily ever after” ending and the warm fuzzies.) If your novel has a romantic relationship at its heart and is perfectly at home in another genre, it probably falls into one of romance’s many subgenres, including but not limited to: young adult romance, paranormal romance, and historical romance.',

            'If you’re writing adventure, then chances are your book follows the structure of the Hero’s Journey. Your protagonist has a very important goal to achieve, but they’re really going to have to go through the wringer first! You throw up obstacle after obstacle, putting your hero in downright dangerous situations but eventually, they triumph and return home transformed. The action and adventure genre also complements a huge range of others, which means it has its fingers in everything from fantasy novels like The Hobbit to classic romance like Jane Eyre.',

            'Also called detective fiction, this book genre is characterized by a gripping plot that revolves around a mystery — but hopefully, you’ve cracked that clue! The setting, characters, and tone of your book will determine precisely which category it falls under: cozy mystery, hardboiled, or something in between. But at the core of any mystery is a crime that must be solved by the protagonist. To get a sense of the clever trail of clues that’s so vital to this genre, check out Murder on the Orient Express by Agatha Christie — the grande dame of mystery fiction.',

            'A popular genre of science fiction, dystopian novels offer a bleak and frightening vision of the future. Authors writing dystopias imagine a grim society, often in the aftermath of a disaster, facing things like oppressive governments, Black Mirror-esque technology, and environmental ruin.',

            'A horror story can also be called a thriller, if it employs psychological fear to build suspense. But not all thrillers are horror stories. So what are they? While this book genre encompasses many of the same elements as mystery, in a thriller the protagonist is usually acting to save their own life, rather than to solve the crime. Thrillers typically include cliffhangers, deception, high emotional stakes, and plenty of action — keeping the reader on the edge of their seat until the book’s climax. Gillian Flynn’s Gone Girl is a masterclass in the dark, mysterious thriller.',

            'Though science fiction and fantasy are often considered two sides of the same (speculative fiction) coin, sci-fi is distinguished by its preoccupation with real or real-feeling science. Lots of sci-fi is set in the distant future, which makes it a seedbed for stories about time travel and space exploration.',

            'Drama is the specific mode of fiction represented in performance. The term comes from a Greek word meaning "action" (Classical Greek: δρᾶμα, drama), which is derived from "to do" or "to act" (Classical Greek: δράω, draō). The enactment of drama in theatre, performed by actors on a stage before an audience, presupposes collaborative modes of production and a collective form of reception. The structure of dramatic texts, unlike other forms of literature, is directly influenced by this collaborative production and collective reception.',

            'Any fiction with authentic LGBTQ+ representation falls into this book genre. It’s important to note that while your book’s queer characters should feature in the main plot, the centerpiece of your plot doesn’t have to be a romance. In fact, there doesn’t need to be any romance at all! This means that your fantasy, thriller, or historical novel could fall under the LGBTQ+ umbrella. ',

            'Fiction is the telling of stories which are not real. More specifically, fiction is an imaginative form of narrative, one of the four basic rhetorical modes. Although the word fiction is derived from the Latin fingo, fingere, finxi, fictum, "to form, create", works of fiction need not be entirely imaginary and may include real people, places, and events.',

            "Children's literature is for readers and listeners up to about age 12. It is often illustrated. The term is used in senses that sometimes exclude young-adult fiction, comic books, or other genres. Books specifically for children existed at least several hundred years ago.",

            'History (from Greek ἱστορία - historia, meaning "inquiry, knowledge acquired by investigation") is the discovery, collection, organization, and presentation of information about past events. History can also mean the period of time after writing was invented. Scholars who write about history are called historians.'
        ];
        for ($i = 0; $i < 14; $i++) {

            Genre::create([
                'name' => $genre[$i],
                'description' => $description[$i],
                'is_deleted' => 0,
            ]);
        }
        // Genre::create([
        //     'name' => 'comedy',
        //     'description' => 'funny stuff',
        //     'is_deleted' => 0,
        // ]);
        // Genre::create([
        //     'name' => 'horror',
        //     'description' => 'scary stuff',
        //     'is_deleted' => 0,
        // ]);
        // Genre::create([
        //     'name' => 'romance',
        //     'description' => 'even scarier than horror',
        //     'is_deleted' => 0,
        // ]);

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
        // DO NOT TOUCH THIS ORDER
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

        //seed books with title and the right cover
        $title = [
            "Lord of the rings",
            "Ender's Game",
            "For the Love of the Game",
            "The Lying Game",
            "After Francesco",
            "And Every Morning the Way Home Gets Longer",
            "Blood of Elves",
            "The Book of Zog",
            "The Colour of Magic",
            "Dracula",
            "Fairy Tale",
            "The Story of Ferdinand",
            "Harry Potter and the Philosopher's Stone",
            "The Hunger Games",
            "Twilight",
            "The Great Gatsby",
            "The Diary of a Young Girl",
            "The Hobbit",
            "Lord of the Flies",
            "Night Terrors"
        ];

        $covers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        $genre = [1, 9, 10, 6, 11, 12, 1, 1, 1, 3, 3, 13, 1, 7, 4, 12, 14, 5, 12, 3];

        for ($i = 0; $i <= 19; $i++) {
            $faker = Factory::create();

            $user_id = random_int(1, 2);

            Book::create([
                'genre_id' => $genre[$i],
                'user_id' => $user_id,
                'title' => $title[$i],
                'image' => 'book_images/' . $covers[$i] . '.jpg',
                'ISBN' => $faker->regexify('[0-9]{3}-[0-9]{5}-[0-9]{3}-[0-9]{4}'),
                'tags' => 'horror,scary,funnny',
                'description' => $faker->sentence(5),
                'is_deleted' => 0
            ]);
        }

        // $book = Book::factory(9)->create();


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

        //seed Authors
        for ($i = 1; $i <= 20; $i++) {
            $id = random_int(1, 2);
            AuthorBook::create([
                'author_id' => $id,
                'book_id' => $i,
            ]);
        }

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

        $genreQuotes = ['Love', 'Life', 'Inspirational', 'Humor', 'Wisdom', 'Faith', 'Philosophy'];
        for ($i = 0; $i < 7; $i++) {
            GenreQuote::create([
                'name' => $genreQuotes[$i],
                'is_deleted' => 1,
            ]);
        }
        Quote::create([
            'genre_quote_id' => rand(1, 7),
            'user_id' => rand(1, 3),
            'quote' => 'Life is like riding a bicycle. To keep your balance, you must keep moving.',
            'quotee' => 'Albert Einstein',
            'is_moderated' => rand(0, 1),
            'is_deleted' => 0,
        ]);
        Quote::create([
            'genre_quote_id' => rand(1, 7),
            'user_id' => rand(1, 3),
            'quote' => 'Gravitation is not responsible for people falling in love.',
            'quotee' => 'Albert Einstein',
            'is_moderated' => rand(0, 1),
            'is_deleted' => 0,
        ]);
        Quote::create([
            'genre_quote_id' => rand(1, 7),
            'user_id' => rand(1, 3),
            'quote' => 'Great spirits have always encountered violent opposition from mediocre minds.',
            'quotee' => 'Albert Einstein',
            'is_moderated' => rand(0, 1),
            'is_deleted' => 0,
        ]);
        Quote::create([
            'genre_quote_id' => rand(1, 7),
            'user_id' => rand(1, 3),
            'quote' => 'Creativity is intelligence having fun.',
            'quotee' => 'Albert Einstein',
            'is_moderated' => 0,
            'is_deleted' => 0,
        ]);
    }
}
