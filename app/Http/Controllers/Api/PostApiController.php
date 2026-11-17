<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::published()->recent()->with(['category', 'tags'])->get();
        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        $post->load(['category', 'tags', 'comments']);
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:5',
            'is_published' => 'boolean',
        ]);

        $data['published_at'] = ($data['is_published'] ?? false) ? now() : null;

        $post = Post::create($data);

        return (new PostResource($post))->response()->setStatusCode(201);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'title' => 'sometimes|string|min:3|max:255',
            'body' => 'sometimes|string|min:5',
            'is_published' => 'sometimes|boolean',
        ]);

        $post->update($data);

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Пост мягко удалён']);
    }
}
