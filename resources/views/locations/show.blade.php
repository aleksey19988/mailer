@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('locations.index') }}">Вернуться</a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
                <div class="email_address-container">
                    <strong>Наименование:</strong>
                    {{ $location->name }}
                </div>
                <div class="created_at-container">
                    <strong>Дата создания:</strong>
                    {{ $location->created_at }}
                </div>
                <div class="updated_at-container">
                    <strong>Дата обновления:</strong>
                    {{ $location->updated_at }}
                </div>
                <div class="deleted_at-container">
                    <strong>Активен:</strong>
                    {{ is_null($location->deleted_at) ? 'Да' : 'Нет' }}
                </div>
            </div>
        </div>
    </div>
@endsection
