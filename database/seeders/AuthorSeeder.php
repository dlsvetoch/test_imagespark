<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            [
                'name'         => 'Arthur Conan Doyle',
            ],
            [
                'name'         => 'Erich Maria Remarque',
            ],
            [
                'name'         => 'Chuck Palahniuk',
            ],
            [
                'name'         => 'Daniel Keyes',
            ],
            [
                'name'         => 'Mark Twain',
            ],
            [
                'name'         => 'Andrzej Sapkowski',
            ],
            [
                'name'         => 'John Ronald Reuel Tolkien',
            ],
            [
                'name'         => 'Ken Kesey',
            ],
            [
                'name'         => 'Antoine de Saint-Exupery',
            ],
            [
                'name'         => 'Stanislaw Lem',
            ],
        ];

        foreach ($authors as $key => $author) {
            $authors[$key]['rating'] = round(rand(1, 4) + 1 / rand(1, 10), 1);
            $authors[$key]['votes_amount'] = rand(50, 2000);
        }

        DB::table('authors')->insert($authors);
    }
}
