@extends('layouts.app')
@section('content')
    <div class="row mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Список Email-ов </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('emails.create') }}">Добавить Email</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped">
        <tr>
            <th>Email</th>
            <th>Description</th>
        </tr>
        @foreach ($emails as $email)
            <tr>
                <td class="email-address-header">{{ $email->email_address }}</td>
                <td>

                    <a class="btn btn-info" href="{{ route('emails.show', $email->id) }}">Просмотр</a>
                    <a class="btn btn-primary" href="{{ route('emails.edit', $email->id) }}">Редактировать</a>
                    <form action="{{ route('emails.destroy', $email->id) }}" method="POST" class="delete-item-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
