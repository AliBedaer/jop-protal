<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Post::class,50)->create()->each(function($post){
        	$post->tags()->attach([1,2,3]);
        });
    }
}
