<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Models\Author;

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
                'name'      => 'Sanjay Matilda',
                'email'     => 'sanjay.matilda@gmail.com',
                'bio'       => 'I am a great author!',
                'facebook'  => 'http://www.facebook.com/sanjay.matilda',
                'instagram' => 'http://www.instagram.com/sanjay.matilda',
                'twitter'   => 'http://www.twitter.com/sanjay.matilda',
            ],
            [
                'name'      => 'Iolyn Mladen',
                'email'     => 'iolyn.mladen@gmail.com',
                'bio'       => 'I am a great author!',
                'facebook'  => 'http://www.facebook.com/iolyn.mladen',
                'instagram' => 'http://www.instagram.com/iolyn.mladen',
                'twitter'   => 'http://www.twitter.com/iolyn.mladen',
            ],
            [
                'name'      => 'Charikleia Raginhild',
                'email'     => 'charikleia.raginhild@gmail.com',
                'bio'       => 'I am a great author!',
                'facebook'  => 'http://www.facebook.com/charikleia.raginhild',
                'instagram' => 'http://www.instagram.com/charikleia.raginhild',
                'twitter'   => 'http://www.twitter.com/charikleia.raginhild',
            ],
        ];

        Author::insert($authors);
    }
}
