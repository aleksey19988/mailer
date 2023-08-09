@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-3">
            <div class="list-group">
                <a href="{{ route('cities.index') }}" class="list-group-item list-group-item-action">Города</a>
                <a href="{{ route('positions.index') }}" class="list-group-item list-group-item-action">Должности</a>
                <a href="{{ route('departments.index') }}" class="list-group-item list-group-item-action">Отделы</a>
                <a href="{{ route('holidays.index') }}" class="list-group-item list-group-item-action">Праздники</a>
                <a href="{{ route('employees.index') }}" class="list-group-item list-group-item-action">Сотрудники</a>
                <a href="{{ route('branches.index') }}" class="list-group-item list-group-item-action">Филиалы</a>
            </div>
        </div>

        <div class="col-3">
            <div class="list-group">
                <a href="{{ route('api.index') }}" class="list-group-item list-group-item-action">Тестирование API ChatGPT</a>
                <a href="{{ route('email.index') }}" class="list-group-item list-group-item-action">Ручная отправка писем</a>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <h2>Сегодня {{ \Carbon\Carbon::today()->format('d.m.Y') }}</h2>
    </div>
    <div class="row">
        <h4>Именинники:</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Полное имя</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Поздравление отправлено</th>
            </tr>
            </thead>
            <tbody>
            @foreach($birthdayMen as $man)
                <tr>
                    <td>{{ $man->last_name }} {{ $man->first_name }} {{ $man->patronymic }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $man->birthday)->format('d.m.Y') }}</td>
                    <td>Otto</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
