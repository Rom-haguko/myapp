@extends('layouts.app')

@section('title', 'Форма')

@section('content')
    <h1>Отправить данные</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('form.submit') }}" method="POST">
        @csrf

        <p>
            <label>Имя:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </p>

        <p>
            <label>Email:</label><br>
            <input type="text" name="email" value="{{ old('email') }}">
        </p>

        <p>
            <label>Сообщение:</label><br>
            <textarea name="message" rows="4" cols="40">{{ old('message') }}</textarea>
        </p>

        <p><button type="submit">Отправить</button></p>
    </form>
@endsection
