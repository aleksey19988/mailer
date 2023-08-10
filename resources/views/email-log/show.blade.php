@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Просмотр email-лога</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('email-log.index') }}">Все email-логи</a>
            </div>
        </div>
    </div>
    <div class="letter-addressee-container mb-3">
        <strong>ФИО получателя:</strong><br>
        {{ $addressee_full_name }}
    </div>
    <div class="letter-subject-container mb-3">
        <strong>Тема письма:</strong><br>
        {{ $log->letter_subject }}
    </div>
    <div class="letter-body-container mb-3">
        <strong>Тело письма:</strong><br>
        <div class="letter-body">
            <?= $log->letter_body ?>
        </div>
    </div>
@endsection
