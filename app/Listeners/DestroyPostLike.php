<?php

namespace App\Listeners;

use App\Models\PostLike;
use App\Event\PostLikeDestroyed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DestroyPostLike implements ShouldQueue
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
    public function handle(PostLikeDestroyed $event): void
    {
        $likeId = $event->likeId;
        $like = PostLike::where('id', $likeId);
        $like->delete();
    }
}
