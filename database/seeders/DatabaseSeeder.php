<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(10)->create();

        $users_ids = User::orderBy('id', 'ASC')->pluck('id')->toArray();

        foreach ($users_ids as $user_id) {
            $random_posts_count = rand(0,10);
            for($j = 0; $j < $random_posts_count; $j ++) {
                Post::factory(1)->create([
                    'user_id' => $user_id,
                    'image_path' => 'default/default ('.rand(1,77).').jpg',
                ]);
                 // Will add record to postscategories
                $last_post_id = Post::orderBy('id', 'DESC')->first()->id; // last post id
                $category_id = rand(1, 10);
                PostCategory::create([
                    'post_id' => $last_post_id,
                    'category_id' => $category_id,
                    'user_id' => $user_id
                ]);
            }

            $random_comment_count = rand(0, 30);
            $last_post_id = Post::orderBy('id', 'DESC')->first()->id; // last post id
            for($i = 0; $i < $random_comment_count; $i++) {
                $random_post_id = rand(1, $last_post_id);
                Comment::create([
                    'content' => fake()->paragraph(rand(5,30)),
                    'user_id' => $user_id,
                    'post_id' => $random_post_id
                ]);
            }
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
