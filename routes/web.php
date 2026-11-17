<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/form', [PageController::class, 'form'])->name('form');
Route::post('/form', [PageController::class, 'submit'])->name('form.submit');
Route::get('/list', [PageController::class, 'list'])->name('list');

Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/posts/{id}/force', [PostController::class, 'forceDelete'])->name('posts.force');
Route::resource('posts', PostController::class);
Route::post('/posts/{post}/comments', [CommentController::class, 'storeForPost'])->name('posts.comments.store');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('/categories/{category}/comments', [CommentController::class, 'storeForCategory'])->name('categories.comments.store');
