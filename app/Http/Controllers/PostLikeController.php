<?php

namespace App\Http\Controllers;

use App\Event\PostLikeCreated;
use App\Event\PostLikeDestroyed;
use App\Models\PostLike;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class PostLikeController extends Controller
{
    public function store(Request $request, $postSlug) : RedirectResponse
    {
        Event::dispatch(new PostLikeCreated([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id
        ]));
        return back();
    }

    public function destroy(Request $request) : RedirectResponse
    {
        Event::dispatch(new PostLikeDestroyed(['like_id' => $request->like]));
        return back();
    }
}
