<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Modules\Blog\Http\Requests\PostStoreRequest;
use Modules\Blog\Http\Requests\PostUpdateRequest;
use Modules\Blog\Models\Author;
use Modules\Blog\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('list_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog::posts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('create_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = Author::all();
        $categories = Category::whereHas('categoryType', function ($query) {
            $query->where('name', 'Blog');
        })->get();

        return view('blog::posts.create', compact('authors', 'categories'));
    }

    public function store(PostStoreRequest $request)
    {
        abort_if(Gate::denies('create_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post = Post::create([
            'author_id'    => $request->author_id,
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'slug'         => Str::slug($request->slug, '-') . Str::random(5),
            'content'      => $request->get('content'),
            'tags'         => $request->tags,
            'published_at' => $request->published_at,
        ]);

        storeMedia('posts', $post, $request->photo);

        session()->flash('success', __('blog::general.post_created_successfully'));

        return to_route('blog.posts.show', $post);
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('view_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog::posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('edit_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = Author::all();
        $categories = Category::whereHas('categoryType', function ($query) {
            $query->where('name', 'Blog');
        })->get();

        return view('blog::posts.edit', compact('post', 'authors', 'categories'));
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        abort_if(Gate::denies('edit_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->update([
            'author_id'    => $request->author_id,
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'slug'         => Str::slug($request->slug, '-') . Str::random(5),
            'content'      => $request->get('content'),
            'tags'         => $request->tags,
            'published_at' => $request->published_at,
        ]);

        storeMedia('posts', $post, $request->photo);

        session()->flash('success', __('blog::general.post_updated_successfully'));

        return to_route('blog.posts.show', $post);
    }

    public function upload()
    {
        try {
            $post = new Post();
            $post->id = 0;
            $post->exists = true;
            $image = $post->addMediaFromRequest('upload')->toMediaCollection('post-media');

            return response()->json([
                'uploaded' => true,
                'url'      => $image->getUrl('post-media')
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'uploaded' => false,
                    'error'    => [
                        'message' => $e->getMessage()
                    ]
                ]
            );
        }
    }

}
