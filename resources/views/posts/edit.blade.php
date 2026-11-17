@extends('layouts.app')

@section('title', 'Редактирование')

@section('content')
    <h1>Редактирование поста</h1>
    @include('posts.form')
    <p><a href="{{ route('posts.show', $post) }}">Назад к посту</a></p>
@endsection
