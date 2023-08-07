@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->patronymic }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}">Вернуться</a>
                <a class="btn btn-primary" href="{{ route('employees.edit', $employee) }}">Редактировать</a>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Поле</th>
                <th scope="col">Значение</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>Фамилия</td>
            <td><span class="{{ !$employee->last_name ? 'text-danger' : ''}}">{{ $employee->last_name ?? 'Не указано' }}</span></td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><span class="{{ !$employee->first_name ? 'text-danger' : ''}}">{{ $employee->first_name ?? 'Не указано' }}</span></td>
        </tr>
        <tr>
            <td>Отчество</td>
            <td><span class="{{ !$employee->patronymic ? 'text-danger' : ''}}">{{ $employee->patronymic ?? 'Не указано' }}</span></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><span class="{{ !$employee->email ? 'text-danger' : ''}}">{{ $employee->email ?? 'Не указано' }}</span></td>
        </tr>
        <tr>
            <td>Дата рождения</td>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->birthday)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <td>Дата создания записи</td>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->updated_at)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <td>Когда обновляли запись последний раз</td>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->updated_at)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <td>Активен</td>
            <td>{{ is_null($employee->deleted_at) ? 'Да' : 'Нет' }} </td>
        </tr>
        </tbody>
    </table>
@endsection
