<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeed::class,
            BlogSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
