<div>
    <div style="float: right">
    {{$post->likes->count()}}
    </div>
    <div>
        @auth
            @php( $postLiked = $post->likes->contains('user_id', auth()->user()->id))
            <form class="like-form" action="{{route('post.like'.(($postLiked) ? '.destroy' : '.store'), [
                    'post' => $post->slug,
                    'like' => ($postLiked) ? $post->likes->where('user_id', auth()->user()->id)->first()->id : 0,
                    'post_id'   =>  $post->id,
                    'user_id'   =>  auth()->user()->id])}}" method="POST">
                @if($postLiked)
                    @method('DELETE')
                @endif
                @csrf
                <img class="heart-{{($postLiked) ? "filled" : "outline"}}-image" style="float: right; max-width: 14%; height: auto;"
                     src="{{asset('assets/heart-'.(($postLiked) ? 'filled' : 'outline').'.png')}}"
                     alt="{{__('like')}}"/>
            </form>
        @else
            <form class="like-form-unauth" action="{{route('login')}}" method="GET">
                @csrf
                    <img class="heart-outline-image-unauth" style="float: right; max-width: 14%; height: auto;"
                         src="{{asset('assets/heart-outline.png')}}"
                         alt="{{__('like')}}"/>
            </form>
        @endauth
    </div>
</div>
