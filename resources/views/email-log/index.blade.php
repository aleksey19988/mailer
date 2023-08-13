@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Логи отправки писем</h2>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($logs->all()))
        <table class="table table-striped">
            <tr>
                <th>Праздник</th>
                <th>Почта получателя</th>
                <th>Получатель копии письма</th>
                <th>Тема письма</th>
                <th>Тело письма</th>
                <th>Была ли отправка успешной</th>
                <th>Дата создания лога</th>
            </tr>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->holiday->name }}</td>
                    <td>{{ $log->addressee_letter_email }}</td>
                    <td>{{ $log->addressee_copy_email ?? 'Не указан' }}</td>
                    <td>{{ $log->letter_subject }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('email-log.show', $log->id) }}">Посмотреть</a>
                    </td>
                    <td>{{ $log->is_send_success ? 'Да' : 'Нет' }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-primary" role="alert">
            В БД нет ни одной отправки
        </div>
    @endif
@endsection
