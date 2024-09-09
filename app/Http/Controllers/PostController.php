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

    public function create()
    {
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(CreatePostRequest $request)
    {
        Post::create($request->validated());
        return to_route('posts.index');
    }

    public function show()
    {

    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post' => PostResource::make($post)
        ]);
    }

    public function update(CreatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return to_route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
