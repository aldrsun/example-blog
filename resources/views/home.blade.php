@extends('layouts.blog')

@section('notifications')
    @include('blog.notifications')
@endsection

@section('content')

    @auth
        <div>
            <a class="btn btn-primary" href="{{ route('post.create') }}">{{__('create-a-new-post')}}</a>
        </div>
    @endauth
    @if(!$posts->isEmpty())
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Posts -->
                @include('blog.posts.posts')

                <!-- Pagination-->
                {{$posts->links('vendor.pagination.default', [
                    'category_slugs' => $category_slugs
                    ])}}
            </div>


            <!-- Side widgets-->
            <div class="col-lg-4">
                @include('blog/side_widget')
            </div>
        </div>

    @else
        <h1 style="color:red;">Posts did not load, or there is no posts with this category.</h1>
    @endif
@endsection
