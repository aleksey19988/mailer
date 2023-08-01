@extends('layouts.app')
@section('content')
    <div class="row mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Список праздников</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('holidays.create') }}">Добавить праздник</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($holidays->all()))
        <table class="table table-striped">
            <tr>
                <th>Наименование</th>
                <th>Действия</th>
            </tr>
            @foreach ($holidays as $holiday)
                <tr>
                    <td>{{ $holiday->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('holidays.show', $holiday->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('holidays.edit', $holiday->id) }}">Редактировать</a>
                        <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST" class="delete-item-form">
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
            Самое время добавить первый праздник!
        </div>
    @endif
@endsection
