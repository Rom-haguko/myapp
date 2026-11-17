@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина (мягко удалённые)</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('posts.index') }}">К списку</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Удалён</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->deleted_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">Восстановить</button>
                        </form>
                        <form action="{{ route('posts.force', $post->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить навсегда</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Корзина пуста.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
