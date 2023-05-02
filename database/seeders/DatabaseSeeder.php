<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use Carbon\Carbon;
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

        $authorFirstName = [
            "J.R.R.", "Orson", "Michael", "Ruth",  "Brian", "Fredrik", "Andrzej", 
            "Alec", "Terry",  "Bram",  "Stephen", "Munro", "J.K.", "Suzanne", 
            "Stephenie", "F. Scott", "Anne", "William", "Peter",             
        ];

        $authorLastName = [
            "Tolkien", "Scott Card",  "Shaara", "Ware",  "Malloy",
            "Backman", "Sapkowski", "Hutson", "Pratchett", "Stoker",
            "King", "Leaf", "Rowling", "Collins", "Meyer", "Fitzgerald",
            "Frank", "Golding", "Cronsberry",
        ];
        $authorBiography = [
            "John Ronald Reuel Tolkien: writer, artist, scholar, linguist. Known to millions around the world as the author of The Lord of the Rings, Tolkien spent most of his life teaching at the University of Oxford where he was a distinguished academic in the fields of Old and Middle English and Old Norse. His creativity, confined to his spare time, found its outlet in fantasy works, stories for children, poetry, illustration and invented languages and alphabets.",

            "Orson Scott Card is the author of the novels Ender's Game, Ender's Shadow, and Speaker for the Dead, which are widely read by adults and younger readers, and are increasingly used in schools.
            Besides these and other science fiction novels, Card writes contemporary fantasy (Magic Street, Enchantment, Lost Boys), biblical novels (Stone Tables, Rachel and Leah), the American frontier fantasy series The Tales of Alvin Maker (beginning with Seventh Son), poetry (An Open Book), and many plays and scripts.            
            Card was born in Washington and grew up in California, Arizona, and Utah. He served a mission for the LDS Church in Brazil in the early 1970s. Besides his writing, he teaches occasional classes and workshops and directs plays. He recently began a long-term position as a professor of writing and literature at Southern Virginia University.",

            "Michael Shaara was an American writer of science fiction, sports fiction, and historical fiction. He was born to Italian immigrant parents (the family name was originally spelled Sciarra, which in Italian is pronounced the same way) in Jersey City, New Jersey, graduated from Rutgers University in 1951, and served as a sergeant in the 82nd Airborne division prior to the Korean War.",

            "Ruth Ware grew up in Sussex, on the south coast of England. After graduating from Manchester University she moved to Paris, before settling in North London. She has worked as a waitress, a bookseller, a teacher of English as a foreign language and a press officer. She is married with two small children, and In a Dark, Dark Wood is her début thriller.",

            "Thanks for stopping by! My novels are The Year of Ice (St. Martin's Press), Brendan Wolf (St. Martin's Press), and the young-adult novel Twelve Long Months (Scholastic). I regained the rights to my first two novels from St. Martin's Press, and have re-published them under my own imprint. ",

            "Fredrik Backman is the #1 New York Times bestselling author of A Man Called Ove (soon to be a major motion picture starring Tom Hanks), My Grandmother Asked Me to Tell You She’s Sorry, Britt-Marie Was Here, Beartown, Us Against You, as well as two novellas, And Every Morning the Way Home Gets Longer and Longer and The Deal of a Lifetime. Things My Son Needs to Know About the World, his first work of non-fiction, will be released in the US in May 2019. His books are published in more than forty countries. He lives in Stockholm, Sweden, with his wife and two children.",

            "Andrzej Sapkowski, born June 21, 1948 in Łódź, is a Polish fantasy writer. Sapkowski studied economics, and before turning to writing, he had worked as a senior sales representative for a foreign trade company. His first short story, The Witcher (Wiedźmin), was published in Fantastyka, Poland's leading fantasy literary magazine, in 1986 and was enormously successful both with readers and critics. Sapkowski has created a cycle of tales based on the world of The Witcher, comprising three collections of short stories and five novels. This cycle and his many other works have made him one of the best-known fantasy authors in Poland in the 1990s.",

            "Alec Hutson grew up in a geodesic dome and a bookstore and he currently lives in Shanghai, China with his lovely wife Shining.",

            "Born Terence David John Pratchett, Sir Terry Pratchett sold his first story when he was thirteen, which earned him enough money to buy a second-hand typewriter. His first novel, a humorous fantasy entitled The Carpet People, appeared in 1971 from the publisher Colin Smythe. ",

            "Stephen Edwin King was born the second son of Donald and Nellie Ruth Pillsbury King. After his father left them when Stephen was two, he and his older brother, David, were raised by his mother. Parts of his childhood were spent in Fort Wayne, Indiana, where his father's family was at the time, and in Stratford, Connecticut. When Stephen was eleven, his mother brought her children back to Durham, Maine, for good. Her parents, Guy and Nellie Pillsbury, had become incapacitated with old age, and Ruth King was persuaded by her sisters to take over the physical care of them. Other family members provided a small house in Durham and financial support. After Stephen's grandparents passed away, Mrs. King found work in the kitchens of Pineland, a nearby residential facility for the mentally challenged.",

            "Irish-born Abraham Stoker, known as Bram, of Britain wrote the gothic horror novel Dracula (1897). ",

            "Wilbur Monroe Leaf AKA Munro Leaf, author and illustrator of dozens of children’s books.",

            "Although she writes under the pen name J.K. Rowling, pronounced like rolling, her name when her first Harry Potter book was published was simply Joanne Rowling. Anticipating that the target audience of young boys might not want to read a book written by a woman, her publishers demanded that she use two initials, rather than her full name. As she had no middle name, she chose K as the second initial of her pen name, from her paternal grandmother Kathleen Ada Bulgen Rowling. She calls herself Jo and has said, -No one ever called me 'Joanne' when I was young, unless they were angry. Following her marriage, she has sometimes used the name Joanne Murray when conducting personal business. During the Leveson Inquiry she gave evidence under the name of Joanne Kathleen Rowling. In a 2012 interview, Rowling noted that she no longer cared that people pronounced her name incorrectly.",

            "Since 1991, Suzanne Collins has been busy writing for children’s television. She has worked on the staffs of several Nickelodeon shows, including the Emmy-nominated hit Clarissa Explains it All and The Mystery Files of Shelby Woo. For preschool viewers, she penned multiple stories for the Emmy-nominated Little Bear and Oswald. She also co-wrote the critically acclaimed Rankin/Bass Christmas special, Santa, Baby! Most recently she was the Head Writer for Scholastic Entertainment’s Clifford’s Puppy Days.",

            "Stephenie Meyer is the author of the bestselling Twilight series, The Host, and The Chemist. Twilight was one of 2005's most talked about novels and within weeks of its release the book debuted at #5 on The New York Times bestseller list.",

            "Francis Scott Key Fitzgerald was an American writer of novels and short stories, whose works have been seen as evocative of the Jazz Age, a term he himself allegedly coined. He is regarded as one of the greatest twentieth century writers. Fitzgerald was of the self-styled `Lost Generation,` Americans born in the 1890s who came of age during World War I. He finished four novels, left a fifth unfinished, and wrote dozens of short stories that treat themes of youth, despair, and age. He was married to Zelda Fitzgerald.",

            "Annelies Marie ,Anne, Frank was a Jewish girl born in the city of Frankfurt, Germany. Her father moved to the Netherlands in 1933 and the rest of the family followed later. Anne was the last of the family to come to the Netherlands, in February 1934. She wrote a diary while in hiding with her family and four friends in Amsterdam during the German occupation of the Netherlands in World War II.",

            "People note British writer Sir William Gerald Golding for his dark novels, especially The Lord of the Flies (1954); he won the Nobel Prize of 1983 for literature.
            People best know this British novelist, poet, and playwright for this novel. Golding spent two years, focusing on sciences, in Oxford but changed his educational emphasis to English, especially Anglo-Saxon, literature.",

            "He is a mystery to us here at CoolBooks, got any info?."
        ];      

        for ($i = 0; $i <= 18; $i++) 
        {          
            Author::create([
                'first_name' => $authorFirstName[$i],
                'last_name' => $authorLastName[$i],
                'biography' => $authorBiography[$i],
                'is_deleted' => 0
            ]);
        }  

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
            'password' => bcrypt('admin'),
            'is_deleted' => 0,
        ]);
        User::create([
            'role_id' => 2,
            'user_name' => 'user',
            'name' => 'user',
            'email' => 'user@coolbooks.se',
            'phone' => '666-666-666',
            'password' => bcrypt('user'),
            'is_deleted' => 0,
        ]);
        User::create([
            'role_id' => 3,
            'user_name' => 'moderator',
            'name' => 'moderator',
            'email' => 'moderator@coolbooks.se',
            'phone' => '777-7777-777',
            'password' => bcrypt('moderator'),
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

        $bookDescription = [
            "In ancient times the Rings of Power were crafted by the Elven-smiths, and Sauron, the Dark Lord, forged the One Ring, filling it with his own power so that he could rule all others. But the One Ring was taken from him, and though he sought it throughout Middle-earth, it remained lost to him. After many ages it fell by chance into the hands of the hobbit Bilbo Baggins.
            From Sauron's fastness in the Dark Tower of Mordor, his power spread far and wide. Sauron gathered all the Great Rings to him, but always he searched for the One Ring that would complete his dominion.            
            When Bilbo reached his eleventy-first birthday he disappeared, bequeathing to his young cousin Frodo the Ruling Ring and a perilous quest: to journey across Middle-earth, deep into the shadow of the Dark Lord, and destroy the Ring by casting it into the Cracks of Doom.            
            The Lord of the Rings tells of the great quest undertaken by Frodo and the Fellowship of the Ring: Gandalf the Wizard; the hobbits Merry, Pippin, and Sam; Gimli the Dwarf; Legolas the Elf; Boromir of Gondor; and a tall, mysterious stranger called Strider.",

            "Andrew -Ender- Wiggin thinks he is playing computer simulated war games; he is, in fact, engaged in something far more desperate. The result of genetic experimentation, Ender may be the military genius Earth desperately needs in a war against an alien enemy seeking to destroy all human life. The only way to find out is to throw Ender into ever harsher training, to chip away and find the diamond inside, or destroy him utterly. Ender Wiggin is six years old when it begins. He will grow up fast.

            But Ender is not the only result of the experiment. The war with the Buggers has been raging for a hundred years, and the quest for the perfect general has been underway almost as long. Ender's two older siblings, Peter and Valentine, are every bit as unusual as he is, but in very different ways. While Peter was too uncontrollably violent, Valentine very nearly lacks the capability for violence altogether. Neither was found suitable for the military's purpose. But they are driven by their jealousy of Ender, and by their inbred drive for power. Peter seeks to control the political process, to become a ruler. Valentine's abilities turn more toward the subtle control of the beliefs of commoner and elite alike, through powerfully convincing essays. Hiding their youth and identities behind the anonymity of the computer networks, these two begin working together to shape the destiny of Earth-an Earth that has no future at all if their brother Ender fails.",

            "Billy Chapel is a baseball legend, a man who has devoted his life to the game he loves and plays so well. But because of his unsurpassed skill and innocent faith, he has been betrayed. Now it's the final game of the season, and Billy's got one last chance to prove who he is and what he can do, a chance to prove what really matters in this life. A taut, compelling story of one man's coming of age, FOR LOVE OF THE GAME is Michael Shaara's final novel, the classic finish to a brilliantly distinguished literary career.",

            "From the instant New York Times bestselling author of blockbuster thrillers In a Dark, Dark Wood and The Woman in Cabin 10 comes Ruth Ware’s chilling new novel.

            On a cool June morning, a woman is walking her dog in the idyllic coastal village of Salten along a tidal estuary known as the Reach. Before she can stop him, the dog charges into the water to retrieve what first appears to be a wayward stick, but to her horror, turns out to be something much more sinister...
            
            The next morning, three women in and around London—Fatima, Thea, and Isabel—receive the text they had always hoped would NEVER come, from the fourth in their formerly inseparable clique, Kate, that says only, “I need you.”
            
            The four girls were best friends at Salten, a second rate boarding school set near the cliffs of the English Channel. Each different in their own way, the four became inseparable and were notorious for playing the Lying Game, telling lies at every turn to both fellow boarders and faculty, with varying states of serious and flippant nature that were disturbing enough to ensure that everyone steered clear of them. The myriad and complicated rules of the game are strict: no lying to each other—ever. Bail on the lie when it becomes clear it is about to be found out. But their little game had consequences, and the girls were all expelled in their final year of school under mysterious circumstances surrounding the death of the school’s eccentric art teacher, Ambrose (who also happens to be Kate’s father).",

            "Return to New York City and Minneapolis in 1988, at the peak of the AIDS crisis, in this stunning novel of relationships and surviving heartbreaking loss. Published on the 40th anniversary of the disease's first reported cases, this story is both a tribute to a generation lost to the pandemic as well as a powerful exploration of heartbreak, recovery, and how love can defy grief.

            Two years after his partner, Francesco, died, twenty-eight-year-old Kevin Doyle is dusting off his one good suit jacket for yet another funeral, yet another loss in their close-knit group. They had all been young, beautiful, and living the best days of their lives, though they didn’t know it. That was before New York City began to feel like a war zone, its horrors somehow invisible, and ignored by the rest of the world.
            
            Some people might insist that Francesco is in a better place now, but Kevin definitely isn’t. He spends his days in a mind-numbing job and his evenings drunk in Francesco’s old apartment, surrounded by memories. Francesco made everything look easy, and without him, Kevin struggles to keep going. And then one night, he stops trying. When Kevin awakens in a hospital, he knows it’s time to move back home to Minnesota and figure out how to start living again—without Francesco.
            
            With the help of a surviving partners support group and old and new friends, Kevin slowly starts to do just that. But an unthinkable family betrayal, and the news that his best friend is fighting for his life in New York, will force a reckoning and a defining choice.
            
            Drawing on his experience as part of the AIDS generation, Brian Malloy brings authenticity, insight, sensitivity, and humor to a story that is distinct yet universal in its powerful exploration of heartbreak and recovery, and the ways in which love can defy grief.",

            "A little book with a big heart!

            From the New York Times bestselling author of A Man Called Ove, My Grandmother Asked Me to Tell You She’s Sorry, and Britt-Marie Was Here comes an exquisitely moving portrait of an elderly man’s struggle to hold on to his most precious memories, and his family’s efforts to care for him even as they must find a way to let go.
            
            With all the same charm of his bestselling full-length novels, here Fredrik Backman once again reveals his unrivaled understanding of human nature and deep compassion for people in difficult circumstances. This is a tiny gem with a message you’ll treasure for a lifetime.",

            "The New York Times bestselling series that inspired the international hit video game: The Witcher.
            For over a century, humans, dwarves, gnomes, and elves have lived together in relative peace. But times have changed, the uneasy peace is over, and now the races are fighting once again. The only good elf, it seems, is a dead elf.
            
            Geralt of Rivia, the cunning assassin known as The Witcher, has been waiting for the birth of a prophesied child. This child has the power to change the world - for good, or for evil.
            
            As the threat of war hangs over the land and the child is hunted for her extraordinary powers, it will become Geralt's responsibility to protect them all - and the Witcher never accepts defeat.
            
            The Witcher returns in this sequel to The Last Wish, as the inhabitants of his world become embroiled in a state of total war.",

            "What were the Great Old Ones like before they were old?

            In the shadow of cosmic horrors, newly-birthed entity Zogrusz must come to understand his true nature, learn how to wield his dreadful powers, and search for meaning in the mad spaces between the stars. Hopefully, he’ll make some friends along the way.
            
            Also, there’s a cat.
            
            A Lovecraftian cozy fantasy.",

            "On a world supported on the back of a giant turtle (sex unknown), a gleeful, explosive, wickedly eccentric expedition sets out. There's an avaricious but inept wizard, a naive tourist whose luggage moves on hundreds of dear little legs, dragons who only exist if you believe in them, and of course THE EDGE on the planet.",

            "When Jonathan Harker visits Transylvania to help Count Dracula with the purchase of a London house, he makes a series of horrific discoveries about his client. Soon afterwards, various bizarre incidents unfold in England: an apparently unmanned ship is wrecked off the coast of Whitby; a young woman discovers strange puncture marks on her neck; and the inmate of a lunatic asylum raves about the 'Master' and his imminent arrival.

            In Dracula, Bram Stoker created one of the great masterpieces of the horror genre, brilliantly evoking a nightmare world of vampires and vampire hunters and also illuminating the dark corners of Victorian sexuality and desire.",

            "Legendary storyteller Stephen King goes deep into the well of his imagination in this spellbinding novel about a seventeen-year-old boy who inherits the keys to a parallel world where good and evil are at war, and the stakes could not be higher—for their world or ours.

            Charlie Reade looks like a regular high school kid, great at baseball and football, a decent student. But he carries a heavy load. His mom was killed in a hit-and-run accident when he was ten, and grief drove his dad to drink. Charlie learned how to take care of himself—and his dad. Then, when Charlie is seventeen, he meets Howard Bowditch, a recluse with a big dog in a big house at the top of a big hill. In the backyard is a locked shed from which strange sounds emerge, as if some creature is trying to escape. When Mr. Bowditch dies, he leaves Charlie the house, a massive amount of gold, a cassette tape telling a story that is impossible to believe, and a responsibility far too massive for a boy to shoulder.
            
            Because within the shed is a portal to another world—one whose denizens are in peril and whose monstrous leaders may destroy their own world, and ours. In this parallel universe, where two moons race across the sky, and the grand towers of a sprawling palace pierce the clouds, there are exiled princesses and princes who suffer horrific punishments; there are dungeons; there are games in which men and women must fight each other to the death for the amusement of the “Fair One.” And there is a magic sundial that can turn back time.
            
            A story as old as myth, and as startling and iconic as the rest of King’s work, Fairy Tale is about an ordinary guy forced into the hero’s role by circumstance, and it is both spectacularly suspenseful and satisfying.",

            "A true classic with a timeless message, The Story of Ferdinand has enchanted readers since it was first published in 1936. All the other bulls would run and jump and butt their heads together. But Ferdinand would rather sit and smell the flowers. So what will happen when our pacifist hero is picked for the bullfights in Madrid?",

            "Harry Potter thinks he is an ordinary boy - until he is rescued by an owl, taken to Hogwarts School of Witchcraft and Wizardry, learns to play Quidditch and does battle in a deadly duel. The Reason ... HARRY POTTER IS A WIZARD!",

            "Could you survive on your own in the wild, with every one out to make sure you don't live to see the morning?

            In the ruins of a place once known as North America lies the nation of Panem, a shining Capitol surrounded by twelve outlying districts. The Capitol is harsh and cruel and keeps the districts in line by forcing them all to send one boy and one girl between the ages of twelve and eighteen to participate in the annual Hunger Games, a fight to the death on live TV.
            
            Sixteen-year-old Katniss Everdeen, who lives alone with her mother and younger sister, regards it as a death sentence when she steps forward to take her sister's place in the Games. But Katniss has been close to dead before—and survival, for her, is second nature. Without really meaning to, she becomes a contender. But if she is to win, she will have to start making choices that weight survival against humanity and life against love.",

            "About three things I was absolutely positive.

            First, Edward was a vampire.
            
            Second, there was a part of him—and I didn't know how dominant that part might be—that thirsted for my blood.
            
            And third, I was unconditionally and irrevocably in love with him.
            
            Deeply seductive and extraordinarily suspenseful, Twilight is a love story with bite.",

            "The Great Gatsby, F. Scott Fitzgerald's third book, stands as the supreme achievement of his career. This exemplary novel of the Jazz Age has been acclaimed by generations of readers. The story of the fabulously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan, of lavish parties on Long Island at a time when The New York Times noted: gin was the national drink and sex the national obsession, it is an exquisitely crafted tale of America in the 1920s.

            The Great Gatsby is one of the great classics of twentieth-century literature.",

            "Discovered in the attic in which she spent the last years of her life, Anne Frank’s remarkable diary has become a world classic—a powerful reminder of the horrors of war and an eloquent testament to the human spirit.",

            "In a hole in the ground there lived a hobbit. Not a nasty, dirty, wet hole, filled with the ends of worms and an oozy smell, nor yet a dry, bare, sandy hole with nothing in it to sit down on or to eat: it was a hobbit-hole, and that means comfort.
            Written for J.R.R. Tolkien’s own children, The Hobbit met with instant critical acclaim when it was first published in 1937. Now recognized as a timeless classic, this introduction to the hobbit Bilbo Baggins, the wizard Gandalf, Gollum, and the spectacular world of Middle-earth recounts of the adventures of a reluctant hero, a powerful and dangerous ring, and the cruel dragon Smaug the Magnificent.",

            "At the dawn of the next world war, a plane crashes on an uncharted island, stranding a group of schoolboys. At first, with no adult supervision, their freedom is something to celebrate; this far from civilization the boys can do anything they want. Anything. They attempt to forge their own society, failing, however, in the face of terror, sin and evil. And as order collapses, as strange howls echo in the night, as terror begins its reign, the hope of adventure seems as far from reality as the hope of being rescued. Labeled a parable, an allegory, a myth, a morality tale, a parody, a political treatise, even a vision of the apocalypse, Lord of the Flies is perhaps our most memorable novel about “the end of innocence, the darkness of man’s heart.”",

            "Terror stalks the night…

            An old woman’s obsession with youth leads her to purchase a cursed appliance from a sinister antique shop. A new homeowner discovers her property comes with a deadly addition. And dark forces stalk a troop of innocent boy scouts when they spend the night on a haunted aircraft carrier…
            
            Scare Street delves into the darkness to bring you a new collection of spine-tingling terror. This diabolical tome is bursting with thirteen sinister stories of supernatural horror, featuring ghastly ghosts, cold-blooded killers, and fiendish visions torn from your worst fears.
            
            Just be careful you don’t lose track of time as you meander through this shadowy landscape of dreams and nightmares. Because once the sun sets, something waits for you in the darkness of night.
            
            And if it finds you, you may never see daylight again"            
        ];

        $covers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        $genre = [1, 9, 10, 6, 11, 12, 1, 1, 1, 3, 3, 13, 1, 7, 4, 12, 14, 5, 12, 3];

        $tags = ['Animals', 'Classics', 'Funnny', 'Future', 'Love', 'Manga', 'Murder', 'Religious', 'Scary', 'True Story'];

        for ($i = 0; $i <= 19; $i++) {
            $random_tags = array_rand($tags, 2);
            
            $faker = Factory::create();

            $user_id = random_int(1, 2);

            Book::create([
                'genre_id' => $genre[$i],
                'user_id' => $user_id,
                'title' => $title[$i],
                'image' => 'book_images/' . $covers[$i] . '.jpg',
                'ISBN' => $faker->regexify('[0-9]{3}-[0-9]{5}-[0-9]{3}-[0-9]{4}'),
                'tags' => $tags[$random_tags[0]] . ',' . $tags[$random_tags[1]],
                'description' => $bookDescription[$i],
                'is_deleted' => 0
            ]);
        }      

        //seed Authors
        for ($i = 1; $i <= 17; $i++) {            
            AuthorBook::create([
                'author_id' => $i,
                'book_id' => $i,
            ]);
        }
        AuthorBook::create([
            'author_id' => 1,
            'book_id' => 18
        ]);
        AuthorBook::create([
            'author_id' => 18,
            'book_id' => 19
        ]);
        AuthorBook::create([
            'author_id' => 19,
            'book_id' => 20
        ]);

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

        //Seed 100 reviews, comments and replies/subcomments for statistics, top lists and book page examples
        for ($i = 0; $i < 100; $i++) {
            Review::create([
                'book_id' => rand(1, 18),
                'user_id' => rand(1, 3),
                'headline' => 'Review #' . $i,
                'review_text' => 'Review text #' . $i,
                'rating' => rand(1, 5),
                'is_deleted' => 0,
                'created_at' => Carbon::now()->subDays(rand(2, 20))->format('Y-m-d H:i:s')
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            Comment::create([
                'review_id' => rand(1, 50),
                'user_id' => rand(1, 3),
                'comment' => 'Comment #' . $i,
                'is_flagged' => rand(0, 1),
                'is_deleted' => 0,
                'created_at' => Carbon::now()->subDays(rand(2, 20))->format('Y-m-d H:i:s')
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            Subcomment::create([
                'comment_id' => rand(1, 50),
                'user_id' => rand(1, 3),
                'subcomment' => 'Reply #' . $i,
                'is_flagged' => rand(0, 1),
                'is_deleted' => 0,
                'created_at' => Carbon::now()->subDays(rand(2, 20))->format('Y-m-d H:i:s')
            ]);
        }
    }
}
