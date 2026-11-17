@extends('layouts.app')

@section('title', 'Новый пост')

@section('content')
    <h1>Новый пост</h1>
    @include('posts.form')
    <p><a href="{{ route('posts.index') }}">Назад к списку</a></p>
@endsection
