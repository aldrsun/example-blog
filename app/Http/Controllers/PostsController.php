<?php

namespace App\Http\Controllers;

use App\Event\PostCreated;
use App\Jobs\PostCreateJob;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PostCategory;
use App\Models\Post;
use Dotenv\Parser\Value;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\isEmpty;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'listWithCategory']]);
    }

    public function customPaginate($allPosts) {
        $perPage = 5; // Number of posts for the first page
        $page = request()->get('page') ?: 1; // Get the current page number

        // Determine the number of posts for subsequent pages
        $postsPerPage = ($page == 1) ? $perPage : 6;

        /* Since it thinks there are 6 pages for every previous page, when we are not at page 1
            we must subtract 1 if page != 1, i.e. we must add -($page!=1) */
        $posts = $allPosts->slice(($page - 1) * $postsPerPage - ($page!=1) )->take($postsPerPage);

        /* If we say perPage = 5 when we are on the first page, it thinks every page has 5 posts and it
        calculates number of total pages incorrectly.
        So we say perPage = 6 and add the missing post. */
        $paginator = new LengthAwarePaginator($posts, $allPosts->count() + 1, 6, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return $paginator;
    }
    public function listWithCategory($category_slugs): Collection // This will filter posts by a category and list with dec. order according to the updated_at
    {
        if($category_slugs)
        {
            $categories = Category::whereIn('slug', $category_slugs)->get();
            $postIds = $categories->flatMap(function ($category) {
                return $category->posts->pluck('id');
            });
            $posts = Post::whereIn('id', $postIds)->orderBy('updated_at', 'DESC')->get();
            if(!$posts->isEmpty()) {
                return $posts;
            }
        }
        return Post::orderBy('updated_at', 'DESC')->get();
    }

    public function index(Request $request): View // This will list the posts with dec. order according to the updated_at
    {
        //HOW?
        //App:setlLocale('tr'); //??

        $category_slugs = $request->input('category_slugs');
        $posts = $this->listWithCategory($category_slugs);

        $paginator = $this->customPaginate($posts);

        $categories = Category::withCount('postCategory')->orderByDesc('post_category_count')->get();

        return view('home')->with([
            'category_slugs'    =>  $category_slugs,        // For page links
            'featured_post_id'  =>  $posts->isEmpty() ? 0 : $posts->first()->id, // For home page to know which post is the first.
            'posts'             =>  $paginator,             // Main content...
            'all_categories'    =>  $categories         // For side widgets
        ]);
    }

    public function create(): View
    {
        return view('blog.posts.create_post');
    }

    public function store(Request $request) : RedirectResponse
    {
        $slug_title = Str::slug($request->title);
        // Check if the form has filled correctly
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5124'
        ]);
        // Create a new image name
        $newImageName = uniqid() . '-' . $slug_title . '.' . $request->image->extension();

        // Save image
        $request->image->move(public_path('images'), $newImageName);

        $requestData = [
            'title' => $request->input('title'),
            'image_name' => $newImageName,
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'category' => $request->input('category'),
            'user_id' => auth()->user()->id
        ];


        Event::dispatch(new PostCreated($requestData));
        //dispatch(new PostCreateJob($requestData, auth()->user()))->delay(now()->addSeconds(20)); // Passing only the necessary data

        return redirect('/post');
    }

    public function show($title_slug) : View
    {
        $post = Post::where('slug', $title_slug)->first();

        $categories = Category::withCount('postCategory')->orderByDesc('post_category_count')->get();

        $comments = Comment::where('post_id', $post->id)->orderBy('created_at')->get();

        return view('blog.show_posts')->with([
            'post'              =>      $post,
            'all_categories'    =>      $categories, // For side widget
            'comments' => $comments
        ]);
    }

    public function destroy($postId) : RedirectResponse
    {
        $post = Post::where('id', $postId)->first();
        $post->categories()->detach();
        $post->delete();
        return redirect('/post');
    }

}
