<style>
    textarea {
        width: 100%;
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }
</style>

<div class="card-body">
    <div>
        <form method="POST" action="{{ route('post.comment.store', ['post' => $post->slug])}}">
            @csrf
            <textarea name='content' aria-label="" placeholder="{{__('create-comment')}}"></textarea>
         <input type="submit" value="{{__('submit')}}">
        </form>
    </div>
</div>
