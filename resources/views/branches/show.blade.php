@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('branches.index') }}">Вернуться</a>
                <a class="btn btn-primary" href="{{ route('branches.edit', $branch) }}">Редактировать</a>
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
            <th scope="row">Наименование филиала</th>
            <td>{{ $branch->name }}</td>
        </tr>
        <tr>
            <th scope="row">Адрес</th>
            <td>{{ $branch->address }}</td>
        </tr>
        <tr>
            <th scope="row">Дата открытия филиала</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $branch->opening_date)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Дата создания записи</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $branch->created_at)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Когда обновляли запись последний раз</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $branch->updated_at)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Активен</th>
            <td>{{ is_null($branch->deleted_at) ? 'Да' : 'Нет' }} </td>
        </tr>
        </tbody>
    </table>
@endsection
