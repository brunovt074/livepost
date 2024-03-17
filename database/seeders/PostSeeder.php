<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;     
    /**
     * Run the database seeds.
     * - Laravel offers us factory helper functions like has() and for() to quickly generate
     * relations for our models
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('posts');

        $posts = Post::factory(3)
        //->has(Comment::factory(3),'comments')//creates comments for this post
        ->untitled()
        ->create();
        //Assign a random user to each post with sync method (ManyToMany relationship)
        $posts->each(function (Post $post){
            $post->users()->sync([FactoryHelper::getRandomModelId(User::class)]);
        });

        $this->enableForeignKeys();
    }
}
