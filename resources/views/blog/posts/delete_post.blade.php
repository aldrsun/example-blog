@if(Auth::check())
    @if($post->user_id == auth()->user()->id)
        <div class="col-lg-6">
            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger">{{__('delete-post')}}</button>
            </form>
        </div>
    @endif
@endif
