<?php

namespace App\Listeners;

use App\Event\PostLikeCreated;
use App\Models\PostLike;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StorePostLike implements ShouldQueue
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
    public function handle(PostLikeCreated $event): void
    {
        $postId = $event->postId;
        $userId = $event->userId;

        PostLike::create([
            'post_id' => $postId,
            'user_id' => $userId
        ]);
    }
}
