@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр праздника</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('holidays.index') }}">Вернуться</a>
                <a class="btn btn-primary" href="{{ route('holidays.edit', $holiday) }}">Редактировать</a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
                <div class="email_address-container">
                    <strong>Наименование:</strong>
                    {{ $holiday->name }}
                </div>
                <div class="email_address-container">
                    <strong>Дата празднования:</strong>
                    {{ is_null($holiday->date_of_celebration) ? 'Не указана' : $holiday->date_of_celebration }}
                </div>
                <div class="created_at-container">
                    <strong>Дата создания:</strong>
                    {{ $holiday->created_at }}
                </div>
                <div class="updated_at-container">
                    <strong>Дата обновления:</strong>
                    {{ $holiday->updated_at }}
                </div>
                <div class="deleted_at-container">
                    <strong>Активен:</strong>
                    {{ is_null($holiday->deleted_at) ? 'Да' : 'Нет' }}
                </div>
            </div>
        </div>
    </div>
@endsection
