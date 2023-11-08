@extends('layouts.blog')

@section('content')

    <div class="row">
        <div class="card col-lg-8">
            <div class="card mb-4">
                <img class="card-img-top" src="{{ asset('images/'.$post->image_path) }}" alt="..."/>
                <div class="card-body">
                    <div>
                        <div class="small text-muted">{{__('created-at').": ".$post->created_at." | ".__('updated-at').": ".$post->updated_at }}</div>
                        <div class="small text-gray-800">
                            {{ __('categories').": " }}
                            @foreach($post->categories as $category)
                                @if($category->id != $post->categories->first()->id)
                                    {{ ' | ' }}
                                @endif
                                {{$category->name}}
                            @endforeach
                        </div>
                        <div class="small">
                            {{ $post->user->name }}
                        </div>
                        <div style="float:right">
                            <a class="btn btn-primary" href="{{ route('post.index') }}">{{__('go-back')}}</a>
                            @include('blog.posts.delete_post')
                        </div>
                    </div>
                    <h2 class="card-title">{{ $post->title}}</h2>
                    <p class="card-text">{{$post->content}}</p>
                </div>
            </div>

            <hr>
            <!-- Comment Section-->
            @include('blog.comment_section')
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            @include('blog/side_widget')
        </div>
    </div>

@endsection
