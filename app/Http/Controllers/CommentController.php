<?php

namespace App\Http\Controllers;

use App\Event\CommentCreated;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index($post_slug)
    {
        return redirect('/post/'.$post_slug);
    }

    public function store(Request $request, $post_slug) : RedirectResponse
    {
        $requestData = [
            'content' => $request['content'],
            'user_id' => auth()->user()->id,
            'post_slug' => $post_slug
        ];

        Event::dispatch(new CommentCreated($requestData));

        $string_data = '';
        foreach($requestData as $data)
        {
            $string_data = $string_data.$data;
        }
        return redirect('/post/'.$post_slug);
    }
    public function destroy($postId, $commentId) : RedirectResponse
    {
        $comment = Comment::where('id', $commentId)->first();
        $comment->delete();
        return redirect('/post/'.$postId);
    }
}
