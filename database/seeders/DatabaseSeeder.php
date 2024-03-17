<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * - Seed the application's database.
     * - Seeding is referred to populating the database with dummy data.
     * - We put the main seeding logic in the classes called Seeder.
     * - We can use the db:seed Artisan command to trigger the seeders.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
