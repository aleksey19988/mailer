@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр отдела</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('departments.index') }}">Вернуться</a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <div class="email_address-container">
                    <p>
                        <strong>Наименование отдела: </strong>{{ $department->name }}
                    </p>
                </div>
                <div class="email_address-container">
                    <p>
                        <strong>Адрес электронной почты отдела: </strong>
                        {{ is_null($department->email->email_address) ? 'Не указана' : $department->email->email_address }}
                    </p>
                </div>
                <div class="created_at-container">
                    <p>
                        <strong>Дата создания: </strong>{{ $department->created_at ?? 'Не указана' }}
                    </p>
                </div>
                <div class="updated_at-container">
                    <p>
                        <strong>Дата обновления: </strong>{{ $department->updated_at ?? 'Не указана'}}
                    </p>
                </div>
                <div class="deleted_at-container">
                    <strong>Активен:</strong>
                    {{ is_null($department->deleted_at) ? 'Да' : 'Нет' }}
                </div>
            </div>
        </div>
    </div>
@endsection
