<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'tags'])->recent()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:5',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ], [
            'title.required' => 'Введите заголовок.',
            'title.min' => 'Заголовок минимум 3 символа.',
            'body.required' => 'Введите текст поста.',
            'body.min' => 'Текст минимум 5 символов.',
            'category_id.required' => 'Выберите категорию.',
            'category_id.exists' => 'Такой категории нет.',
        ]);

        $post = Post::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'category_id' => $data['category_id'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);
        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('posts.show', $post)->with('success', 'Пост создан!');
    }

    public function show(Post $post)
    {
        $post->load(['category', 'tags', 'comments']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:5',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ], [
            'title.required' => 'Введите заголовок.',
            'title.min' => 'Заголовок минимум 3 символа.',
            'body.required' => 'Введите текст поста.',
            'body.min' => 'Текст минимум 5 символов.',
            'category_id.required' => 'Выберите категорию.',
            'category_id.exists' => 'Такой категории нет.',
        ]);

        $post->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'category_id' => $data['category_id'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? ($post->published_at ?? now()) : null,
        ]);
        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('posts.show', $post)->with('success', 'Пост обновлён!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост перемещён в корзину (мягкое удаление).');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->with('category')->recent()->get();
        return view('posts.trashed', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.trashed')->with('success', 'Пост восстановлен!');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('posts.trashed')->with('success', 'Пост удалён навсегда!');
    }
}
