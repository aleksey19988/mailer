@extends('layouts.app')
@section('content')
    <div class="list-group">
        <a href="{{ route('cities.index') }}" class="list-group-item list-group-item-action">Города</a>
        <a href="{{ route('branches.index') }}" class="list-group-item list-group-item-action">Филиалы</a>
        <a href="{{ route('holidays.index') }}" class="list-group-item list-group-item-action">Праздники</a>
        <a href="{{ route('departments.index') }}" class="list-group-item list-group-item-action">Отделы</a>
        <a href="{{ route('positions.index') }}" class="list-group-item list-group-item-action">Должности</a>
        <a href="{{ route('employees.index') }}" class="list-group-item list-group-item-action">Сотрудники</a>
    </div>
@endsection
