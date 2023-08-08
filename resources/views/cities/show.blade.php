@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('cities.index') }}">Все города</a>
                <a class="btn btn-primary" href="{{ route('cities.edit', $city) }}">Редактировать</a>
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
            <th scope="row">Наименование</th>
            <td>{{ $city->name }}</td>
        </tr>
        <tr>
            <th scope="row">Филиалы</th>
            <td>
                @if(!empty($city->branches->all()))
                    @foreach($city->branches as $branch)
                        <span class="branch-list-item">- {{ $branch->name }}</span><br>
                    @endforeach
                @else
                    <span class="text-danger">Не указано</span>
                @endif
            </td>
        </tr>
        <tr>
            <th scope="row">Дата создания записи</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $city->updated_at)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Когда обновляли запись последний раз</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $city->updated_at)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Активен</th>
            <td>{{ is_null($city->deleted_at) ? 'Да' : 'Нет' }} </td>
        </tr>
        </tbody>
    </table>
@endsection
