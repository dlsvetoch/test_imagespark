<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'title'        => 'Sherlock Holmes',
                'author_id'    => 1,
            ],
            [
                'title'        => 'The Lost World',
                'author_id'    => 1,
            ],
            [
                'title'        => 'A Study in Scarlet',
                'author_id'    => 1,
            ],
            [
                'title'        => 'All Quiet on the Western Front',
                'author_id'    => 2,
            ],
            [
                'title'        => 'Three Comrades',
                'author_id'    => 2,
            ],
            [
                'title'        => 'Arch of Triumph: A Novel of a Man Without a Country',
                'author_id'    => 2,
            ],
            [
                'title'        => 'The Night in Lisbon',
                'author_id'    => 2,
            ],
            [
                'title'        => 'The Black Obelisk',
                'author_id'    => 2,
            ],
            [
                'title'        => 'A Time to Love and a Time to Die',
                'author_id'    => 2,
            ],
            [
                'title'        => 'Heaven Has No Favorites',
                'author_id'    => 2,
            ],
            [
                'title'        => 'Fight Club',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Survivor',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Invisible Monsters',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Choke',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Lullaby',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Diary',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Haunted',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Rant',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Snuff',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Pygmy',
                'author_id'    => 3,
            ],
            [
                'title'        => 'Flowers for Algernon',
                'author_id'    => 4,
            ],
            [
                'title'        => 'The Touch',
                'author_id'    => 4,
            ],
            [
                'title'        => 'The Fifth Sally',
                'author_id'    => 4,
            ],
            [
                'title'        => 'The Minds of Billy Milligan',
                'author_id'    => 4,
            ],
            [
                'title'        => 'Unveiling Claudia',
                'author_id'    => 4,
            ],
            [
                'title'        => 'Until Death',
                'author_id'    => 4,
            ],
            [
                'title'        => 'The Asylum Prophecies',
                'author_id'    => 4,
            ],
            [
                'title'        => 'Roughing It',
                'author_id'    => 5,
            ],
            [
                'title'        => 'The Gilded Age',
                'author_id'    => 5,
            ],
            [
                'title'        => 'The Adventures of Tom Sawyer',
                'author_id'    => 5,
            ],
            [
                'title'        => 'A Connecticut Yankee in King Arthur’s Court',
                'author_id'    => 5,
            ],
            [
                'title'        => 'The Tragedy Of Puddnhead Wilson and Those Extraordinary Twins',
                'author_id'    => 5,
            ],
            [
                'title'        => 'Following the Equator',
                'author_id'    => 5,
            ],
            [
                'title'        => 'The Mysterious Stranger',
                'author_id'    => 5,
            ],
            [
                'title'        => 'Eve\'s Diary',
                'author_id'    => 5,
            ],
            [
                'title'        => 'The Witcher',
                'author_id'    => 6,
            ],
            [
                'title'        => 'Sword of Destiny',
                'author_id'    => 6,
            ],
            [
                'title'        => 'The Last Wish',
                'author_id'    => 6,
            ],
            [
                'title'        => 'The Towers of Fools',
                'author_id'    => 6,
            ],
            [
                'title'        => 'The Hobbit, or There and Back Again',
                'author_id'    => 7,
            ],
            [
                'title'        => 'The Fellowship of the Ring',
                'author_id'    => 7,
            ],
            [
                'title'        => 'The Two Towers',
                'author_id'    => 7,
            ],
            [
                'title'        => 'The Return of the King',
                'author_id'    => 7,
            ],
            [
                'title'        => 'The Silmarillion',
                'author_id'    => 7,
            ],
            [
                'title'        => 'One Flew Over the Cuckoo\'s Nest',
                'author_id'    => 8,
            ],
            [
                'title'        => 'Sometimes a Great Notion : a novel',
                'author_id'    => 8,
            ],
            [
                'title'        => 'Kesey\'s Garage Sale',
                'author_id'    => 8,
            ],
            [
                'title'        => 'Demon Box. New York: Penguin Books',
                'author_id'    => 8,
            ],
            [
                'title'        => 'The Further Inquiry',
                'author_id'    => 8,
            ],
            [
                'title'        => 'Sailor Song',
                'author_id'    => 8,
            ],
            [
                'title'        => 'The Little Prince',
                'author_id'    => 9,
            ],
            [
                'title'        => 'Wind, Sand and Stars',
                'author_id'    => 9,
            ],
            [
                'title'        => 'Solaris',
                'author_id'    => 10,
            ],
            [
                'title'        => 'The Cyberiad: Stories',
                'author_id'    => 10,
            ],
            [
                'title'        => 'The Truth and Other Stories',
                'author_id'    => 10,
            ],
            [
                'title'        => 'The Invincible',
                'author_id'    => 10,
            ],
            [
                'title'        => 'Fiasco',
                'author_id'    => 10,
            ],
        ];

        foreach ($books as $key => $book) {
            $books[$key]['rating'] = round(rand(1, 4) + 1 / rand(1, 10), 1);
            $books[$key]['votes_amount'] = rand(50, 2000);
        }

        DB::table('books')->insert($books);
    }
}
