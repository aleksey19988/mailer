@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Просмотр</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('emails.index') }}">Вернуться</a>
                <a class="btn btn-primary" href="{{ route('emails.edit', $email) }}">Редактировать</a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
                <div class="id-container">
                    <strong>ID:</strong>
                    #{{ $email->id }}
                </div>
                <div class="email_address-container">
                    <strong>Email:</strong>
                    {{ $email->email_address }}
                </div>
                <div class="created_at-container">
                    <strong>Дата создания:</strong>
                    {{ $email->created_at ?? 'Не указана'}}
                </div>
                <div class="updated_at-container">
                    <strong>Дата обновления:</strong>
                    {{ $email->updated_at ?? 'Не указана'}}
                </div>
                <div class="deleted_at-container">
                    <strong>Активен:</strong>
                    {{ is_null($email->deleted_at) ? 'Да' : 'Нет' }}
                </div>
            </div>
        </div>
    </div>
@endsection
