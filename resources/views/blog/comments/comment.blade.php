<div class="small text-muted">
    {{$comment->updated_at}}
</div>
<div class="small">
    {{ $comment->user->name }}
</div>
<div>
    <p>
        {{ $comment->content }}
    </p>
</div>
<div class = "row">
    @include('blog.comments.delete_comment')
</div>
