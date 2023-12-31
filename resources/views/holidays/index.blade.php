@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Список праздников</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success disabled" href="{{ route('holidays.create') }}">Добавить праздник</a>
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
                <th>Дата празднования</th>
                <th>Действия</th>
            </tr>
            @foreach ($holidays as $holiday)
                <tr>
                    <td>{{ $holiday->name }}</td>
                    <td>
                        @if($holiday->date_of_celebration)
                            {{ \Carbon\Carbon::parse($holiday->date_of_celebration)->format('d.m') }}
                        @else
                            <p class="text-danger">Не указана</p>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('holidays.show', $holiday->id) }}">Просмотр</a>
                        <a class="btn btn-primary disabled" href="{{ route('holidays.edit', $holiday->id) }}">Редактировать</a>
                        <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST" class="delete-item-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger disabled">Удалить</button>
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
