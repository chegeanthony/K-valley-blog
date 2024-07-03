<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone_number' => '1234567890',
                'bio' => 'A passionate writer with a love for technology.',
                'website' => 'https://johndoe.com',
                'social_media' => json_encode(['twitter' => '@johndoe', 'linkedin' => 'johndoe']),
                'profession' => 'Tech Blogger',
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone_number' => '0987654321',
                'bio' => 'Experienced journalist focusing on world affairs.',
                'website' => 'https://janesmith.com',
                'social_media' => json_encode(['twitter' => '@janesmith', 'instagram' => 'jane.smith']),
                'profession' => 'Journalist',
            ],
            [
                'id' => 3,
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'phone_number' => '1122334455',
                'bio' => 'Fiction writer with a penchant for mystery novels.',
                'website' => 'https://bobjohnson.com',
                'social_media' => json_encode(['facebook' => 'bobjohnsonwriter']),
                'profession' => 'Novelist',
            ],
        ];

        foreach ($authors as $author) {
            DB::table('authors')->insert($author);
        }
    }
}