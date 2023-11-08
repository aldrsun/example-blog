<div class="row">
    <!-- Featured Post -->
    @if($featured_post_id == $posts->first()->id)
        @include('blog.posts.featured_post', [
            'post' => $posts->first(),
        ])
    @endif

    <!-- Other Posts -->
    @foreach($posts as $post)
        @if($featured_post_id != $post->id)
            <div class="col-lg-6">
                @include('blog.posts.post', [
                    'post' => $post,
                    ])
            </div>
        @endif
    @endforeach
</div>
