<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

use App\Event\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class StoreComment implements ShouldQueue
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
    public function handle(CommentCreated $event): void
    {
        Log::info('Bu kisim calisti');
        $requestData = $event->requestData;
        $post_id = Post::where('slug', $requestData['post_slug'])->first()->id;
        Log::info('Seçili id: \''.$post_id.'\'');
        try {
            DB::beginTransaction();
                $newComment = new Comment();
                $newComment->content = $requestData['content'];
                $newComment->user_id = $requestData['user_id'];
                $newComment->post_id = $post_id;
                $newComment->save();

            DB::commit();
        } catch(QueryException $exception) {
            Log::error('HATA!!! : ', ['error_info' => $exception->errorInfo]);
            DB::rollBack();
        }
    }
}
