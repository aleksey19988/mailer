@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('cities.index') }}">Вернуться</a>
                <a class="btn btn-primary" href="{{ route('cities.edit', $city) }}">Редактировать</a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
                <div class="name-container">
                    <strong>Наименование:</strong>
                    {{ $city->name }}
                </div>
                <div class="branches-container">
                    <strong>Филиалы:</strong>
                    <ol class="branches-list">
                        @foreach($city->branches as $branch)
                            <li class="branch-list-item">{{ $branch->name }}</li>
                        @endforeach
                    </ol>
                </div>
                <div class="created_at-container">
                    <strong>Дата создания:</strong>
                    {{ $city->created_at }}
                </div>
                <div class="updated_at-container">
                    <strong>Дата обновления:</strong>
                    {{ $city->updated_at }}
                </div>
                <div class="deleted_at-container">
                    <strong>Активен:</strong>
                    {{ is_null($city->deleted_at) ? 'Да' : 'Нет' }}
                </div>
            </div>
        </div>
    </div>
@endsection
