<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Posts/Index', [
            'posts'=> PostResource::collection(Post::all())
        ]);
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Post::class)) {
            abort(403);
        }
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(CreatePostRequest $request)
    {
        if ($request->user()->cannot('create', Post::class)) {
            abort(403);
        }
        Post::create($request->validated());
        return to_route('posts.index');
    }

    public function show()
    {

    }

    public function edit(Post $post)
    {
        if ($request->user()->cannot('update', Post::class)) {
            abort(403);
        }
        return Inertia::render('Admin/Posts/Edit', [
            'post' => PostResource::make($post)
        ]);
    }

    public function update(CreatePostRequest $request, Post $post)
    {
        if ($request->user()->cannot('update', Post::class)) {
            abort(403);
        }
        $post->update($request->validated());
        return to_route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
