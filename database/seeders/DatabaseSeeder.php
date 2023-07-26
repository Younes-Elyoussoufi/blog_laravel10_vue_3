<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            CategorySeeder::class,
      
         ]);
         $users=User::factory(50)->create();
        
         $posts=Post::factory(100)->make()->each(function($post) use($users){
            $post->user_id= $users->random()->id;
            $post->save();
        });
       Comment::factory(200)->make()->each(function($comment) use($posts,$users){
            $comment->post_id= $posts->random()->id;
            $comment->user_id= $users->random()->id;
            $comment->save();
        });
       

        
    }
}
