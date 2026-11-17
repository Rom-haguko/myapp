<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['posts', 'comments'])->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('comments');
        $posts = $category->posts()->published()->recent()->get();
        return view('categories.show', compact('category', 'posts'));
    }
}
