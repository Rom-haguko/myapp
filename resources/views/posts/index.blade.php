@extends('layouts.app')

@section('title', 'Посты')

@section('content')
    <h1>Посты</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('posts.create') }}">Создать пост</a> |
        <a href="{{ route('posts.trashed') }}">Корзина</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Категория</th>
                <th>Теги</th>
                <th>Опубликован</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->tags->pluck('name')->join(', ') }}</td>
                    <td>{{ $post->is_published ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post) }}">Просмотр</a>
                        <a href="{{ route('posts.edit', $post) }}">Ред.</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Постов нет.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
