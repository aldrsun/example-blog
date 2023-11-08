<div class="row">

    <!-- All comments -->

    @foreach($post->comments as $comment)
        <div class="card col-lg-8 m-auto">
            @include('blog.comments.comment', [
                'comment' => $comment
            ])
        </div>
    @endforeach
    <!-- Write comment section -->
    @auth
        <div class="card-body">
            @include('blog.comments.create_comment')
        </div>
    @endauth
</div>
