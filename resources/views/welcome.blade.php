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
@endsection
