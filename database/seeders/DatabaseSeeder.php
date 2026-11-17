<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $news = Category::create(['name' => 'Новости']);
        $articles = Category::create(['name' => 'Статьи']);

        $php = Tag::create(['name' => 'PHP']);
        $laravel = Tag::create(['name' => 'Laravel']);
        $mysql = Tag::create(['name' => 'MySQL']);

        $post1 = Post::create([
            'category_id' => $news->id,
            'title' => 'Вышел Laravel 12',
            'body' => 'Новая версия фреймворка уже доступна.',
            'is_published' => true,
            'published_at' => now(),
        ]);
        $post1->tags()->attach([$php->id, $laravel->id]);

        $post2 = Post::create([
            'category_id' => $articles->id,
            'title' => 'Работа с Eloquent',
            'body' => 'Разбираем связи между моделями.',
            'is_published' => true,
            'published_at' => now(),
        ]);
        $post2->tags()->attach([$laravel->id, $mysql->id]);

        Post::create([
            'category_id' => $news->id,
            'title' => 'Черновик поста',
            'body' => 'Этот пост ещё не опубликован.',
            'is_published' => false,
        ]);

        $post1->comments()->create(['text' => 'Отличная новость!']);
        $post2->comments()->create(['text' => 'Полезная статья.']);
        $news->comments()->create(['text' => 'Комментарий к категории новостей.']);
    }
}
