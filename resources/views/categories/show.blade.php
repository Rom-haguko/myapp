@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <h1>Категория: {{ $category->name }}</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <h2>Опубликованные посты</h2>
    @forelse($posts as $post)
        <p><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></p>
    @empty
        <p>Постов нет.</p>
    @endforelse

    <h2>Комментарии к категории</h2>
    @forelse($category->comments as $comment)
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

    <form action="{{ route('categories.comments.store', $category) }}" method="POST">
        @csrf
        <p><textarea name="text" rows="3" cols="50">{{ old('text') }}</textarea></p>
        <p><button type="submit">Добавить комментарий</button></p>
    </form>

    <p><a href="{{ route('categories.index') }}">К категориям</a></p>
@endsection
