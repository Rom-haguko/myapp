@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <p><b>Категория:</b> <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></p>
    <p><b>Теги:</b> {{ $post->tags->pluck('name')->join(', ') ?: 'нет' }}</p>
    <p><b>Статус:</b> {{ $post->is_published ? 'Опубликован' : 'Черновик' }}</p>
    <p><b>Дата публикации:</b> {{ $post->published_at?->format('d.m.Y H:i') ?? '—' }}</p>
    <p>{{ $post->body }}</p>

    <h2>Комментарии ({{ $post->comments->count() }})</h2>
    @forelse($post->comments as $comment)
        <p>— {{ $comment->text }} <small>({{ $comment->created_at->format('d.m.Y H:i') }})</small></p>
    @empty
        <p>Комментариев нет.</p>
    @endforelse

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.comments.store', $post) }}" method="POST">
        @csrf
        <p><textarea name="text" rows="3" cols="50">{{ old('text') }}</textarea></p>
        <p><button type="submit">Добавить комментарий</button></p>
    </form>

    <p>
        <a href="{{ route('posts.edit', $post) }}">Редактировать</a> |
        <a href="{{ route('posts.index') }}">К списку</a>
    </p>

    <form action="{{ route('posts.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить (в корзину)</button>
    </form>
@endsection
