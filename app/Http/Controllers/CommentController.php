<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storeForPost(Request $request, Post $post)
    {
        $data = $request->validate([
            'text' => 'required|string|min:2|max:1000',
        ], [
            'text.required' => 'Введите текст комментария.',
            'text.min' => 'Комментарий минимум 2 символа.',
        ]);

        $post->comments()->create($data);

        return back()->with('success', 'Комментарий добавлен!');
    }

    public function storeForCategory(Request $request, Category $category)
    {
        $data = $request->validate([
            'text' => 'required|string|min:2|max:1000',
        ], [
            'text.required' => 'Введите текст комментария.',
            'text.min' => 'Комментарий минимум 2 символа.',
        ]);

        $category->comments()->create($data);

        return back()->with('success', 'Комментарий добавлен!');
    }
}
