@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр праздника</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('holidays.index') }}">Все праздники</a>
                <a class="btn btn-primary" href="{{ route('holidays.edit', $holiday) }}">Редактировать</a>
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
            <th scope="row">Наименование праздника</th>
            <td>{{ $holiday->name }}</td>
        </tr>
        <tr>
            <th scope="row">День и месяц празднования</th>
            <td>{{ is_null($holiday->date_of_celebration) ? 'Не указана' : \Carbon\Carbon::parse($holiday->date_of_celebration)->format('d.m') }}</td>
        </tr>
        <tr>
            <th scope="row">Дата создания записи</th>
            <td>{{ $holiday->created_at }}</td>
        </tr>
        <tr>
            <th scope="row">Когда обновляли запись последний раз</th>
            <td>{{ $holiday->updated_at }}</td>
        </tr>
        <tr>
            <th scope="row">Активен</th>
            <td>{{ is_null($holiday->deleted_at) ? 'Да' : 'Нет' }} </td>
        </tr>
        </tbody>
    </table>
@endsection
