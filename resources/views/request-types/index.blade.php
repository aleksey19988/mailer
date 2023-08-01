@extends('layouts.app')
@section('content')
    <div class="row mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Список имён запросов</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('request-types.create') }}">Добавить имя/тип запроса</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($requestTypes->all()))
        <table class="table table-striped">
            <tr>
                <th>Наименование</th>
                <th>Действия</th>
            </tr>
            @foreach ($requestTypes as $request)
                <tr>
                    <td>{{ $request->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('request-types.show', $request->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('request-types.edit', $request->id) }}">Редактировать</a>
                        <form action="{{ route('request-types.destroy', $request->id) }}" method="POST" class="delete-item-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-primary" role="alert">
            Самое время добавить первое имя запроса!
        </div>
    @endif
@endsection
