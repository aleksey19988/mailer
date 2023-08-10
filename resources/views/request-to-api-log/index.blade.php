@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Логи запросов к API ChatGPT</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('site.index') }}">На главную</a>
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
                <th>Дата создания</th>
                <th>Данные запроса</th>
                <th>Данные ответа</th>
            </tr>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->request_data }}</td>
                    <td>{{ $log->response_data }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-primary" role="alert">
            В БД нет ни одного запроса
        </div>
    @endif
@endsection
