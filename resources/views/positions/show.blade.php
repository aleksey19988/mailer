@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр должности</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('positions.index') }}">Вернуться</a>
                <a class="btn btn-primary" href="{{ route('positions.edit', $position) }}">Редактировать</a>
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
            <th scope="row">Наименование отдела</th>
            <td>{{ $position->name }}</td>
        </tr>
        <tr>
            <th scope="row">Адрес электронной почты отдела</th>
            <td>{{ is_null($position->email) ? 'Не указана' : $position->email }}</td>
        </tr>
        <tr>
            <th scope="row">Дата создания записи</th>
            <td>{{ $position->created_at }}</td>
        </tr>
        <tr>
            <th scope="row">Когда обновляли запись последний раз</th>
            <td>{{ $position->updated_at }}</td>
        </tr>
        <tr>
            <th scope="row">Активен</th>
            <td>{{ is_null($position->deleted_at) ? 'Да' : 'Нет' }} </td>
        </tr>
        </tbody>
    </table>
@endsection
