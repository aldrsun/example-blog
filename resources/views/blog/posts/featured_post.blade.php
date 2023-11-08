<div class="card mb-4">
    <a href="#!"><img class="card-img-top" src="{{ 'images/'.$post->image_path }}" alt="..."/></a>
    <div class="card-body">
        <div class="small text-muted">{{$post->updated_at}}
            @foreach($post->categories as $category)
                -
                {{ $category->name }}
            @endforeach
        </div>
        <div class="small">
            {{ $post->user->name }}
        </div>

        <div class="row">
            <h2 class="card-title h4">{{ $post->title}}</h2>
            <p class="card-text">{{$post->description}}</p>
        </div>

        <div class = "row">
            <div class="col-lg-6">
                <a class="btn btn-primary"
                   href="post/{{$post->slug}}">{{__('read-more')}}</a>
            </div>
            @include('blog.posts.delete_post')
        </div>
    </div>
</div>
