@extends('layouts.app')

@section('title', 'Список данных')

@section('content')
    <h1>Все сохранённые данные</h1>

    @if(count($items) > 0)
        <table>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Сообщение</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item['name'] ?? '' }}</td>
                        <td>{{ $item['email'] ?? '' }}</td>
                        <td>{{ $item['message'] ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Пока нет данных.</p>
    @endif
@endsection
