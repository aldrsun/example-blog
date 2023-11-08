<?php

namespace App\Listeners;

use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;

use App\Event\PostCreated;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StorePost implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $requestData = $event->requestData;
        try {
            DB::beginTransaction();;
            // Save the post to the database
            $newPost = new Post ();
            $newPost->title = $requestData['title'];
            $newPost->description = $requestData['description'];
            $newPost->content = $requestData['content'];
            $newPost->slug = Str::slug($requestData['title'], '-');
            $newPost->image_path = $requestData['image_name'];
            $newPost->user_id = $requestData['user_id'];
            $newPost->save();
            $newPost->refresh();
            // If the category was not created yet, we will create. Otherwise, we will add this post to the related category.
            $category = Category::firstOrCreate([
                'name' => $requestData['category'],
                'slug' => Str::slug($requestData['category'], '-')]);
            $category->save();
            // We will add a record to posts_categories table.
            PostCategory::create([
                'post_id' => $newPost->id,
                'category_id' => $category->id,
                'user_id' => $requestData['user_id']
            ]);
            Notification::create([
                'user_id' => $requestData['user_id'],
                'content' => 'post with the title '.$newPost->title.' has been created successfully'
            ]);
            DB::commit();;
        } catch(\Illuminate\Database\QueryException $exception)  {
            DB::rollBack();
            $errorCode = $exception->errorInfo[1];
            if($errorCode == 1062) {
                Notification::create([
                    'user_id' => $requestData['user_id'],
                    'content' => $requestData['title'] . ' ' . __('is-already-exists')
                ]);
            } else {
                Notification::create([
                    'user_id' => $requestData['user_id'],
                    'content' => $exception->errorInfo[1]
                ]);
            }
        }
    }
}
