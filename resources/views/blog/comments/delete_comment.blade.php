@if(Auth::check())
    @if($comment->user_id == auth()->user()->id)
        <div class="col-lg-6">
            <form action="{{ route('post.comment.destroy', ['post' => $post->slug, 'comment'  => $comment->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger">{{__('delete-comment')}}</button>
            </form>
        </div>
    @endif
@endif
