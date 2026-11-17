@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <h1>Категории</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Постов</th>
                <th>Комментариев</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->posts_count }}</td>
                    <td>{{ $category->comments_count }}</td>
                    <td><a href="{{ route('categories.show', $category) }}">Открыть</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
