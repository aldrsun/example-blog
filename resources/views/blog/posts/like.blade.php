

<div>
    <div style="float: right">
    {{$post->likes->count()}}
    </div>
    <div>
        @auth
            @if($post->likes->contains('user', auth()->user()))
                <form class="like-form" action="{{route('post.like.destroy', [
                        'post' => $post->slug,
                        'like' => $post->likes->where('user_id', auth()->user()->id)->first()->id
                        ])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <img class="heart-filled-image" style="float: right; max-width: 14%; height: auto;"
                         src="{{asset('assets/heart-filled.png')}}"
                         alt="{{__('like')}}"/>
                </form>
            @else
                <form class="like-form" action="{{route('post.like.store', [
                    'post'      =>  $post->slug,
                    'post_id'   =>  $post->id,
                    'user_id'   =>  auth()->user()->id])}}" method="POST">
                    @csrf
                    <img class="heart-outline-image" style="float: right; max-width: 14%; height: auto;"
                         src="{{asset('assets/heart-outline.png')}}"
                         alt="{{__('like')}}"/>
                </form>
            @endif
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
